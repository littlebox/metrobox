<?php
App::uses('AppModel', 'Model');
/**
 * Client Model
 *
 * @property Reserve $Reserve
 */
class Client extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'full_name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'full_name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		// 'email' => array(
		// 	'email' => array(
		// 		'rule' => array('email'),
		// 		//'message' => 'Your custom message here',
		// 		//'allowEmpty' => false,
		// 		//'required' => false,
		// 		//'last' => false, // Stop validation after this rule
		// 		//'on' => 'create', // Limit validation to 'create' or 'update' operations
		// 	),
		// 	// 'notEmpty' => array(
		// 	// 	'rule' => array('notEmpty'),
		// 	// 	//'message' => 'Your custom message here',
		// 	// 	//'allowEmpty' => false,
		// 	// 	//'required' => false,
		// 	// 	//'last' => false, // Stop validation after this rule
		// 	// 	//'on' => 'create', // Limit validation to 'create' or 'update' operations
		// 	// ),
		// ),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
		public $hasMany = array(
			'Reserve' => array(
				'className' => 'Reserve',
				'foreignKey' => 'client_id',
				'dependent' => false,
				'conditions' => '',
				'fields' => '',
				'order' => '',
				'limit' => '',
				'offset' => '',
				'exclusive' => '',
				'finderQuery' => '',
				'counterQuery' => ''
			),
			'Review' => array(
				'className' => 'Review',
				'foreignKey' => 'client_id',
				'dependent' => false,
				'conditions' => '',
				'fields' => '',
				'order' => '',
				'limit' => '',
				'offset' => '',
				'exclusive' => '',
				'finderQuery' => '',
				'counterQuery' => ''
			),
			'Invoice' => array(
				'className' => 'Invoice',
				'foreignKey' => 'client_id',
				'dependent' => false,
				'conditions' => '',
				'fields' => '',
				'order' => '',
				'limit' => '',
				'offset' => '',
				'exclusive' => '',
				'finderQuery' => '',
				'counterQuery' => ''
			),

		);
}
