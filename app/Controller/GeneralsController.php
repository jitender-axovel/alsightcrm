<?php
App::uses('AppController', 'Controller');
/**
 * Generals Controller
 *
 * @property General $General
 * @property PaginatorComponent $Paginator
 */
class GeneralsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->General->recursive = 0;
		$this->set('generals', $this->Paginator->paginate());
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

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->General->recursive = 0;
		$this->set('generals', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->General->exists($id)) {
			throw new NotFoundException(__('Invalid general'));
		}
		$options = array('conditions' => array('General.' . $this->General->primaryKey => $id));
		$this->set('general', $this->General->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
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
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
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
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
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
