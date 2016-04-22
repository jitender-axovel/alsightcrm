<?php

App::uses('AppModel', 'Model');

/**

 * Company Model

 *

 */
class User extends AppModel {

    
    public $primaryKey = 'id';
    
    public $hasOne = array(
        'CrmCompany' => array(
            'className' => 'CrmCompany',
            'dependent' => true
        )
    );
    
    public $validate = array(
        'users' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty')
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'username' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty')
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'email' => array(
            'rule' => array('email',true),
            'message' => 'Not a valid email address.',
            //'allowEmpty' => false,
            'required' => true
        //'last' => false, // Stop validation after this rule
        //'on' => 'create', // Limit validation to 'create' or 'update' operations
        ),
        'password' => array(
                'rule' => array('minLength', 8),
                'message' => 'Length should be minimum 8 characters long',
                //'allowEmpty' => false,
                'required' => true
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
        ),
        'temppassword' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty')
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
    );

}
