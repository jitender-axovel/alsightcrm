<?php

App::uses('AppController', 'Controller');

/**

 * Companies Controller

 *

 */
class EmployeesController extends AppController {

    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session', 'Auth', 'Paginator');
    public $uses = array('User');

//    var $components = array('Auth');

    /**

     * Scaffold

     *

     * @var mixed

     */
    public function index($companyID = null) {

        $this->layout = "admin";

        $this->User->recursive = 2;

        if ($this->Session->read('Auth.User.role') == "company") {

            $companyID = $this->Session->read('Auth.User.crm_company_id');

            $users = $this->User->find('all',array('conditions' => array('User.role' => 'employee', 'User.crm_company_id' => $companyID)));

            $this->set('users', $users);
        }

        if ($this->Session->read('Auth.User.role') == "admin") {

            $codi = array('conditions' => array('User.role' => 'employee'));

            $this->set('users', $this->User->find('all', $codi));
        }

        if ($this->Session->read('Auth.User.role') == "employee") {
            $this->Session->setFlash("As an employee you can not see details of other employees.");
            $userID = $this->Session->read('Auth.User.id');
            $this->redirect("view/$userID");
        }
    }

    public function view($id) {

//         $id=$_SESSION['Aurth']['User']['user_id'];

        $this->layout = "admin";

        if (!$id) {

            throw new NotFoundException(__('Invalid employee'));
        }



        $employee = $this->User->find('first', array('conditions' => array('User.id' => $id)));

        if (!$employee) {

            throw new NotFoundException(__('Invalid employee'));
        }

        $this->set('employee', $employee);
    }

    public function add() {

        if ($this->Session->read('Auth.User.role') != "company") {

            $this->Session->setFlash("You are not authorised to add an Employee,Only a company admin can add Employee");

            $this->redirect('/');
        }

        $this->layout = "admin";

        if (!empty($this->request->data)) {

            //pr($_SESSION);die;

            $this->loadModel('CrmCompany');
            $companyID = $this->Session->read('Auth.User.crm_company_id');
            $company = $this->CrmCompany->find(
                    'first', array(
                'fields' => 'CrmCompany.Company_Name',
                'conditions' => array(
                    'CrmCompany.id' => $companyID
                )
            ));
            $empcode = strtolower($company['CrmCompany']['Company_Name']) . '-' . $companyID . '-' . rand(1000, 9999);

            $this->User->create();

            $user = $this->request->data;

            $user['User']['password'] = Security::hash($this->request->data['User']['password'], 'sha1', true);

            $user['User']['last_login'] = date('Y-m-d h:i:s');

            $user['User']['crm_company_id'] = $this->Session->read('Auth.User.crm_company_id');

            $user['User']['user_company_code'] = $empcode;

            //  $user['User']['company_id'] = $this->Session();
            //pr($user);die;

            if ($this->User->save($user)) {

                $id = $this->User->getLastInsertID();

                $user_id = $this->User->find('first', array('fields' => 'User.user_id', 'conditions' => array('User.id' => $id)));

                $empcode = "'" . strtolower($company['CrmCompany']['Company_Name']) . '-' . $companyID . '-' . $user_id['User']['user_id'] . "'";

                $this->User->updateAll(
                        array('User.user_company_code' => $empcode), array('User.id' => $id)
                );

                $this->Session->setFlash(__('Your employee has been saved.'));

                return $this->redirect(array('action' => 'index'));
            }

            $this->Session->setFlash(__('Unable to add your employee.'));
        }
    }

    public function edit($id = null) {

        $this->layout = "admin";
        
        $this->loadModel('User');
        
        if (!$id) {

            throw new NotFoundException(__('Invalid employee'));
        }
        $this->set('id',$id);
        $employee = $this->User->find('first', array('conditons' => array('User.employeeID=>$id')));
        $user = $this->User->find('first', array('conditions' => array('User.id' => $id, 'User.role' => 'employee')));
        if (!$employee) {

            throw new NotFoundException(__('Invalid employee'));
        }
        
        $input = $this->request->data['Employee']['username'];
        
        if ($this->request->is(array('post', 'put'))) {
            
            if (array_key_exists('ChangePassword', $this->request->data['Employee'])) {
                if ($user['User']['password'] == $this->Auth->password($this->request->data['User']['old_password'])) {
                    if ($this->request->data['User']['new_password'] == $this->request->data['User']['confirm_password'] && $this->request->data['User']['new_password'] != '') {
                        $newpass = "'".Security::hash($this->request->data['User']['new_password'], 'sha1', true)."'";
                        $this->User->updateAll(
                                array('User.password'=> $newpass),
                                array('User.id'=>$user['User']['id'])
                        );
                    } else {
                        $this->Session->setFlash(__("New paswword is different from confirm password or you didn't entered any password."));

                        return $this->redirect(array('action' => 'edit/' . $user['User']['id']));
                    }
                } else {
                    $this->Session->setFlash(__("Old password doesn't match."));

                    return $this->redirect(array('action' => 'edit/' . $user['User']['id']));
                }
            }
            
            $username = $this->request->data['Employee']['username'];
            if($this->User->updateAll(
                    array('User.username'=>"'".$username."'"),
                    array('User.id'=>$id)
                    )) {
                $this->Session->setFlash(__('Your employee has been updated.'));

                return $this->redirect(array('action' => 'index'));
            }

            $this->Session->setFlash(__('Unable to update your employee.'));
        }

        if (!$this->request->data) {

            $this->request->data = $employee;
        }
    }

    public function delete($id) {

        if ($this->request->is('get')) {

            throw new MethodNotAllowedException();
        }



        if ($this->User->delete($id)) {

            $this->Session->setFlash(
                    __('The employee with id: %s has been deleted.', h($id))
            );

            return $this->redirect(array('action' => 'index'));
        }
    }

}
