<?php

App::uses('AppController', 'Controller');

/**
 * Opportunities Controller
 *
 */
class OpportunitiesController extends AppController {

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
        $this->Opportunity->recursive = 0;
        $this->set('opportunities', $this->Opportunity->find('all'));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Opportunity->exists($id)) {
            throw new NotFoundException(__('Invalid opportunity'));
        }
        $options = array('conditions' => array('Opportunity.' . $this->Opportunity->primaryKey => $id));
        $this->set('opportunity', $this->Opportunity->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Opportunity->create();
            if ($this->Opportunity->save($this->request->data)) {
                $this->Session->setFlash(__('The opportunity has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The opportunity could not be saved. Please, try again.'));
            }
        }
        $this->loadModel('CrmCompany');
        $this->loadModel('Contact');
        $companies = $this->CrmCompany->find('list',array('fields'=>'CrmCompany.Company_Name'));
        $contacts = $this->Contact->find('list',array('fields'=>'Contact.Contact_Name'));
        $this->set('companies',$companies);
        $this->set('contacts',$contacts);
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Opportunity->exists($id)) {
            throw new NotFoundException(__('Invalid opportunity'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Opportunity->save($this->request->data)) {
                $this->Session->setFlash(__('The opportunity has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The opportunity could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Opportunity.' . $this->Opportunity->primaryKey => $id));
            $this->request->data = $this->Opportunity->find('first', $options);
        }
        $this->loadModel('CrmCompany');
        $this->loadModel('Contact');
        $companies = $this->CrmCompany->find('list',array('fields'=>'CrmCompany.Company_Name'));
        $contacts = $this->Contact->find('list',array('fields'=>'Contact.Contact_Name'));
        $this->set('companies',$companies);
        $this->set('contacts',$contacts);
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Opportunity->id = $id;
        if (!$this->Opportunity->exists()) {
            throw new NotFoundException(__('Invalid opportunity'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Opportunity->delete()) {
            $this->Session->setFlash(__('The opportunity has been deleted.'));
        } else {
            $this->Session->setFlash(__('The opportunity could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
    
    
      /**
     * showCompanyOpportunityDetail method
     *
     * @throws NotFoundException
     * @param string $company_ID
     * @return void
     */
    public function showCompanyOpportunityDetail($company_ID) {
        $this->Opportunity->recursive = 0;
        $this->set('opportunities', $this->Opportunity->find('all',array('conditions'=>array('Opportunity.crm_company_id'=>$company_ID))));
    }
      /**
     * showCompanyOpportunityDetail method
     *
     * @throws NotFoundException
     * @param string $company_ID
     * @return void
     */
    public function showContactOpportunityDetail($contact_ID) {
        $this->Opportunity->recursive = 0;
        $this->set('opportunities', $this->Opportunity->find('all',array('conditions'=>array('Opportunity.contact_id'=>$contact_ID))));
    }

}
