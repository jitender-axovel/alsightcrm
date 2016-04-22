<?php
App::uses('CompanyEmailConfig', 'Model');

/**
 * CompanyEmailConfig Test Case
 *
 */
class CompanyEmailConfigTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.company_email_config'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->CompanyEmailConfig = ClassRegistry::init('CompanyEmailConfig');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->CompanyEmailConfig);

		parent::tearDown();
	}

}
