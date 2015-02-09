<?php
App::uses('AppModel', 'Model');
/**
 * Operation Model
 *
 * @property Estate $Estate
 */
class Operation extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'operation';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Estate' => array(
			'className' => 'Estate',
			'foreignKey' => 'operation_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
