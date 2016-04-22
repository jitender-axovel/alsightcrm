<?php

App::uses('AppController', 'Controller');

/**
 * Companies Controller
 *
 */
class CompaniesController extends AppController {

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
        if ($this->Session->check('Auth.User.id') != 1) {
            $this->redirect('/');
        }
        //if(!$this->Acl->check('User::'.$user['User']['id'], 'Company', 'update')) die('you are not authorized');
        //if(!$this->Access->check('Company', 'update')) die('you are not authorized');
    }

    public function index() {
        if ($this->Session->read('Auth.User.role') != "admin" && $this->Session->read('Auth.User.role') == "company") {
            $this->Session->setFlash("You are not authorised to view this page.");
            $this->redirect('/employees');
        }
        $this->layout = "admin";

        $this->set('companies', $this->Paginator->paginate());
    }

    public function view($id) {
        $this->layout = "admin";
        if (!$id) {
            throw new NotFoundException(__('Invalid company'));
        }

        $company = $this->Company->find('first', array('conditons' => array('Company.companyID=>$id')));
        if (!$company) {
            throw new NotFoundException(__('Invalid company'));
        }
        $this->set('company', $company);
    }

    public function add() {
        if ($this->Session->read('Auth.User.role') != "admin") {
            $this->Session->setFlash("You are not authorised to add a Company");
            $this->redirect('/');
        }
        $this->layout = "admin";
        if ($this->data) {
            $companyName = $this->request->data['Company']['Company_Name'];
            $companyName = strtolower($companyName);
            $checkCompanyName = array();
            $checkCompanyName = $this->Company->find('first',array('fields'=>'Company.Company_Name','conditions'=>array('Company.Company_Name'=>$companyName)));
            
            if(!empty($checkCompanyName)) {
                $checkCompanyName = strtolower($checkCompanyName['Company']['Company_Name']);
                if ($companyName == $checkCompanyName) {
                    $this->Session->setFlash(__('Company with same name already exists'));
                    return $this->redirect(array('action' => 'index'));
                }
            }

            $this->loadmodel('User');
            $user['User']['email'] = $this->request->data['User']['email'];
            $user['User']['password'] = Security::hash($this->request->data['User']['password'], 'sha1', true);
            $user['User']['company_id'] = 1;
            $user['User']['role'] = 'company';
            $user['User']['user_company_code'] = 'asdfgh';
            $this->User->save($user);
            
            $userid = $this->User->getLastInsertID();
            $companyData['Company'] = $this->request->data['Company'];
            $companyData['Company']['User_ID'] = $userid;
            $this->Company->create();
            if ($this->Company->save($companyData)) {
                $companyID = $this->Company->getLastInsertID();
                $user_id = $this->User->find('first',array('fields'=>'User.user_id','conditions'=>array('User.id'=>$userid)));
                $empcode = "'".$companyName.'-'.$companyID.'-'.$user_id['User']['user_id']."'";
                $this->User->updateAll(
                        array('User.company_id' => $companyID,'User.user_company_code' => $empcode),
                        array('User.id' => $userid)
                );
                //$userData['User']['company_id'] = $companyID;
                //$this->User->save($userData);
                $this->Session->setFlash(__('Your company has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to add company.'));
        }
    }

    public function edit($id = null) {
        if ($this->Session->read('Auth.User.role') != "admin" && $this->Session->read('Auth.User.role') == "company") {
            $this->Session->setFlash("You are not authorised to add a Company");
            $this->redirect('/employees');
        }
        $this->layout = "admin";
        if (!$id) {
            throw new NotFoundException(__('Invalid company'));
        }

        $company = $this->Company->find('first', array('conditions' => array('Company.companyID' => $id)));
        if (!$company) {
            throw new NotFoundException(__('Invalid company'));
        }

        if ($this->request->is(array('company', 'put'))) {
            $this->Company->id = $id;
            if ($this->Company->save($this->request->data)) {
                $this->Session->setFlash(__('Your company has been updated.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to update your company.'));
        }

        if (!$this->request->data) {
            $this->request->data = $company;
        }
    }

    public function delete($id) {
        if ($this->Session->read('Auth.User.role') != "admin") {
            $this->Session->setFlash("You are not authorised to delete a Company");
            $this->redirect('/');
        }
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if ($this->Company->delete($id)) {
            $this->Session->setFlash(
                    __('The company with id: %s has been deleted.', h($id))
            );
            return $this->redirect(array('action' => 'index'));
        }
    }

}
