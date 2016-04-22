<?php

App::uses('AppModel', 'Model');

class EmailProcessing extends AppModel {

    var $useTable = false;
    public $companyEmailConfig, $contactName, $opportunityName, $User;
    public $activity, $opportunity, $contact, $crmcompany;
    public $variable;
    public $error, $requestError;

    //public $opportunity;
    //public $company;

    function getConfig($emailID) {
        App::import('Model', 'CompanyEmailConfig');
        $this->companyEmailConfig = new CompanyEmailConfig();
        $result = $this->companyEmailConfig->find('first', array('conditions' => array('CompanyEmailConfig.EmailID' => $emailID)));
        return $result;
    }

    function getConnect($emailID) {
        global $variable;
        $variable = array(
            "contact" => "",
            "contact_email" => "",
            "contact_name" => "",
            "contact_company" => "",
            "contact_detail" => "",
            "fromaddress" => "",
            "opp" => "",
            "opp_name" => "",
            "opp_detail" => "",
            "opp_status" => "Undefined",
            "opp_value" => "",
            "opp_keywords" => "",
            "opp_company" => "",
            "subject" => "",
            "activity_body" => "",
            "activity_content" => "",
            "notification" => "",
            "notification_time" => "",
            "notification_email" => "",
            "notification_detail" => "",
            "activity_criteria" => "",
            "attachment" => "No file is present"
        );
        $configuration = $this->getConfig($emailID);
        $server = $configuration['CompanyEmailConfig']['server'];
        $email = $configuration['CompanyEmailConfig']['EmailID'];
        $password = $configuration['CompanyEmailConfig']['password'];

        $mbox = imap_open("$server", "$email", "$password") or die(print_r(imap_errors()));

        return $mbox;
    }

    function getMailCollection($emailID) {
        App::import('Model', 'User');
        $this->User = new User();
        
        global $variable, $error;
        unset($GLOBALS['error']);
        $mbox = $this->getConnect($emailID);
        $num = imap_num_msg($mbox);

        set_time_limit(20);
        $mail = '';
        $result = array();
        $headers = imap_headers($mbox);
        $count = 1;
        foreach ($headers as $mail) {
            $flags = substr($mail, 0, 4);
            if (strpos($flags, "U") !== false || strpos($flags, "u") !== false) {
                $header = imap_headerinfo($mbox, $count);
                $from = $header->from;
                foreach ($from as $id => $object) {
                    $from = $object->mailbox . "@" . $object->host;
                }
                
                $from = trim(strip_tags($from));
                $subject = $header->subject;
                
                $result[$count]['head'] = $from . '~~' . $subject;
                $result[$count]['error'] = "";
                //echo $subject;die;

                $body = null;

                $st = imap_fetchstructure($mbox, $count);

                if (!empty($st->parts)) {
                    for ($i = 0, $j = count($st->parts); $i < $j; $i++) {
                        $part = $st->parts[$i];
                        if ($part->subtype == 'PLAIN') {
                            $body = quoted_printable_decode(imap_fetchbody($mbox, $count, 2));
                        } elseif ($body == "") {
                            $body = quoted_printable_decode(imap_fetchbody($mbox, $count, 1.2));
                        } elseif ($body == "") {
                            $body = quoted_printable_decode(imap_fetchbody($mbox, $count, 1.1));
                        } elseif ($body == "") {
                            $body = quoted_printable_decode(imap_fetchbody($mbox, $count, 1));
                        }

                        $attachments[$i] = array(
                            'is_attachment' => false,
                            'filename' => '',
                            'name' => '',
                            'attachment' => '');

                        if ($st->parts[$i]->ifdparameters) {
                            foreach ($st->parts[$i]->dparameters as $object) {
                                if (strtolower($object->attribute) == 'filename') {
                                    $attachments[$i]['is_attachment'] = true;
                                    $attachments[$i]['filename'] = $object->value;
                                }
                            }
                        }

                        if ($st->parts[$i]->ifparameters) {
                            foreach ($st->parts[$i]->parameters as $object) {
                                if (strtolower($object->attribute) == 'name') {
                                    $attachments[$i]['is_attachment'] = true;
                                    $attachments[$i]['name'] = $object->value;
                                }
                            }
                        }

                        if ($attachments[$i]['is_attachment']) {
                            $attachments[$i]['attachment'] = imap_fetchbody($mbox, $num, $i + 1);
                            if ($st->parts[$i]->encoding == 3) { // 3 = BASE64
                                $attachments[$i]['attachment'] = base64_decode($attachments[$i]['attachment']);
                            } elseif ($st->parts[$i]->encoding == 4) { // 4 = QUOTED-PRINTABLE
                                $attachments[$i]['attachment'] = quoted_printable_decode($attachments[$i]['attachment']);
                            }
                        }
                    }

                    if (count($attachments) != 0) {


                        foreach ($attachments as $at) {

                            if ($at['is_attachment'] == 1) {

                                if (file_exists("files/")) {
                                    file_put_contents("files/" . $at['filename'], $at['attachment']);
                                    $variable['attachment'] = $at['filename'];
                                } else {
                                    if (mkdir("files/", 0777, true)) {
                                        file_put_contents("attachment/" . $at['filename'], $at['attachment']);
                                        $variable['attachment'] = $at['filename'];
                                    } else {
                                        $error['attachment'] = "The attachment sent could not be processed please send it again with same....";
                                    }
                                }
                            }
                        }
                    }
                } else {
                    $body = quoted_printable_decode(imap_body($mbox, $count));
                }
                $result[$count]['body'] = strip_tags($body);
            }
            $count = $count + 1;
        }
        return $result;
    }

    function parseEmail($head, $body) {
        global $variable, $error;
        $head = explode("~~", trim($head));
        $variable['fromaddress'] = $head[0];
        $variable['subject'] = $head[1];
        $variable['activity_body'] = $body;
        $body = trim(preg_replace('/\[[^)]*\]|[[]]/', '', $body));
        if (strpos($body, '#CONTACT') !== 0) {
            
        }

        $body = explode("#", trim($body));
        if (!empty($body[0])) {
            $variable['activity_content'] = array_shift($body);
        }
        $body = array_filter($body);
        foreach ($body as $break) {
            if (strpos($break, 'KEYWORDS') !== FALSE) {
                $this->getCriteria($break);
            } elseif (strpos($break, 'CONTACT') !== FALSE) {
                $this->getContact($break);
            } elseif (strpos($break, 'OPP') !== FALSE) {
                $this->getOpp($break);
            } elseif (strpos($break, 'NOTIFICATION') !== FALSE) {
                $this->getNotification($break);
            } else {
                $error['block_name'] = '<p style="color:red">[The name <name> is not known.'
                        . ' Please use #KEYWORDS, #OPP, #CONTACT or #NOTIFICATION</p>]';
            }
        }
        $result['variable'] = $variable;
        $result['error'] = $error;
        return $result;
    }

    function parseRequest($head, $body) {
        global $requestError;
        $head = strtolower($head);
        if (strpos($head, "activity") !== false) {
            $criteria = $this->fetchActivityCriteria($body);
            $request['criteria'] = $criteria;
        } elseif (strpos($head, "opportunity") !== false) {
            $criteria = $this->fetchOpportunityCriteria($body);
            $request['criteria'] = $criteria;
        } elseif (strpos($head, "contact") !== false) {
            $criteria = $this->fetchContactCriteria($body);
            $request['criteria'] = $criteria;
        } else {
            $requestError['subject'] = '<p style="color:red">[This is not a possible request. '
                    . 'Please use the request as: activity, opportunity or contact]</p>';
        }
        $request['error'] = $requestError;
        return $request;
    }

    /*
     * this function gets details for criteria
     */

    function getCriteria($str) {
        global $variable, $error;
        $str = strip_tags($str);
                $variable['activity_criteria'] = preg_replace('/PRODUCT|CLASS|Criteria|KEYWORDS/', '', $str);
                //$variable['activity_body'] = $variable['activity_body'] . "<br>#CLASS PRODUCT<br>Criteria : " . $variable["activity_criteria"];
                $variable['activity_criteria'] = trim($variable['activity_criteria']);
    }

    /*
     * this function gets details for activity notification
     */

    function getNotification($str) {
        global $variable, $error;
        $str = strip_tags($str);
        $variable['notification'] = $notification = $str;
        //$str = strtolower($str);
        $str = explode(':', $str);
        //$variable['activity_body'] = $variable['activity_body'] . "<br><br>#NOTIFICATION";
        $n = count($str);
        for ($i = 0; $i < $n-1; $i++) {
            if (strpos($str[$i], 'Time') !== false) {
                $variable['notification_time'] = preg_replace('/Time|Detail|Email/', '', $str[$i + 1]);
                //$variable['activity_body'] = $variable['activity_body'] . "<br>Time : " . $variable['notification_time'];
                $variable['notification_time'] = strtotime($variable['notification_time']);
                $variable['notification_time'] = date('Y-m-d h:i:sa', $variable['notification_time']);
            } 
            if (strpos($str[$i], 'Detail') !== false) {
                $variable['notification_detail'] = preg_replace('/Time|Detail|Email/', '', $str[$i + 1]);
                //$variable['activity_body'] = $variable['activity_body'] . "<br>Detail : " . $variable['notification_detail'];
                $variable['notification_detail'] = trim($variable['notification_detail']);
            } 
            if (strpos($str[$i], 'Email') !== false) {
                $variable['notification_email'] = preg_replace('/&nbsp;|Time|Detail|Email/', '', $str[$i + 1]);
                //$variable['activity_body'] = $variable['activity_body'] . "<br>Email : " . $variable['notification_email'];
                $variable['notification_email'] = trim($variable['notification_email']);
            } 
            if($variable['notification_time']==NULL && $variable['notification_detail']==NULL && $variable['notification_email']==NULL) {
                $error['notification'] = $error['notification'].'#'.$notification.'<br />';
                $error['notification'] = $error['notification'].' '
                        . '<p style="color:red">[Please enter line by line :'
                        . ' date, text and email of recipient of the notification]</p>';
            }
        }
    }

    /*
     * this function gets details for opportunity table
     */

    function getOpp($str) {
        global $variable, $error;
        $str = strip_tags($str);
        $variable['opp'] = $opportunity = $str;
        //$str = strtolower($str);
        $str = explode(':', $str);
        $n = count($str);
        //$variable['activity_body'] = $variable['activity_body'] . "<br><br>#OPP";
        for ($i = 0; $i < $n-1; $i++) {
            if (strpos($str[$i], 'Status') !== false) {
                $variable['opp_status'] = preg_replace('/Status|Detail|Value|Company|Keywords|OPP/', '', $str[$i + 1]);
                //$variable['activity_body'] = $variable['activity_body'] . "<br>Status :" . $variable['opp_status'];
                $variable['opp_status'] = trim($variable['opp_status']);
                $checkStatus = array('New', 'Close', 'Lost', 'Win','new');
                if (!in_array($variable['opp_status'], $checkStatus)) {
                    $error['opp'] = $error['opp'].'#'.$opportunity.'<br />';
                    $error['opp'] = $error['opp'].'<p style="color:red">[Please check status : New, Close, Lost, Win]</p>';
                }
            } elseif (strpos($str[$i], 'Detail') !== false) {
                $variable['opp_detail'] = preg_replace('/Status|Detail|Value|Company|Keywords|OPP/', '', $str[$i + 1]);
                //$variable['activity_body'] = $variable['activity_body'] . "<br>Detail : " . $variable['opp_detail'];
                $variable['opp_detail'] = trim($variable['opp_detail']);
            } elseif (strpos($str[$i], 'Value') !== false) {
                $variable['opp_value'] = preg_replace('/Status|Detail|Value|Company|Keywords|OPP/', '', $str[$i + 1]);
                //$variable['activity_body'] = $variable['activity_body'] . "<br>Value :" . $variable['opp_value'];
                $variable['opp_value'] = floatval($variable['opp_value']);

                if ($variable['opp_value']=="") {
                    if ($error['opp']==""){
                        $error['opp'] = $error['opp'].'#'.$opportunity.'<br />';
                        $error['opp'] = $error['opp'].'<br />'.'<p style="color:red">[The amount is not numerical,'
                                . ' please correct and enter only the amount like “10000”]</p>';
                    } else{
                        $error['opp'] = $error['opp'].'<br />'.'<p style="color:red">[The amount is not numerical,'
                                . ' please correct and enter only the amount like “10000”]</p>';
                    }
                }
            } elseif (strpos($str[$i], 'Company') !== false) {
                $variable['opp_company'] = preg_replace('/Status|Detail|Value|Company|Keywords|OPP/', '', $str[$i + 1]);
                //$variable['activity_body'] = $variable['activity_body'] . "<br>Company : " . $variable['opp_company'];
                $variable['opp_company'] = trim($variable['opp_company']);
            } elseif (strpos($str[$i], 'Keywords') !== false) {
                $variable['opp_keywords'] = preg_replace('/Status|Detail|Value|Company|Keywords|OPP/', '', $str[$i + 1]);
                //$variable['activity_body'] = $variable['activity_body'] . "<br>Keywords : " . $variable['opp_keywords'];
                $variable['opp_keywords'] = trim($variable['opp_keywords']);
            } else { 
                if ($error['opp'] == "") {
                    $error['opp'] = $error['opp'] . '#' . $opportunity . '<br />';
                    $error['opp'] = $error['opp'] . '<br />' . '<p style="color:red">[The type of information is not right. '
                            . 'Please use : “Keywords :”, “Detail :”, “Value :”,"Status :","Company :".]</p>';
                } else {
                    $error['opp'] = $error['opp'] . '<br />' . '<p style="color:red">[The type of information if not right. '
                            . 'Please use : “Keywords :”, “Detail :”, “Value :”,"Status :","Company :".]</p>';
                }
            }
            if ($variable['opp_name'] == '') {
                $variable['opp_name'] = preg_replace('/Status|Detail|Value|Company|Keywords|OPP/', '', $str[0]);
                //$variable['activity_body'] = $variable['activity_body'] . "<br>" . $variable['opp_name'];
                $variable['opp_name'] = trim($variable['opp_name']);
            }
            if ($variable['opp_company']=="") {
                $variable['opp_company'] = $variable['contact_company'];
            }
        }
    }

    /*
     * this function gets details for contact table
     */

    function getContact($str) {
        global $variable, $error;
        $str = strip_tags($str);
        $variable['contact'] = $contact = $str;
        //$str = strtolower($str);
        $str = explode(':', $str);
        $str = array_filter($str);
        $n = count($str);
        //$variable['activity_body'] = $variable['activity_body'] . "<br><br>#CONTACT";
        for ($i = 0; $i < $n-1; $i++) {
            if (strpos($str[$i], '@') !== false) {
                $variable['contact_email'] = preg_replace('/&nbsp;|Detail|Company|CONTACT|Name/', '', $str[$i]);
                //$variable['activity_body'] = $variable['activity_body'] . "<br>" . $variable['contact_email'];
                $variable['contact_email'] = trim($variable['contact_email']);
                if ($variable['contact_email'] == null) {
                    $error['contact'] = $error['contact'].'#'.$contact.'<br />';
                    $error['contact'] = $error['contact'].'<br />'.'<p style="color:red">[It is mandatory to specify a contact email.'
                            . 'If you have done so, plese enter it in a standard email format.]</p>';
                }
            }
            if (strpos($str[$i], 'Name') !== false) {
                $variable['contact_name'] = preg_replace('/Detail|Company|CONTACT|Name/', '', $str[$i + 1]);
                //$variable['activity_body'] = $variable['activity_body'] . "<br>Name : " . $variable['contact_name'];
                $variable['contact_name'] = trim($variable['contact_name']);
            }
            if (strpos($str[$i], 'Company') !== false) {
                $variable['contact_company'] = preg_replace('/Detail|Contact|CONTACT|Name/', '', $str[$i + 1]);
                //$variable['activity_body'] = $variable['activity_body'] . "<br>Company : " . $variable['contact_company'];
                $variable['contact_company'] = trim($variable['contact_company']);
            }
            if (strpos($str[$i], 'Detail') !== false) {
                $variable['contact_detail'] = preg_replace('/Company|Detail|CONTACT|Name/', '', $str[$i + 1]);
                //$variable['activity_body'] = $variable['activity_body'] . "<br>Detail : " . $variable['contact_detail'];
                $variable['contact_detail'] = trim($variable['contact_detail']);
            }
            if ($variable['contact_email'] == "") {
                if ($error['contact']=="") {
                    $error['contact'] = $error['contact'].'#'.$contact.'<br />';
                    $error['contact'] = $error['contact'].'<br />'.'<p style="color:red">[It is mandatory to specify a contact email.'
                            . 'If you have done so, plese enter it in a standard email format.]</p>';
                } else{
                    $error['contact'] = $error['contact'].'<br />'.'<p style="color:red">[It is mandatory to specify a contact email.'
                            . 'If you have done so, plese enter it in a standard email format.]</p>';
                }
                continue;
            }
        }
    }

    function fetchActivityCriteria($body) {
        global $requestError;
        App::import('Model', 'Contact');
        $this->contactName = new Contact();

        App::import('Model', 'Opportunity');
        $this->opportunityName = new Opportunity();
        $opportunityID['Opportunity']['id'] = $contactID['Contact']['id'] =NULL;
        $date= NULL;
        $from = '2000-01-01';
        $to = '3000-12-12';
        //$criteria = strtolower($body);
        $criteria = explode(':', $body);
        $n = count($criteria);
        for ($i = 0; $i < $n; $i++) {
            if (strpos($criteria[$i], '@') !== false) {
                $contact = preg_replace('/Contact|Opportunity|From|To|Date/', '', $criteria[$i]);
                $contact = trim($contact);
                $contactID = $this->contactName->find('first', array('fields' => 'Contact.id', 'conditions' => array('Contact.Contact_Email' => $contact)));
            } elseif (strpos($criteria[$i], 'Opportunity') !== false || strpos($criteria[$i], 'opportunity') !== false) {
                $opportunity = preg_replace('/Contact|Opportunity|From|To|Date/', '', $criteria[$i + 1]);
                $opportunity = trim($opportunity);
                $opportunityID = $this->opportunityName->find('first', array('fields' => 'Opportunity.id', 'conditions' => array('Opportunity.Opportunity_Name' => $opportunity)));
            } elseif (strpos($criteria[$i], 'From') !== false || strpos($criteria[$i], 'from') !== false) {
                $from = preg_replace('/Contact|Opportunity|From|To|Date/', '', $criteria[$i + 1]);
                $from = trim($from);
            } elseif (strpos($criteria[$i], 'To') !== false || strpos($criteria[$i], 'to') !== false) {
                $to = preg_replace('/Contact|From|To|Date|Opportunity/', '', $criteria[$i + 1]);
                $to = trim($to);
            } elseif (strpos($criteria[$i], 'Date') !== false || strpos($criteria[$i], 'date') !== false) {
                $date = preg_replace('/Contact|From|To|Date|Opportunity/', '', $criteria[$i + 1]);
            } else {
                $requestError['criteria'] = '<p style="color:red">[This criteria does not exist.'
                    . ' Please use one of the following criterias : (Opportunity, From, To, Date)]</p>';
            }
        }
        return $this->selectActivity($contactID['Contact']['id'], $opportunityID['Opportunity']['id'], $from, $to, $date);
    }

    function fetchOpportunityCriteria($body) {
        global $requestError;
        $opp = $status = $contact = $date = NULL;
        $from = '2000-01-01';
        $to = '3000-01-01';
        //$criteria = strtolower($body);
        $criteria = explode(':', $body);

        $n = count($criteria);
        for ($i = 0; $i < $n - 1; $i++) {
            if (strpos($criteria[$i], 'Opp') !== false || strpos($criteria[$i], 'opp') !== false) {
                $opp = preg_replace('/Opp|Status|From|To|Date|Contact/', '', $criteria[$i + 1]);
                $opp = strtolower(trim($opp));
            } elseif (strpos($criteria[$i], 'Status') !== false || strpos($criteria[$i], 'status') !== false) {
                $status = preg_replace('/Opp|Status|From|To|Date|Contact/', '', $criteria[$i + 1]);
                $status = strtolower(trim($status));
            } elseif (strpos($criteria[$i], 'Contact') !== false || strpos($criteria[$i], 'contact') !== false) {
                $contact = preg_replace('/Opp|Status|From|To|Date|Contact/', '', $criteria[$i + 1]);
                $contact = strtolower(trim($contact));
            } elseif (strpos($criteria[$i], 'From') !== false || strpos($criteria[$i], 'from') !== false) {
                $from = preg_replace('/Opp|Status|From|To|Date|Contact/', '', $criteria[$i + 1]);
                $from = trim($from);
            } elseif (strpos($criteria[$i], 'To') !== false || strpos($criteria[$i], 'to') !== false) {
                $to = preg_replace('/Opp|Status|From|To|Date|Contact/', '', $criteria[$i + 1]);
                $to = trim($to);
            } elseif (strpos($criteria[$i], 'Date') !== false || strpos($criteria[$i], 'date') !== false) {
                $date = preg_replace('/Opp|Status|From|To|Date|Contact/', '', $criteria[$i + 1]);
            } else {
                $requestError['criteria'] = '<p style="color:red">[This criteria does not exist.'
                        . ' Please use one of the following criterias : Opp,Status,Contact,From,To,Data]</p>';
            }
        }
        return $this->selectOpportunity($opp, $status, $contact, $from, $to, $date);
    }

    function fetchContactCriteria($body) {
        global $requestError;
        $contact = $owner = $company = $date = NULL;
        $from = '2000-01-01';
        $to = '3000-01-01';
        //$criteria = strtolower($body);
        $criteria = explode(':', $body);

        $n = count($criteria);
        for ($i = 0; $i < $n - 1; $i++) {
            if (strpos($criteria[$i], 'Contact') !== false || strpos($criteria[$i], 'contact') !== false) {
                $contact = preg_replace('/Contact|Company|Owner|To|From|Date/', '', $criteria[$i + 1]);
                $contact = strtolower(trim($contact));
            } elseif (strpos($criteria[$i], 'Company') !== false || strpos($criteria[$i], 'company') !== false) {
                $company = preg_replace('/Contact|Company|Owner|To|From|Date/', '', $criteria[$i + 1]);
                $company = strtolower(trim($company));
            } elseif (strpos($criteria[$i], 'Owner') !== false || strpos($criteria[$i], 'owner') !== false) {
                $owner = preg_replace('/Contact|Company|Owner|To|From|Date/', '', $criteria[$i + 1]);
                $owner = strtolower(trim($owner));
            } elseif (strpos($criteria[$i], 'From') !== false || strpos($criteria[$i], 'from') !== false) {
                $from = preg_replace('/Contact|Company|Owner|To|From|Date/', '', $criteria[$i + 1]);
                $from = trim($from);
            } elseif (strpos($criteria[$i], 'To') !== false || strpos($criteria[$i], 'to') !== false) {
                $to = preg_replace('/Contact|Company|Owner|To|From|Date/', '', $criteria[$i + 1]);
                $to = trim($to);
            } elseif (strpos($criteria[$i], 'Date') !== false || strpos($criteria[$i], 'date') !== false) {
                $date = preg_replace('/Contact|Company|Owner|To|From|Date/', '', $criteria[$i + 1]);
            } else {
                $requestError['criteria'] = '<p style="color:red">[This criteria does not exist. '
                        . 'Please use one of the following criterias : Contact, Company, Owner, From, To, Date]</p>';
            }
        }
        return $this->selectContact($contact, $company, $owner, $from, $to, $date);
    }

    function fetchCompanyCriteria($body) {
        $company = $status = $date = NULL;
        $from = '2000-01-01';
        $to = '3000-01-01';
        //$criteria = strtolower($body);
        $criteria = explode(':', $body);

        $n = count($criteria);
        for ($i = 0; $i < $n - 1; $i++) {
            if (strpos($criteria[$i], 'Company') !== false || strpos($criteria[$i], 'company') !== false) {
                $company = preg_replace('/Company|From|To|Date|Group/', '', $criteria[$i + 1]);
                $company = strtolower(trim($company));
            } elseif (strpos($criteria[$i], 'Group') !== false || strpos($criteria[$i], 'group') !== false) {
                $status = preg_replace('/Company|From|To|Date|Group/', '', $criteria[$i + 1]);
                $status = strtolower(trim($status));
            } elseif (strpos($criteria[$i], 'From') !== false || strpos($criteria[$i], 'from') !== false) {
                $from = preg_replace('/Company|From|To|Date|Group/', '', $criteria[$i + 1]);
                $from = trim($from);
            } elseif (strpos($criteria[$i], 'To') !== false || strpos($criteria[$i], 'to') !== false) {
                $to = preg_replace('/Company|From|To|Date|Group/', '', $criteria[$i + 1]);
                $to = trim($to);
            } elseif (strpos($criteria[$i], 'Date') !== false || strpos($criteria[$i], 'date') !== false) {
                $date = preg_replace('/Company|From|To|Date|Group/', '', $criteria[$i + 1]);
            } else {
                $requestError['criteria'] = '<p style="color:red">[This criteria does not exist. '
                        . 'Please use one of the following criterias : Company, Group, From, To, Date]</p>';
            }
        }
        return $this->selectCompany($company, $status, $from, $to, $date);
    }

    function selectActivity($contactID = null, $opportunityID = NULL, $from = null, $to = null, $date = NULL) {
        $flag1 = $flag2 = $flag3 = NULL;
        $contactID = explode(',', $contactID);
        $contactID = array_filter($contactID);

        $opportunityID = explode(',', $opportunityID);
        $opportunityID = array_filter($opportunityID);

        $date = explode(',', $date);
        $date = array_filter($date);

        if (!empty($contactID)) {
            foreach ($contactID as $contacts) {
                $flag1 = " " . "and contact_id = " . $contacts;
            }
        }

        if (!empty($opportunityID)) {
            foreach ($opportunityID as $opportunities) {
                $flag2 = " " . "and opportunity_id = " . trim($opportunities);
            }
        }

        if (!empty($date)) {
            foreach ($date as $dates) {
                $flag3 = " " . "and Last_update = " . trim($opportunities);
            }
        }

        App::import('Model', 'Activity');
        $this->activity = new Activity();

        $db = $this->activity->query(
                "SELECT Subject,Content,Notification_Time,Notification_Detail,Notification_Email,Criteria"
                . " FROM activities WHERE Last_updated BETWEEN '".$from."' and '".$to."' $flag1 $flag2 $flag3;"
        );
        $result = $db;
        return $result;
    }

    function selectOpportunity($opp = null, $status = null, $contact = null, $from = null, $to = NULL, $date = NULL) {
        $flag1 = $flag2 = $flag3 = $flag4 = NULL;

        $opp = explode(',', $opp);
        $opp = array_filter($opp);

        $status = explode(',', $status);
        $status = array_filter($status);

        $contact = explode(',', $contact);
        $contact = array_filter($contact);

        $date = explode(',', $date);
        $date = array_filter($date);

        if (!empty($opp)) {
            foreach ($opp as $opportunity) {
                $flag1 = " " . "and Opportunity_Name = " . "'" . trim($opportunity) . "'";
            }
        }
        if (!empty($status)) {
            foreach ($status as $statusarray) {
                $flag2 = " " . "and Status_details = " . "'" . trim($statusarray) . "'";
            }
        }
        if (!empty($contact)) {
            foreach ($contact as $contactid) {
                $flag3 = " " . "and contact_id = " . "'" . trim($contactid) . "'";
            }
        }

        if (!empty($date)) {
            foreach ($date as $dates) {
                $flag4 = " " . "and Last_update = " . trim($opportunities);
            }
        }

        App::import('Model', 'Opportunity');
        $this->opportunity = new Opportunity();

        $db = $this->opportunity->query(
                "SELECT Opportunity_Name,Detail,Status_details,Value,Keywords"
                . " FROM opportunities WHERE Last_update BETWEEN '".$from."' and '".$to."' $flag1$flag2$flag3$flag4;"
        );

        $result = $db;
        return $result;
    }

    function selectContact($contact = null, $company = NULL, $owner = null, $from = null, $to = NULL, $date = NULL) {
        $flag1 = $flag2 = $flag3 = $flag4 = NULL;

        $contact = explode(',', $contact);
        $contact = array_filter($contact);

        $owner = explode(',', $owner);
        $owner = array_filter($owner);

        $company = explode(',', $company);
        $company = array_filter($company);

        $date = explode(',', $date);
        $date = array_filter($date);

        if (!empty($contact)) {
            foreach ($contact as $contacts) {
                $flag1 = " " . "and Contact_Name = " . "'" . trim($contacts) . "'";
            }
        }
        if (!empty($owner)) {
            foreach ($owner as $owners) {
                $flag2 = " " . "and Updated_by = " . "'" . trim($owners) . "'";
            }
        }
        if (!empty($company)) {
            foreach ($company as $companies) {
                App::import('Model', 'CrmCompany');
                $this->crmcompany = new CrmCompany();
                $companyID = $this->crmcompany->find('first', array('fields' => array('CrmCompany.id'), 'conditions' => array('CrmCompany.Company_Name' => $companies)));
                $flag3 = " " . "and crm_company_id = " . "'" . $companyID['CrmCompany']['id'] . "'";
            }
        }

        if (!empty($date)) {
            foreach ($date as $dates) {
                $flag4 = " " . "and Last_Update = " . trim($opportunities);
            }
        }

        App::import('Model', 'Opportunity');
        $this->opportunity = new Opportunity();

        $db = $this->opportunity->query(
                "SELECT Contact_Name,Contact_Email,Detail"
                . " FROM contacts WHERE Last_Update BETWEEN '".$from."' and '".$to."' $flag1 $flag2 $flag3 $flag4;"
        );

        $result = $db;
        return $result;
    }

    function selectCompany($company = null, $group = null, $from = null, $to = NULL, $date = NULL) {
        $flag1 = $flag2 = $flag3 = NULL;

        $company = explode(',', $company);
        $company = array_filter($company);

        $group = explode(',', $group);
        $group = array_filter($group);

        $date = explode(',', $date);
        $date = array_filter($date);

        if (!empty($company)) {
            foreach ($company as $companies) {
                $flag1 = " " . "and Company_Name = " . "'" . trim($companies) . "'";
            }
        }
        if (!empty($group)) {
            foreach ($group as $groups) {
                $flag2 = " " . "and Company_Group = " . "'" . trim($groups) . "'";
            }
        }

        if (!empty($date)) {
            foreach ($date as $dates) {
                $flag3 = " " . "and Last_Update = " . trim($opportunities);
            }
        }

        App::import('Model', 'Opportunity');
        $this->opportunity = new Opportunity();

        $db = $this->opportunity->query(
                "SELECT Company_Name, Company_Domain,Company_Group"
                . " FROM crmcompanies WHERE Last_Update BETWEEN '".$from."' and '".$to."' $flag1 $flag2 $flag3;"
        );

        $result = $db;
        return $result;
    }

}