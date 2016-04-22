<?php
App::uses('Opportunity', 'Model');

/**
 * Opportunity Test Case
 *
 */
class OpportunityTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.opportunity'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Opportunity = ClassRegistry::init('Opportunity');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Opportunity);

		parent::tearDown();
	}

}
