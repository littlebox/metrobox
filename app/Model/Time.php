<?php
App::uses('AppModel', 'Model');
/**
 * Time Model
 *
 * @property Tour $Tour
 */
class Time extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'hour';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Tour' => array(
			'className' => 'Tour',
			'joinTable' => 'tours_times',
			'foreignKey' => 'time_id',
			'associationForeignKey' => 'tour_id',
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
