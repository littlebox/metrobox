<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {

	public $belongsTo = array('Group');
	public $actsAs = array('Acl' => array('type' => 'requester', 'enabled' => false));

	//for internal acl propose
	public function parentNode() {
		if (!$this->id && empty($this->data)) {
			return null;
		}
		if (isset($this->data['User']['group_id'])) {
			$groupId = $this->data['User']['group_id'];
		} else {
			$groupId = $this->field('group_id');
		}
		if (!$groupId) {
			return null;
		} else {
			return array('Group' => array('id' => $groupId));
		}
	}

	//for internal acl propose
	public function bindNode($user) {
		return array('model' => 'Group', 'foreign_key' => $user['User']['group_id']);
	}

	public $validate = array(
		'email' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => 'An email is required'
				),
			'email'=> array(
				'rule' => 'email',
				'message' => 'Must be an email'
				),
			'isUnique'=> array(
				'rule' => 'isUnique',
				'message' => 'Email already exist'
				),
		),
		'full_name' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => 'A name is required'
				),
		),
		'password' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'A password is required'
			)
		),
		'password_confirm' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'Please confirm your password'
			),
			'equaltofield' => array(
				'rule' => array('equaltofield','password'),
				'message' => 'Passwords don\'t match.'
			)
		),

		'profile_picture' => array(
			'rule' => array('checkValidImage'),
			'required' => false,
		)

	);

	public function checkValidImage($field){

		if(!empty($field['profile_picture']['name'])){
			$extension = array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/x-png', 'image/png', 'image/jpg');
			$isValidFile = in_array($field['profile_picture']['type'], $extension) && is_uploaded_file($field['profile_picture']['tmp_name']);
			$errors = array();
			$editMethod = false;

			if (($field['profile_picture']['error'] == 1)){
				$errors [] = "Please upload jpg,png or gif files with size 2 MB or less.";
			}

			else if (empty($field['profile_picture']['name'])){
				$errors [] = "Please upload image";
			}

			else if ($field['profile_picture']['size'] >= 2097152) {
				$errors [] = "Please upload jpg,png or gif files with size 2 MB or less.";
			}

			else if ($isValidFile !=1){
				$errors [] = "Please select file in gif,jpeg,png format.";
			}

		}
		// else{
		// 	$errors [] = "Please select file in gif,jpeg,png format.";
		// }

		if (!empty($errors)){
			return implode("\n", $errors);
		}

		return true;
	}

	public function equaltofield($check,$otherfield){
		//get name of field
		$fname = '';
		foreach ($check as $key => $value){
			$fname = $key;
			break;
		}
		return $this->data[$this->name][$otherfield] === $this->data[$this->name][$fname];
	}

	public function beforeSave($options = array()) {
	if (isset($this->data[$this->alias]['password'])) {
		$passwordHasher = new BlowfishPasswordHasher();
		$this->data[$this->alias]['password'] = $passwordHasher->hash(
			$this->data[$this->alias]['password']
		);
	}
	return true;
	}

}
