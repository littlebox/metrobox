<?php
App::uses('AppModel', 'Model');
/**
 * Estate Model
 *
 * @property Agency $Agency
 * @property Type $Type
 * @property Subtype $Subtype
 * @property Operation $Operation
 * @property Currency $Currency
 * @property Condition $Condition
 * @property Disposition $Disposition
 * @property BuildingType $BuildingType
 * @property BuildingCondition $BuildingCondition
 * @property BuildingCategory $BuildingCategory
 * @property Image $Image
 * @property Message $Message
 * @property Extra $Extra
 * @property Room $Room
 * @property Service $Service
 */
class Estate extends AppModel {

	public $actsAs = array('Containable', 'Linkable');


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Agency' => array(
			'className' => 'Agency',
			'foreignKey' => 'agency_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Type' => array(
			'className' => 'Type',
			'foreignKey' => 'type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Subtype' => array(
			'className' => 'Subtype',
			'foreignKey' => 'subtype_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Operation' => array(
			'className' => 'Operation',
			'foreignKey' => 'operation_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Currency' => array(
			'className' => 'Currency',
			'foreignKey' => 'currency_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Condition' => array(
			'className' => 'Condition',
			'foreignKey' => 'condition_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Disposition' => array(
			'className' => 'Disposition',
			'foreignKey' => 'disposition_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'BuildingType' => array(
			'className' => 'BuildingType',
			'foreignKey' => 'building_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'BuildingCondition' => array(
			'className' => 'BuildingCondition',
			'foreignKey' => 'building_condition_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'BuildingCategory' => array(
			'className' => 'BuildingCategory',
			'foreignKey' => 'building_category_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Image' => array(
			'className' => 'Image',
			'foreignKey' => 'estate_id',
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
		'Message' => array(
			'className' => 'Message',
			'foreignKey' => 'estate_id',
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


/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Extra' => array(
			'className' => 'Extra',
			'joinTable' => 'estates_extras',
			'foreignKey' => 'estate_id',
			'associationForeignKey' => 'extra_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		),
		'Room' => array(
			'className' => 'Room',
			'joinTable' => 'estates_rooms',
			'foreignKey' => 'estate_id',
			'associationForeignKey' => 'room_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		),
		'Service' => array(
			'className' => 'Service',
			'joinTable' => 'estates_services',
			'foreignKey' => 'estate_id',
			'associationForeignKey' => 'service_id',
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
