<?php

App::uses('AppController', 'Controller');

/**
 * Generals Controller
 *
 */
class GeneralController extends AppController {

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
        $this->General->recursive = 0;
        $this->set('generals', $this->General->find('all'));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->General->exists($id)) {
            throw new NotFoundException(__('Invalid general'));
        }
        $options = array('conditions' => array('General.' . $this->General->primaryKey => $id));
        $this->set('general', $this->General->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->General->create();
            if ($this->General->save($this->request->data)) {
                $this->Session->setFlash(__('The general has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The general could not be saved. Please, try again.'));
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
        if (!$this->General->exists($id)) {
            throw new NotFoundException(__('Invalid general'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->General->save($this->request->data)) {
                $this->Session->setFlash(__('The general has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The general could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('General.' . $this->General->primaryKey => $id));
            $this->request->data = $this->General->find('first', $options);
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
        $this->General->id = $id;
        if (!$this->General->exists()) {
            throw new NotFoundException(__('Invalid general'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->General->delete()) {
            $this->Session->setFlash(__('The general has been deleted.'));
        } else {
            $this->Session->setFlash(__('The general could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
