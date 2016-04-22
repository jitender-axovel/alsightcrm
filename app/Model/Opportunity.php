<?php
App::uses('AppModel', 'Model');
/**
 * Opportunity Model *
 */
 class Opportunity extends AppModel {
	 /**
	 * Primary key field
	 *
	 * @var string
	 */
	 public $primaryKey = 'id';
	 var $name = 'Opportunity';
	 public $belongsTo = array(
		'CrmCompany' => array(
			'foreignKey' => 'crm_company_id'
        ),
		'Contact' => array(
			'foreignKey' => 'contact_id'
        )
    );
}
?>