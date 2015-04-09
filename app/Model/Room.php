<?php
App::uses('AppModel', 'Model');
/**
 * Room Model
 *
 * @property Estate $Estate
 */
class Room extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Estate' => array(
			'className' => 'Estate',
			'joinTable' => 'estates_rooms',
			'foreignKey' => 'room_id',
			'associationForeignKey' => 'estate_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	);

}
