<?php
/**
 * GeneralFixture
 *
 */
class GeneralFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'general';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'GeneralID' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 255, 'unsigned' => false, 'key' => 'primary'),
		'My_company' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'Email_extension' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'Last_updated' => array('type' => 'timestamp', 'null' => false, 'default' => null),
		'Updated_by' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'GeneralID', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'GeneralID' => 1,
			'My_company' => 'Lorem ipsum dolor sit amet',
			'Email_extension' => 'Lorem ipsum dolor sit amet',
			'Last_updated' => 1433165446,
			'Updated_by' => 'Lorem ipsum dolor sit amet'
		),
	);

}
