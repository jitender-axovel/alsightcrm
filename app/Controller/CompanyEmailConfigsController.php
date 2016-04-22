<?php

App::uses('AppController', 'Controller');

/**
 * CompanyEmailConfigs Controller
 *
 */
class CompanyEmailConfigsController extends AppController {

    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session', 'Auth', 'Paginator');

    /**
     * Scaffold
     *
     * @var mixed
     */
    public $scaffold;

    function beforeFilter() {
        $this->Auth->userModel = 'User';
        $this->Auth->allow(array());
        $user = $this->Auth->user();
        $this->layout = "admin";
    }

    public function index() {
        $this->CompanyEmailConfig->recursive = 0;
        $this->set('companyEmailConfigs', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->CompanyEmailConfig->exists($id)) {
            throw new NotFoundException(__('Invalid company email config'));
        }
        $options = array('conditions' => array('CompanyEmailConfig.' . $this->CompanyEmailConfig->primaryKey => $id));
        $this->set('companyEmailConfig', $this->CompanyEmailConfig->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->CompanyEmailConfig->create();
            if ($this->CompanyEmailConfig->save($this->request->data)) {
                $this->Session->setFlash(__('The company email config has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The company email config could not be saved. Please, try again.'));
            }
        }
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->CompanyEmailConfig->exists($id)) {
            throw new NotFoundException(__('Invalid company email config'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->CompanyEmailConfig->save($this->request->data)) {
                $this->Session->setFlash(__('The company email config has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The company email config could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('CompanyEmailConfig.' . $this->CompanyEmailConfig->primaryKey => $id));
            $this->request->data = $this->CompanyEmailConfig->find('first', $options);
        }
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->CompanyEmailConfig->id = $id;
        if (!$this->CompanyEmailConfig->exists()) {
            throw new NotFoundException(__('Invalid company email config'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->CompanyEmailConfig->delete()) {
            $this->Session->setFlash(__('The company email config has been deleted.'));
        } else {
            $this->Session->setFlash(__('The company email config could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index() {
        $this->CompanyEmailConfig->recursive = 0;
        $this->set('companyEmailConfigs', $this->Paginator->paginate());
    }

    /**
     * admin_view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_view($id = null) {
        if (!$this->CompanyEmailConfig->exists($id)) {
            throw new NotFoundException(__('Invalid company email config'));
        }
        $options = array('conditions' => array('CompanyEmailConfig.' . $this->CompanyEmailConfig->primaryKey => $id));
        $this->set('companyEmailConfig', $this->CompanyEmailConfig->find('first', $options));
    }

    /**
     * admin_add method
     *
     * @return void
     */
    public function admin_add() {
        if ($this->request->is('post')) {
            $this->CompanyEmailConfig->create();
            if ($this->CompanyEmailConfig->save($this->request->data)) {
                $this->Session->setFlash(__('The company email config has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The company email config could not be saved. Please, try again.'));
            }
        }
    }

    /**
     * admin_edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_edit($id = null) {
        if (!$this->CompanyEmailConfig->exists($id)) {
            throw new NotFoundException(__('Invalid company email config'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->CompanyEmailConfig->save($this->request->data)) {
                $this->Session->setFlash(__('The company email config has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The company email config could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('CompanyEmailConfig.' . $this->CompanyEmailConfig->primaryKey => $id));
            $this->request->data = $this->CompanyEmailConfig->find('first', $options);
        }
    }

    /**
     * admin_delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_delete($id = null) {
        $this->CompanyEmailConfig->id = $id;
        if (!$this->CompanyEmailConfig->exists()) {
            throw new NotFoundException(__('Invalid company email config'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->CompanyEmailConfig->delete()) {
            $this->Session->setFlash(__('The company email config has been deleted.'));
        } else {
            $this->Session->setFlash(__('The company email config could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
