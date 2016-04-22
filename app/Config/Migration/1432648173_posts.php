<?php
class Posts extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 */
	public $description = 'posts';

/**
 * Actions to be performed
 *
 * @var array $migration
 */
	public $migration = array(
		'up' => array(
			'create_table' => array(
				'activities' => array(
					'activityid' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 255, 'unsigned' => false, 'key' => 'primary'),
					'Subject' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'Email_body' => array('type' => 'binary', 'null' => true, 'default' => null),
					'content' => array('type' => 'binary', 'null' => true, 'default' => null),
					'OppID' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 255, 'unsigned' => false, 'key' => 'index'),
					'ContactID' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 255, 'unsigned' => false, 'key' => 'index'),
					'Notification_time' => array('type' => 'timestamp', 'null' => false, 'default' => null),
					'Notification_detail' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'Notification_email' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'Criteria' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'File' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'Last_Update' => array('type' => 'timestamp', 'null' => false, 'default' => null),
					'Updated_by' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'indexes' => array(
						'PRIMARY' => array('column' => 'activityid', 'unique' => 1),
						'OppID' => array('column' => 'OppID', 'unique' => 0),
						'ContactID' => array('column' => 'ContactID', 'unique' => 0),
					),
					'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB'),
				),
				'companies' => array(
					'companyID' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 255, 'unsigned' => false, 'key' => 'primary'),
					'Company' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'Company_Group' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'Last_updated' => array('type' => 'timestamp', 'null' => false, 'default' => null),
					'Updated_by' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'indexes' => array(
						'PRIMARY' => array('column' => 'companyID', 'unique' => 1),
					),
					'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB'),
				),
				'contacts' => array(
					'ContactID' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 255, 'unsigned' => false, 'key' => 'primary'),
					'Detail' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'CompanyID' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 255, 'unsigned' => false, 'key' => 'index'),
					'Last_Update' => array('type' => 'timestamp', 'null' => false, 'default' => null),
					'Updated_by' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'indexes' => array(
						'PRIMARY' => array('column' => 'ContactID', 'unique' => 1),
						'CompanyID' => array('column' => 'CompanyID', 'unique' => 0),
					),
					'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB'),
				),
				'general' => array(
					'GeneralID' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 255, 'unsigned' => false, 'key' => 'primary'),
					'My_company' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'Email_extension' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'Last_updated' => array('type' => 'timestamp', 'null' => false, 'default' => null),
					'Updated_by' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'indexes' => array(
						'PRIMARY' => array('column' => 'GeneralID', 'unique' => 1),
					),
					'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB'),
				),
				'opportunities' => array(
					'OppID' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 255, 'unsigned' => false, 'key' => 'primary'),
					'Opportunity' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'Detail' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'Status_details' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'Value' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 30, 'unsigned' => false),
					'Keywords' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'companyID' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 255, 'unsigned' => false, 'key' => 'index'),
					'Last_update' => array('type' => 'timestamp', 'null' => false, 'default' => null),
					'Updated_by' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'indexes' => array(
						'PRIMARY' => array('column' => 'OppID', 'unique' => 1),
						'companyID' => array('column' => 'companyID', 'unique' => 0),
					),
					'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB'),
				),
				'temp' => array(
					'UserID' => array('type' => 'string', 'null' => false, 'default' => null, 'key' => 'primary', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'GeneralID' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 255, 'unsigned' => false, 'key' => 'index'),
					'Email' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'Name' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'Password' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'Last_visit' => array('type' => 'timestamp', 'null' => false, 'default' => null),
					'Profile' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'Last_update' => array('type' => 'timestamp', 'null' => false, 'default' => null),
					'MD_auth' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'Updated_by' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'indexes' => array(
						'PRIMARY' => array('column' => 'UserID', 'unique' => 1),
						'GeneralID' => array('column' => 'GeneralID', 'unique' => 0),
					),
					'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB'),
				),
				'users' => array(
					'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'username' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 20, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'password' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
					'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
					'active' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 2, 'unsigned' => false),
					'email_verified' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 2, 'unsigned' => false),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
					),
					'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB'),
				),
			),
		),
		'down' => array(
			'drop_table' => array(
				'activities', 'companies', 'contacts', 'general', 'opportunities', 'temp', 'users'
			),
		),
	);

/**
 * Before migration callback
 *
 * @param string $direction Direction of migration process (up or down)
 * @return bool Should process continue
 */
	public function before($direction) {
		return true;
	}

/**
 * After migration callback
 *
 * @param string $direction Direction of migration process (up or down)
 * @return bool Should process continue
 */
	public function after($direction) {
		return true;
	}
}
