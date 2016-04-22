<?php

App::uses('AppModel', 'Model');

/**

 * Contact Model

 *

 */

class Contact extends AppModel {



/**

 * Primary key field

 *

 * @var string

 */

	public $primaryKey = 'id';
        
        var $name = 'Contact';
        var $hasMany = array(
            'Activity' => array(
                'dependent' => true
            )
        );
        
        var $belongsTo = array(
            'CrmCompany' => array(
                'className' => 'CrmCompany',
                'foreignKey' => 'crm_company_id'
            )
        );



/**

 * Validation rules

 *

 * @var array

 */

	public $validate = array(

		//'Contact_Name' => array(

			//'notEmpty' => array(

				//'rule' => array('notEmpty'),

				//'message' => 'Your custom message here',

				//'allowEmpty' => false,

				//'required' => false,

				//'last' => false, // Stop validation after this rule

				//'on' => 'create', // Limit validation to 'create' or 'update' operations

			//),

		//),

		'Contact_Email' => array(

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

