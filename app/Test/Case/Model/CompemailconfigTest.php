<?php
App::uses('Compemailconfig', 'Model');

/**
 * Compemailconfig Test Case
 *
 */
class CompemailconfigTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.compemailconfig'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Compemailconfig = ClassRegistry::init('Compemailconfig');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Compemailconfig);

		parent::tearDown();
	}

}
