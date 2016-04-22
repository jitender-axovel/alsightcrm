<?php
App::uses('AppModel', 'Model');
/**
 * General Model
 *
 */
class General extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'general';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'GeneralID';

}
