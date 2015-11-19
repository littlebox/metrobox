<?php
App::uses('AppModel', 'Model');
/**
 * Holiday Model
 *
 */
class Holiday extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'day';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'day' => array(
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
}
