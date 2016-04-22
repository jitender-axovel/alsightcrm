<?php



App::uses('AppController', 'Controller');



/**

 * Contacts Controller

 *

 */

class ContactsController extends AppController {



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

        $this->Contact->recursive = 0;

        $this->set('contacts', $this->Contact->find('all'));

    }



    /**

     * view method

     *

     * @throws NotFoundException

     * @param string $id

     * @return void

     */

    public function view($id = null) {

        if (!$this->Contact->exists($id)) {

            throw new NotFoundException(__('Invalid contact'));

        }

        $options = array('conditions' => array('Contact.' . $this->Contact->primaryKey => $id));

        $this->set('contact', $this->Contact->find('first', $options));

    }



    /**

     * add method

     *

     * @return void

     */

    public function add() {

        $this->loadModel('CrmCompany');

        $crmCompanies = $this->CrmCompany->find('list',array('fields'=>'CrmCompany.Company_Name'));

        $this->set('crmCompanies',$crmCompanies);
        
        $this->loadModel('Company');
        
        $companies = $this->Company->find('list',array('fields'=>'Company.name'));
        
        $this->set('companies',$companies);


        if ($this->request->is('post')) {

            

            $companyID = $this->Session->read('Auth.User.company_id');

            $emailID = $this->Session->read('Auth.User.email');



            $contactData['Contact'] = $this->request->data['Contact'];

            $contactData['Contact']['company_id'] = $companyID;

            $contactData['Contact']['Updated_by'] = $emailID;

            

            $this->Contact->create();

            if ($this->Contact->save($contactData)) {

                $this->Session->setFlash(__('The contact has been saved.'));

                return $this->redirect(array('action' => 'index'));

            } else {

                $this->Session->setFlash(__('The contact could not be saved. Please, try again.'));

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

        if (!$this->Contact->exists($id)) {

            throw new NotFoundException(__('Invalid contact'));

        }

        if ($this->request->is(array('post', 'put'))) {

            if ($this->Contact->save($this->request->data)) {

                $this->Session->setFlash(__('The contact has been saved.'));

                return $this->redirect(array('action' => 'index'));

            } else {

                $this->Session->setFlash(__('The contact could not be saved. Please, try again.'));

            }

        } else {

            $options = array('conditions' => array('Contact.' . $this->Contact->primaryKey => $id));

            $this->request->data = $this->Contact->find('first', $options);

        }

        $this->loadModel('CrmCompany');

        $crmCompanies = $this->CrmCompany->find('list',array('fields'=>'CrmCompany.Company_Name'));

        $this->set('crmCompanies',$crmCompanies);
        
        $this->loadModel('Company');
        
        $companies = $this->Company->find('list',array('fields'=>'Company.name'));
        
        $this->set('companies',$companies);

    }



    /**

     * delete method

     *

     * @throws NotFoundException

     * @param string $id

     * @return void

     */

    public function delete($id = null) {

        $this->Contact->id = $id;

        if (!$this->Contact->exists()) {

            throw new NotFoundException(__('Invalid contact'));

        }

        $this->request->allowMethod('post', 'delete');

        if ($this->Contact->delete()) {

            $this->Session->setFlash(__('The contact has been deleted.'));

        } else {

            $this->Session->setFlash(__('The contact could not be deleted. Please, try again.'));

        }

        return $this->redirect(array('action' => 'index'));

    }



    /**

     * admin_index method

     *

     * @return void

     */

    public function admin_index() {

        $this->Contact->recursive = 0;

        $this->set('contacts', $this->Paginator->paginate());

    }



    /**

     * admin_view method

     *

     * @throws NotFoundException

     * @param string $id

     * @return void

     */

    public function admin_view($id = null) {

        if (!$this->Contact->exists($id)) {

            throw new NotFoundException(__('Invalid contact'));

        }

        $options = array('conditions' => array('Contact.' . $this->Contact->primaryKey => $id));

        $this->set('contact', $this->Contact->find('first', $options));

    }



    /**

     * admin_add method

     *

     * @return void

     */

    public function admin_add() {

        if ($this->request->is('post')) {

            $this->Contact->create();

            if ($this->Contact->save($this->request->data)) {

                $this->Session->setFlash(__('The contact has been saved.'));

                return $this->redirect(array('action' => 'index'));

            } else {

                $this->Session->setFlash(__('The contact could not be saved. Please, try again.'));

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

        if (!$this->Contact->exists($id)) {

            throw new NotFoundException(__('Invalid contact'));

        }

        if ($this->request->is(array('post', 'put'))) {

            if ($this->Contact->save($this->request->data)) {

                $this->Session->setFlash(__('The contact has been saved.'));

                return $this->redirect(array('action' => 'index'));

            } else {

                $this->Session->setFlash(__('The contact could not be saved. Please, try again.'));

            }

        } else {

            $options = array('conditions' => array('Contact.' . $this->Contact->primaryKey => $id));

            $this->request->data = $this->Contact->find('first', $options);

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

        $this->Contact->id = $id;

        if (!$this->Contact->exists()) {

            throw new NotFoundException(__('Invalid contact'));

        }

        $this->request->allowMethod('post', 'delete');

        if ($this->Contact->delete()) {

            $this->Session->setFlash(__('The contact has been deleted.'));

        } else {

            $this->Session->setFlash(__('The contact could not be deleted. Please, try again.'));

        }

        return $this->redirect(array('action' => 'index'));

    }



}

