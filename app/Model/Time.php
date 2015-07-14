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

	public $virtualFields = array(
		'quota_available' => 'SELECT "Not setted"', //Set this field in controller
	);

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
