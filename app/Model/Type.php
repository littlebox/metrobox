<?php
App::uses('AppModel', 'Model');
/**
 * Type Model
 *
 * @property Estate $Estate
 */
class Type extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'type';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Estate' => array(
			'className' => 'Estate',
			'foreignKey' => 'type_id',
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
