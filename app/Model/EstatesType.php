<?php
App::uses('AppModel', 'Model');
/**
 * EstatesType Model
 *
 */
class EstatesType extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'estates_type';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'type';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
	);
}
