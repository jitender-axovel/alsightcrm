<?php
App::uses('AppController', 'Controller','contact');
App::uses('CakeEmail','Network/Email');
/**
 * Generals Controller
 *
 */
class Cron1Controller extends AppController {
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
        $this->layout="admin";
    }
    
    public function index(){
        $this->autoRender=false;
        $companyID = 3;
        $this->loadmodel('Company');
        $apple=$this->Company->find('all', array(
                                    'conditions' => array(
                                    "Company.CompanyID" => $companyID)));
        print_r($apple);
		//$apple='hello';
		//imap_mail("jitendersingla88@gmail.com","Requested Data",$apple);
		$Email = new CakeEmail();
		$Email->template('myTemplate')
			->emailFormat('html')
			->from('jitendersingla88@gmail.com')        
			->to('jitendersingla88@gmail.com')
			->subject('hello')
			->viewVars(array('apple'=>$apple)); 
		if($Email->send()){
			$this->Session->setFlash('Mail sent','default',array('class'=>'alert alert-success'));
			return $this->redirect(array('controller'=>'companies','action'=>'index'));
		} else  {
			$this->Session->setFlash('Problem during sending email','default',array('class'=>'alert alert-warning'));
		}
    }
}
?>