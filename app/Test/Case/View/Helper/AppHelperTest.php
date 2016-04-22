<?php
App::uses('View', 'View');
App::uses('Helper', 'View');
App::uses('AppHelper', 'View/Helper');

/**
 * AppHelper Test Case
 *
 */
class AppHelperTest extends CakeTestCase {

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$View = new View();
		$this->App = new AppHelper($View);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->App);

		parent::tearDown();
	}

}
