<?php

App::uses('AppController', 'Controller');

/**
 * Activities Controller
 *
 */
class ActivitiesController extends AppController {

    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session', 'Auth', 'Paginator');

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
        $this->layout = "admin";
    }

    public function index() {
        $this->Activity->recursive = 2;
        $this->set('activities', $this->Activity->find('all'));
    }
    
    public function get_body($id = NULL){
        $this->layout = "";
        if (!$id) {
            throw new NotFoundException(__('Invalid activity'));
        }
        $activity = $this->Activity->find('first',array('conditions'=>array("Activity.id"=>$id)));
        if (!$activity) {
            throw new NotFoundException(__('Invalid activity'));
        }
        $this->set('activity', $activity);
    }
    
    public function get_content($id = NULL){
        $this->layout = "";
        if (!$id) {
            throw new NotFoundException(__('Invalid activity'));
        }
        $activity = $this->Activity->find('first',array('conditions'=>array("Activity.id"=>$id)));
        if (!$activity) {
            throw new NotFoundException(__('Invalid activity'));
        }
        $this->set('activity', $activity);
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Activity->exists($id)) {
            throw new NotFoundException(__('Invalid activity'));
        }
        $options = array('conditions' => array('Activity.' . $this->Activity->primaryKey => $id));
        $this->set('activity', $this->Activity->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        //die("jhghghgjh");
        
        if ($this->request->is('post')) {
            $this->Activity->create();
            $filename = $this->request->data['Activity']['File']['name']; 
            file_put_contents("files/".$filename,$this->data['Activity']['File']['tmp_name']);
            $this->request->data["Activity"]["File"] = $this->request->data['Activity']['File']['name'];
            if ($this->Activity->save($this->request->data)) {
                $this->Session->setFlash(__('The activity has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The activity could not be saved. Please, try again.'));
            }
        }
        $this->loadModel('Opportunity');
        $this->loadModel('Contact');
        $contacts = $this->Activity->Contact->find('list',array('fields'=>'Contact.Contact_Name'));
        $this->set('contacts',$contacts);
        $opportunities =  $this->Activity->Opportunity->find('list',array('fields'=>'Opportunity.Opportunity_Name'));
        $this->set('opportunities',$opportunities);
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Activity->exists($id)) {
            throw new NotFoundException(__('Invalid activity'));
        }
        if ($this->request->is(array('post', 'put'))) {
            $filename = $this->request->data['Activity']['File']['name']; 
            file_put_contents("files/".$filename,$this->data['Activity']['File']['tmp_name']);
            $this->request->data["Activity"]["File"] = $this->request->data['Activity']['File']['name'];
            if ($this->Activity->save($this->request->data)) {
                $this->Session->setFlash(__('The activity has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The activity could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Activity.' . $this->Activity->primaryKey => $id));
            $this->request->data = $this->Activity->find('first', $options);
        }
        $this->loadModel('Opportunity');
        $this->loadModel('Contact');
        $contacts = $this->Activity->Contact->find('list',array('fields'=>'Contact.Contact_Name'));
        $this->set('contacts',$contacts);
        $opportunities =  $this->Activity->Opportunity->find('list',array('fields'=>'Opportunity.Opportunity_Name'));
        $this->set('opportunities',$opportunities);
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Activity->id = $id;
        if (!$this->Activity->exists()) {
            throw new NotFoundException(__('Invalid activity'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Activity->delete()) {
            $this->Session->setFlash(__('The activity has been deleted.'));
        } else {
            $this->Session->setFlash(__('The activity could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
    
     /**
     * view method
     *
     * @throws NotFoundException
     * @param string $opportunity_ID
     * @return void
     */
    public function showActivityDetail($opportunity_ID = null) {
          $this->Activity->recursive = 2;
        $options = array('conditions' => array('Activity.opportunity_id' => $opportunity_ID));
        $this->set('activities', $this->Activity->find('all', $options));
    }
    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $company_ID
     * @return void
     */
    
    public function showCompanyActivityDetail($company_ID = null) {
        
        $this->loadModel('Opportunity');
        $allOpportunityOfCompany= $this->Opportunity->find('list', array('conditions'=>array('Opportunity.crm_company_id'=>$company_ID),'fields'=>array('Opportunity.id')));
        //pr($allOpportunityOfCompany);die;
        $this->Activity->recursive = 2;
        $options = array('conditions' => array('Activity.opportunity_id' => $allOpportunityOfCompany));
        $this->set('activities', $this->Activity->find('all', $options));
	}
        
            /**
     * view method
     *
     * @throws NotFoundException
     * @param string $company_ID
     * @return void
     */
    
    public function showContactActivityDetail($contact_ID = null) {
        
        
        $this->Activity->recursive = 2;
        $options = array('conditions' => array('Activity.contact_id' => $contact_ID));
        $this->set('activities', $this->Activity->find('all', $options));
	}
            /**
     * view method
     *
     * @throws NotFoundException
     * @param string $updated_By
     * @return void
     */
    
    public function showUpdatedByActivityDetail($oppId=null,$updated_By = null) {
        
        
        $this->Activity->recursive = 2;
        $options = array('conditions' => array('Activity.updated_by' => $updated_By));
        $this->set('activities', $this->Activity->find('all', $options));
	}
}
