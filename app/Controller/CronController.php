<?php

App::uses('AppController', 'Controller', 'contact');

/**

 * Generals Controller

 *

 */
class CronController extends AppController {

    var $components = array('Auth');

    /**

     * Scaffold

     *

     * @var mixed

     */
    public $scaffold;
    public $url, $acknowledge;

    function beforeFilter() {
        $this->Auth->userModel = 'User';
        $this->Auth->allow(array('index', 'view'));
        $user = $this->Auth->user();
    }

    public function index() {
        global $url, $acknowledge;
        $error = array();
        
        $this->autoRender = false;
        $url = Router::url('/', true);
        $this->loadModel('EmailProcessing');

        $emails = $this->EmailProcessing->getMailCollection('crmadmin@axovel.in');

        $emails = array_filter($emails);

        if (!empty($emails)) {

            foreach ($emails as $email) {

                if ($email['error'] != "") {

                    $to = explode('~~', $email['head']);
                    $error['subject'] = $email['error'];
                    $this->sendError($error, $to[0]);
                    continue;

                } elseif (strpos(strtolower($email['head']), 'request') !== false) {

                    $request = $this->EmailProcessing->parseRequest($email['head'], $email['body']);
                    $to = explode('~~', $email['head']);

                    if (!empty($request['error'])) {

                        $request['error'] = array_filter($request['error']);
                        if (!empty($request['error'])) {

                            $this->sendRequestError($request['error'], $to[0]);
                            continue;
                        }
                    }

                    if ($request['criteria'] != "") {

                        $request['criteria'] = array_filter($request['criteria']);
                        $response = $request['criteria'];

                    } else {

                        $request['error']['criteria'] = '<p style="color:red">[This criteria value does not fit with the possible ones. Please check it '.$url.']</p>';
                        $this->sendRequestError($request['error'], $to[0]);
                        continue;
                    }

                    if (strpos(strtolower($email['head']), 'activity') !== false) {

                        $this->sendActivity($response, $to[0]);
                        
                    } elseif (strpos(strtolower($email['head']), 'opportunity') !== false) {

                        $this->sendOpportunity($response, $to[0]);
                        
                    } elseif (strpos(strtolower($email['head']), 'contact') !== false) {

                        $this->sendContact($response, $to[0]);
                        
                    } elseif (strpos(strtolower($email['head']), 'company') !== false) {

                        $this->sendCompany($response, $to[0]);
                    }
                } else {

                    $mailContent = $this->EmailProcessing->parseEmail($email['head'], $email['body']);
                    
                    $to = explode('~~', $email['head']);
                    $emailData = $mailContent['variable'];
                    $error = $mailContent['error'];

                    $error = $this->saveToContact($emailData, $error);

                    if ($error['contact_cron'] != "") {
                        
                        $error = array_filter($error);
                        $this->sendError($error, $to[0]);
                        continue;
                    }
                        
                    $error = $this->saveToOpportunity($emailData, $error);

                    if ($error['opp_cron'] != '') {

                        $this->loadModel("Activity");

                        $contact = $this->Contact->find(
                                'first', array(
                            'fields' => 'Contact.id',
                            'conditions' => array(
                                'Contact.Contact_Email' => $emailData['contact_email']
                            )
                                )
                        );
                        $this->Activity->create();

                        $activityData['Activity']['Subject'] = preg_replace("//", '', strip_tags($emailData['subject']));
                        $activityData['Activity']['Email_Body'] = preg_replace("//", '', strip_tags($emailData['activity_body']));
                        $activityData['Activity']['Content'] = preg_replace("//", '', strip_tags($emailData['activity_content']));
                        $activityData['Activity']['opportunity_id'] = 1;
                        $activityData['Activity']['contact_id'] = $contact['Contact']['id'];
                        $activityData['Activity']['Notification_Time'] = $emailData['notification_time'];
                        $activityData['Activity']['Notification_Detail'] = preg_replace("//", '', strip_tags($emailData['notification_detail']));
                        $activityData['Activity']['Notification_Email'] = preg_replace("//", '', strip_tags($emailData['notification_email']));
                        $activityData['Activity']['File'] = preg_replace("//", '', strip_tags($emailData['attachment']));
                        $activityData['Activity']['Criteria'] = preg_replace("//", '', strip_tags($emailData['activity_criteria']));
                        $activityData['Activity']['Updated_By'] = preg_replace("/\s|&nbsp;/", '', strip_tags($emailData['fromaddress']));

                        if ($this->Activity->save($activityData)) {
                            $acknowledge['activity_save'] = '<p style="color:#33CC33">[Activity Created]</p>';
                        } else {
                            $error['activity_cron'] = $emailData['activity_body'] . '<p style="color:#33CC33">[There is a problem saving your mail having subject: '
                                    . $emailData['subject'] . '. We regret the inconvenience. Please send again]</p>';
                            $this->sendError($error, $to[0]);
                        }
                        continue;
                    }

                    $error = $this->saveToActivity($emailData, $error);
                    $error = array_filter($error);
                    if (empty($error)) {
                        $this->sendAcknowledgement($acknowledge, $to[0]);
                    }else{
                        $this->sendError($error, $to[0]);
                    }
                }
            }
        }
    }

    private function saveToContact($emailData, $error) {
        global $url, $acknowledge;

        $this->loadModel('Contact');
        $this->loadModel('Company');
        $this->loadModel('Opportunity');
        $this->loadModel('CrmCompany');
        $this->loadModel('User');
        
        $error['contact_cron'] = "";
        $company['Company']['id'] = "";
        
//        if($emailData['contact_company'] == ""){
//            $error['contact_cron'] = $emailData['activity_body'].'<br><p style="color:red">'
//                    . '[You did not specified contact company]</p>';
//            return $error;
//        }
        preg_match('/\[[^)]*\]|[[]]/', $emailData['subject'], $matches);
        $matches[0] = str_replace(array('[', ']'), '', $matches[0]);
        $user = array();

        $user = $this->User->find(
                'first', array(
            'fields' => 'User.crm_company_id',
            'conditions' => array(
                'User.email' => $emailData['fromaddress'],
                'User.user_company_code' => $matches[0]
            )
                )
        );
        
        if (preg_match('/Fwd|\{[^)]*\}|[{}]/', $emailData['subject'])) {
            return $error;
        }
        
        if ($emailData['contact_company'] != "") {
            $company = $this->Company->find(
                    'first', array(
                'fields' => 'Company.id',
                'conditions' => array(
                    'Company.name' => $emailData['contact_company'],
                    'Company.crm_company_id' => $user['User']['crm_company_id'],
                )
                    )
            );

            if ($company['Company']['id'] == "") {
                $this->Company->create();
                $companyData['Company']['name'] = $emailData['contact_company'];
                $companyData['Contact']['crm_company_id'] = $user['User']['crm_company_id'];
                $this->Company->save($companyData);

                $company = $this->Company->find(
                        'first', array(
                    'fields' => 'Company.id',
                    'conditions' => array(
                        'Company.name' => $emailData['contact_company'],
                        'Company.crm_company_id' => $user['User']['crm_company_id'],
                    )
                        )
                );
            }
        }

        if (!empty($user)) {
            $checkContact = array();
            $checkContact = $this->Contact->find(
                    'first', array(
                        'fields' => 'Contact.Contact_Email',
                        'conditions' => array(
                            'Contact.Contact_Email' => $emailData['contact_email'],
                            'Contact.crm_company_id' => $user['User']['crm_company_id']
                        )
                    )
            );
        }

        if (!empty($checkContact)) {

            $this->Contact->updateAll(
                    array(
                'Contact.Contact_Email' => "'".preg_replace("/&nbsp;/", '', strip_tags($emailData['contact_email']))."'",
                'Contact.Contact_Name' => "'".$emailData['contact_name']."'",
                'Contact.crm_company_id' => "'".$user['User']['crm_company_id']."'",
                'Contact.company_id' => "'".$company['Company']['id']."'",
                'Contact.Detail' => "'".strip_tags($emailData['contact_detail'])."'",
                'Contact.Updated_by' => "'".preg_replace("/&nbsp;/", '', strip_tags($emailData['fromaddress']))."'"
                    ), array(
                'Contact.Contact_Email' => $emailData['contact_email'],
                'Contact.crm_company_id' => $user['User']['crm_company_id']
                    )
            );
            $acknowledge['contact'] = '<p style="color:#33CC33">[Contact Updated]</p>';
        } else {
            $this->Contact->create();

            $contactData['Contact']['Contact_Email'] = preg_replace("/&nbsp;/", '', strip_tags($emailData['contact_email']));
            $contactData['Contact']['Contact_Name'] = $emailData['contact_name'];
            $contactData['Contact']['crm_company_id'] = $user['User']['crm_company_id'];
            $contactData['Contact']['company_id'] = $company['Company']['id'];
            $contactData['Contact']['Detail'] = strip_tags($emailData['contact_detail']);
            $contactData['Contact']['Updated_by'] = preg_replace("/&nbsp;/", '', strip_tags($emailData['fromaddress']));

            if ($this->Contact->save($contactData)) {
                $acknowledge['contact'] = '<p style="color:#33CC33">[Contact Created]</p>';
            } else {
                $error['contact_cron'] = $emailData['activity_body'].'<br><p style="color:red">[There is a problem saving your mail having subject: "'
                        . $emailData['subject'] . '". We regret the inconvenience. Please send again]</p>';
            }
        }

        return $error;
    }

    public function saveToOpportunity($emailData, $error) {

        global $url, $acknowledge;

        $this->loadModel('Contact');
        $this->loadModel('Activity');
        $this->loadModel('Opportunity');
        $this->loadModel('CrmCompany');
        $this->loadModel('User');

        $error['opp_cron'] = "";
        $checkStatus['Opportunity']['Status_details'] = "";
        preg_match('/\[[^)]*\]|[[]]/', $emailData['subject'], $matches);
        $matches[0] = str_replace(array('[', ']'), '', $matches[0]);

        $user = array();
        $user = $this->User->find(
                'first', array(
            'fields' => 'User.crm_company_id',
            'conditions' => array(
                'User.email' => $emailData['fromaddress'],
                'User.user_company_code' => $matches[0],
            )
                )
        );

        $contact = $this->Contact->find('first', array('fields' => 'Contact.id', 'conditions' => array('Contact.Contact_Email' => $emailData['contact_email'])));
        if (preg_match('/\{[^)]*\}|[{}]/', $emailData['subject'], $forward)) {
            $forward[0] = str_replace(array('{', '}'), '', $forward[0]);
            $contact['Contact']['id'] = $forward[0];
        }

        if (strpos($emailData['opp_status'], 'New') !== FALSE && strpos($emailData['opp_status'], 'new') !== FALSE) {

            $checkStatus = $this->Opportunity->find(
                    'first', array(
                'fields' => 'Opportunity.Status_details',
                'conditions' => array(
                    'Opportunity.Opportunity_Name' => $emailData['opp_name'],
                    'Opportunity.crm_company_id' => $user['User']['crm_company_id']
                )
                    )
            );

            if (strpos($checkStatus['Opportunity']['Status_details'], 'New') !== FALSE && strpos($checkStatus['Opportunity']['Status_details'], 'new') !== FALSE) {
                $error['opp_cron'] = $emailData['opp'] . '<br />' . '<p style="color:red">[There exist same opportunity with status "New".'
                        . ' Please click here to check the opportunities. '
                        . $url . 'opportunities/ ]</p>';
                return $error;
            }
        }

        $opportunityData['Opportunity']['Opportunity_Name'] = preg_replace("//", '', strip_tags($emailData['opp_name']));
        $opportunityData['Opportunity']['Detail'] = preg_replace("//", '', strip_tags($emailData['opp_detail']));
        $opportunityData['Opportunity']['opp_company'] = preg_replace("//", '', strip_tags($emailData['opp_company']));
        $opportunityData['Opportunity']['Status_details'] = preg_replace("//", '', strip_tags($emailData['opp_status']));
        $opportunityData['Opportunity']['Value'] = preg_replace("//", '', strip_tags($emailData['opp_value']));
        $opportunityData['Opportunity']['Keywords'] = preg_replace("//", '', strip_tags($emailData['opp_keywords']));
        $opportunityData['Opportunity']['crm_company_id'] = $user['User']['crm_company_id'];
        $opportunityData['Opportunity']['contact_id'] = $contact['Contact']['id'];
        $opportunityData['Opportunity']['Updated_by'] = preg_replace("/\s|&nbsp;/", '', strip_tags($emailData['fromaddress']));

        if ($this->Opportunity->save($opportunityData)) {
            $acknowledge['opportunity'] = '<p style="color:#33CC33">[Opportunity Created]</p>';
        } else {
            $error['opp_cron'] = $emailData['opp'] . '<br />' . '<p style="color:red">[There is a problem saving your mail having subject: "'
                    . $emailData['subject'] . '". We regret the inconvenience. Please send again]</p>';
        }

        return $error;
    }

    public function saveToActivity($emailData, $error) {
        global $acknowledge;

        $this->loadModel('Contact');
        $this->loadModel('Activity');
        $this->loadModel('Opportunity');
        $this->loadModel('CrmCompany');
        $this->loadModel('User');
        
        preg_match('/\[[^)]*\]|[[]]/', $emailData['subject'], $matches);
        $matches[0] = str_replace(array('[', ']'), '', $matches[0]);

        $user = array();
        $user = $this->User->find(
                'first', array(
            'fields' => 'User.crm_company_id',
            'conditions' => array(
                'User.email' => $emailData['fromaddress'],
                'User.user_company_code' => $matches[0],
            )
                )
        );
        
        $contact = $this->Contact->find(
                'first', array(
                    'fields' => 'Contact.id',
                    'conditions' => array(
                        'Contact.Contact_Email' => $emailData['contact_email'],
                        'Contact.crm_company_id' => $user['User']['crm_company_id']
                    )
                )
        );
        
        $opportunity = $this->Opportunity->find(
                'first', array(
                    'fields' => 'Opportunity.id',
                    'conditions' => array(
                        'Opportunity.Opportunity_Name' => $emailData['opp_name'],
                        'Opportunity.contact_id' => $contact['Contact']['id'],
                        'Opportunity.crm_company_id' => $user['User']['crm_company_id']
                    )
                )
        );
        
        if (preg_match('/\{[^)]*\}|[{}]/', $emailData['subject'], $forward)) {
            $forward[0] = str_replace(array('{', '}'), '', $forward[0]);
            $contact['Contact']['id'] = $forward[0];
            
            if ($emailData['notification_email'] != "" || $emailData['notification_detail'] != "" || $emailData['notification_time'] != "") {
                $this->Activity->updateAll(
                        array(
                    'Activity.Notification_Time' => $emailData['notification_time'],
                    'Activity.Notification_Detail' => $emailData['notification_detail'],
                    'Activity.Notification_Email' => $emailData['notification_email']
                        ), array(
                    'Activity.Updated_By' => $emailData['fromaddress'],
                    'Activity.contact_id' => $contact['Contact']['id']
                        )
                );
            }
        } else {
        
            $this->Activity->create();

            $activityData['Activity']['Subject'] = $emailData['subject'];
            $activityData['Activity']['Email_Body'] = $emailData['activity_body'];
            $activityData['Activity']['Content'] = $emailData['activity_content'];
            $activityData['Activity']['opportunity_id'] = $opportunity['Opportunity']['id'];
            $activityData['Activity']['contact_id'] = $contact['Contact']['id'];
            $activityData['Activity']['Notification_Time'] = $emailData['notification_time'];
            $activityData['Activity']['Notification_Detail'] = $emailData['notification_detail'];
            $activityData['Activity']['Notification_Email'] = $emailData['notification_email'];
            $activityData['Activity']['File'] = $emailData['attachment'];
            $activityData['Activity']['Criteria'] = $emailData['activity_criteria'];
            $activityData['Activity']['Updated_By'] = strip_tags($emailData['fromaddress']);
            //echo '<pre>';print_r($emailData);echo '<br>';var_dump($this->Activity->save($activityData));die('Hello there');
            if ($this->Activity->save($activityData)) {
                $acknowledge['activity_save'] = '<p style="color:#33CC33">[Activity Created]</p>';
            } else {
                $error['activity_cron'] = $emailData['activity_body'] . '<p style="color:red">[There is a problem saving your mail having subject: "'
                        . $emailData['subject'] . '". We regret the inconvenience. Please send again (activity)]</p>';
            }
        }
        return $error;
    }

    private function sendActivity($response, $to) {

        App::uses('CakeEmail', 'Network/Email');

        $Email = new CakeEmail();

        $Email->template('activityTemplate')
                ->emailFormat('html')
                ->from('crmadmin@axovel.in')
                ->to($to)
                ->subject('CRM: Response (Activity Detail)')
                ->viewVars(array('response' => $response));

        $Email->send();
    }

    private function sendOpportunity($response, $to) {

        App::uses('CakeEmail', 'Network/Email');

        $Email = new CakeEmail();

        $Email->template('opportunityTemplate')
                ->emailFormat('html')
                ->from('crmadmin@axovel.in')
                ->to($to)
                ->subject('CRM: Response (Opportunity Details)')
                ->viewVars(array('response' => $response));

        $Email->send();
    }

    private function sendContact($response, $to) {

        App::uses('CakeEmail', 'Network/Email');

        $Email = new CakeEmail();

        $Email->template('contactTemplate')
                ->emailFormat('html')
                ->from('crmadmin@axovel.in')
                ->to($to)
                ->subject('CRM: Response (Contact Details)')
                ->viewVars(array('response' => $response));

        $Email->send();
    }

    private function sendCompany($response, $to) {

        App::uses('CakeEmail', 'Network/Email');

        $Email = new CakeEmail();

        $Email->template('companyTemplate')
                ->emailFormat('html')
                ->from('crmadmin@axovel.in')
                ->to($to)
                ->subject('CRM: Response(Company Details)')
                ->viewVars(array('response' => $response));

        $Email->send();
    }

    private function sendRequestError($errorRequest, $to) {

        App::uses('CakeEmail', 'Network/Email');

        $Email = new CakeEmail();

        $Email->template('requestsubjecterror')
                ->emailFormat('html')
                ->from('crmadmin@axovel.in')
                ->to($to)
                ->subject('CRM: Error in your Request Mail')
                ->viewVars(array('response' => $errorRequest));

        $Email->send();
    }

    private function sendError($error, $to) {

        App::uses('CakeEmail', 'Network/Email');

        $Email = new CakeEmail();

        $Email->template('requestsubjecterror')
                ->emailFormat('html')
                ->from('crmadmin@axovel.in')
                ->to($to)
                ->subject('CRM: Error Mail')
                ->viewVars(array('response' => $error));

        $Email->send();
    }

    private function sendAcknowledgement($acknowledge, $to) {
        App::uses('CakeEmail', 'Network/Email');
        $Email = new CakeEmail();

        $Email->template('requestsubjecterror')
                ->emailFormat('html')
                ->from('crmadmin@axovel.in')
                ->to($to)
                ->subject('CRM: Acknowledgement')
                ->viewVars(array('response' => $acknowledge));

        $Email->send();
    }

}
