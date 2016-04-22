<?php

App::uses('AppController', 'Controller');

/**
 * Companies Controller
 *
 */
class FiltersController extends AppController {

    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session', 'Auth', 'Paginator');
//    var $components = array('Auth');
    /**
     * Scaffold
     *
     * @var mixed
     */
    public $scaffold;

    function beforeFilter() {
		if($this->Session->check('Auth.User.id')!=1){ 
			$this->redirect('/');
		}
    }

    /**
     * index [this function is for filtering data by multiple filter]
     *
     * @param string NONE
     * 
     * @return void
     */
    public function index() {

        $this->layout = "admin";
        $this->loadModel('Opportunity');
        $this->Opportunity->recursive = 2;
        $this->set('allFilteredDatas', $this->Opportunity->find('all'));
    }

    /**
     * ajax [this function is for filtering data by Ajax]
     *
     * @param string NONE
     * 
     * @return void
     */
    public function ajax() {
                        $this->layout="admin";
        $this->loadModel('Opportunity');
        $this->Opportunity->recursive = 2;
        $this->set('allFilteredDatas', $this->Opportunity->find('all'));
        if (!empty($_POST)) {
            $conditions = array();
            if ($_POST['datet'] != "All") {
                $conditions['Opportunity.Last_update LIKE'] = $_POST['datet'] . "%";
            }
            if ($_POST['contactn'] != "All") {
                $conditions['Contact.Contact_Name'] = $_POST['contactn'];
            }
            if ($_POST['companyn'] != "All") {
                $conditions['CrmCompany.Company_name'] = $_POST['companyn'];
            }
            if ($_POST['opportunity'] != "All") {
                $conditions['Opportunity.Opportunity_Name'] = $_POST['opportunity'];
            }
            if ($_POST['status'] != "All") {
                $conditions['Opportunity.Status_details'] = $_POST['status'];
            }

            $this->set('allFilteredDatas', $this->Opportunity->find('all', array('conditions' => $conditions)));
        }
        //  $this->set('companyList',$this->Company->find('list',array('fields'=>array('CompanyID','Company_Name'))));
        $allFiltered = $this->Opportunity->find('all');

        if ($this->Session->check('companyName') != 1) {
            $this->Session->write('companyName', '');
            $Companynames = "<option value='All'>All Company</option>";
            $Company12 = "";
            foreach ($allFiltered as $crmData) {
                if (!in_array($crmData['CrmCompany']['Company_Name'], $Company12)) {
                    $Companynames = $Companynames . "<option value='" . $crmData['CrmCompany']['Company_Name'] . "'>" . $crmData['CrmCompany']['Company_Name'] . "</option>";

                    $Company12[] = $crmData['CrmCompany']['Company_Name'];
                }
            }
            $this->Session->write('companyName', $Companynames);
//echo "sdg";
        }
        //  pr($this->Session->read('companyName'));die;
        // echo "fasdf";   print_r($_SESSION);die;
    }
    
        /**
     * company filter [this function is for filtering data by multiple filter for a loggedin company]
     *
     * @param string NONE
     * 
     * @return void
     */
    public function company() {
       
        $companyID=$this->Session->read('Auth.User.company_id');
        if($this->Session->read('Auth.User.role')=="admin"){
            $this->redirect("ajax");
        }
//        pr($companyID);die;
   $this->loadModel('Opportunity');
        $this->Opportunity->recursive = 2;
        $this->set('allFilteredDatas', $this->Opportunity->find('all',array('conditions'=>array('Opportunity.crm_company_id'=>$companyID))));
        if (!empty($_POST)) {
            
            $conditions = array();
            if ($_POST['datet'] != "All") {
                $conditions['Opportunity.Last_update LIKE'] = $_POST['datet'] . "%";
            }
            if ($_POST['contactn'] != "All") {
                $conditions['Contact.Contact_Name'] = $_POST['contactn'];
            }
            if ($companyID>0) {
                $conditions['Opportunity.crm_company_id'] = $companyID;
            }
            if ($_POST['opportunity'] != "All") {
                $conditions['Opportunity.Opportunity_Name'] = $_POST['opportunity'];
            }
            if ($_POST['status'] != "All") {
                $conditions['Opportunity.Status_details'] = $_POST['status'];
            }

            $this->set('allFilteredDatas', $this->Opportunity->find('all', array('conditions' => $conditions)));
            $this->layout="";
        }else{
             $this->layout="admin";
        }
        //  $this->set('companyList',$this->Company->find('list',array('fields'=>array('CompanyID','Company_Name'))));
        $allFiltered = $this->Opportunity->find('all');

        if ($this->Session->check('companyName') != 1) {
            $this->Session->write('companyName', '');
            $Companynames = "<option value='All'>All Company</option>";
            $Company12 = "";
            foreach ($allFiltered as $crmData) {
                if (!in_array($crmData['CrmCompany']['Company_Name'], $Company12)) {
                    $Companynames = $Companynames . "<option value='" . $crmData['CrmCompany']['Company_Name'] . "'>" . $crmData['CrmCompany']['Company_Name'] . "</option>";

                    $Company12[] = $crmData['CrmCompany']['Company_Name'];
                }
            }
            $this->Session->write('companyName', $Companynames);
//echo "sdg";
        }
        
    }
        /**
     * companyajax filter [this function is for filtering data by multiple filter for a loggedin company]
     *
     * @param string NONE
     * 
     * @return void
     */
    public function companyajax() {
       $this->layout="admin";
        $companyID=$this->Session->read('Auth.User.company_id');
   $this->loadModel('Opportunity');
        $this->Opportunity->recursive = 2;
        $this->set('allFilteredDatas', $this->Opportunity->find('all',array('conditions'=>array('Opportunity.crm_company_id'=>$companyID))));
        if (!empty($_POST)) {
            $conditions = array();
            if ($_POST['datet'] != "All") {
                $conditions['Opportunity.Last_update LIKE'] = $_POST['datet'] . "%";
            }
            if ($_POST['contactn'] != "All") {
                $conditions['Contact.Contact_Name'] = $_POST['contactn'];
            }
            if ($companyID>0) {
                $conditions['Opportunity.crm_company_id'] = $companyID;
            }
            if ($_POST['opportunity'] != "All") {
                $conditions['Opportunity.Opportunity_Name'] = $_POST['opportunity'];
            }
            if ($_POST['status'] != "All") {
                $conditions['Opportunity.Status_details'] = $_POST['status'];
            }

            $this->set('allFilteredDatas', $this->Opportunity->find('all', array('conditions' => $conditions)));
        }
        //  $this->set('companyList',$this->Company->find('list',array('fields'=>array('CompanyID','Company_Name'))));
        $allFiltered = $this->Opportunity->find('all');

        if ($this->Session->check('companyName') != 1) {
            $this->Session->write('companyName', '');
            $Companynames = "<option value='All'>All Company</option>";
            $Company12 = "";
            foreach ($allFiltered as $crmData) {
                if (!in_array($crmData['CrmCompany']['Company_Name'], $Company12)) {
                    $Companynames = $Companynames . "<option value='" . $crmData['CrmCompany']['Company_Name'] . "'>" . $crmData['CrmCompany']['Company_Name'] . "</option>";

                    $Company12[] = $crmData['CrmCompany']['Company_Name'];
                }
            }
            $this->Session->write('companyName', $Companynames);
//echo "sdg";
        }
       
    }
      
    public function get_opportunity() {
       // pr($_POST); die;
       $this->layout="";
        $this->loadModel('Opportunity');
        if(!empty($_POST['opportunity'])){
        $data=$this->Opportunity->find('first', array('conditions' =>array('Opportunity_Name'=> $_POST['opportunity'])));
       //pr($data);
        $this->set('oppdata',$data);
        
        }
    }
     public function get_company($id=NULL) {
       $this->layout="";
        if (!$id) {
            throw new NotFoundException(__('Invalid company'));
        }
        $this->loadModel('CrmCompany');
        $company = $this->CrmCompany->find('first',array('conditions'=>array("CrmCompany.id"=>$id)));
        if (!$company) {
            throw new NotFoundException(__('Invalid company'));
        }
        $this->set('company', $company);//pr($company);die;
    }
     public function get_contact($id=NULL) {
       $this->layout="";
        if (!$id) {
            throw new NotFoundException(__('Invalid company'));
        }
        $this->loadModel('Contact');
        $company = $this->Contact->find('first',array('conditions'=>array("Contact.id"=>$id)));
        if (!$company) {
            throw new NotFoundException(__('Invalid company'));
        }
        $this->set('company', $company);
//pr($company);die;
    }

     
}
