<?php

App::uses('AppModel', 'Model');

/**

 * CompanyEmailConfig Model

 *

 */

class CompanyEmailConfig extends AppModel {



/**

 * Primary key field

 *

 * @var string

 */

	public $primaryKey = 'id';



/**

 * Validation rules

 *

 * @var array

 */

	public $validate = array(

		'EmailID' => array(

			'notEmpty' => array(

				'rule' => array('notEmpty')

				//'message' => 'Your custom message here',

				//'allowEmpty' => false,

				//'required' => false,

				//'last' => false, // Stop validation after this rule

				//'on' => 'create', // Limit validation to 'create' or 'update' operations

			),

		),

		'password' => array(

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

