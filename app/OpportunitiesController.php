<?php
App::uses('AppController', 'Controller');
/**
 * Opportunities Controller
 *
 */
class OpportunitiesController extends AppController {
    var $components = array('Auth');
/**
 * Scaffold
 *
 * @var mixed
 */
	public $scaffold;
        function beforeFilter(){ 
            $this->Auth->userModel = 'User'; 
            $this->Auth->allow(array('index', 'view')); 
            $user = $this->Auth->user(); 
            //if(!$this->Acl->check('User::'.$user['User']['id'], 'company', 'update')) die('you are not authorized');
            //if(!$this->Access->check('Company', 'update')) die('you are not authorized');
        }
}
