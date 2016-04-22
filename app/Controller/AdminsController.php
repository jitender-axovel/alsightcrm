<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class AdminsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

      /**
 * admin_email_change method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_email_change($id = null) {
            if($this->Session->read('Auth.User.role')=='admin'){
                if(!empty($this->request->data)){
                    $this->User->updateAll(array('User.email'=>$this->request->data['User']['email']),array('User.id'=>$this->Session->read('Auth.User.id')));
                    $this->Session->setFlash('Your new email has been updated/changed.');
                }
            }else{
                 $this->Session->setFlash('You are not authorised to access this page.');
                 $this->redirect($this->referer());
            }
        
        }  
        
}
