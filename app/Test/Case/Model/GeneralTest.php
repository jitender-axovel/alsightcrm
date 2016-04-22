<?php
App::uses('General', 'Model');

/**
 * General Test Case
 *
 */
class GeneralTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.general'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->General = ClassRegistry::init('General');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->General);

		parent::tearDown();
	}

}
