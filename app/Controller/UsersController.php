<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {

	/*public function initDB() {
		$group = $this->User->Group;

		// Allow admins to everything
		$group->id = 1;
		$this->Acl->allow($group, 'controllers');

		// allow managers to posts and widgets
		$group->id = 2;
		$this->Acl->deny($group, 'controllers');
		$this->Acl->allow($group, 'controllers/Posts');
		$this->Acl->allow($group, 'controllers/Widgets');

		// allow users to only add and edit on posts and widgets
		$group->id = 3;
		$this->Acl->deny($group, 'controllers');
		$this->Acl->allow($group, 'controllers/Users/login');
		$this->Acl->allow($group, 'controllers/Users/logout');
		$this->Acl->allow($group, 'controllers/Pages/index');
		$this->Acl->allow($group, 'controllers/Posts/edit');
		$this->Acl->allow($group, 'controllers/Widgets/add');
		$this->Acl->allow($group, 'controllers/Widgets/edit');

		// allow basic users to log out
		$this->Acl->allow($group, 'controllers/users/logout');

		// we add an exit to avoid an ugly "missing views" error message
		echo "all done";
		exit;
	}*/

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('add', 'forgetPassword', 'resetPassword', 'login', 'initDB');

	}

	public function index() {
		$this->layout = 'metrobox';
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	public function view($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(
				__('The user could not be saved. Please, try again.')
			);
		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}

	public function edit($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(
				__('The user could not be saved. Please, try again.')
			);
		} else {
			$this->request->data = $this->User->read(null, $id);
			unset($this->request->data['User']['password']);
		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}

	public function delete($id = null) {
		$this->request->allowMethod('post');

		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}


	public function login() {

		$this->layout = 'metrobox_login';

		$min_attempts_show_captcha = 2;
		$this->set('min_attempts_show_captcha',$min_attempts_show_captcha);
		$time_to_count_an_attempt = '-5 minutes';

		if($this->Auth->loggedIn()){
			return $this->redirect($this->Auth->redirect());
		}

		if ($this->request->is('post')) {

			$user = $this->User->find('first', array(

					'conditions' => array(
						'User.email' => $this->request->data['User']['email'],
					),

					'fields' => array(
						'id','login_last_attempt','login_last_attempts_count'
					)

				));

			if($user){

				$attempts_count = $user['User']['login_last_attempts_count'];

				$this->set('attempts_count',$attempts_count);

				if( $attempts_count >= $min_attempts_show_captcha &&
					strtotime($user['User']['login_last_attempt']) > strtotime($time_to_count_an_attempt)){

					if (!$this->Recaptcha->verify()) {

						$this->Session->setFlash($this->Recaptcha->error, 'metrobox_flash_login');
						return null;
					}
				}

			}

			if ($this->Auth->login()) {

				$this->_setCookie($this->Auth->user('id'));
				return $this->redirect($this->Auth->redirect());

			}else{

				$this->Session->setFlash(__('Invalid username or password, try again'), 'metrobox_flash_login');

				if($user){

					$this->User->id = $user['User']['id'];

					if( strtotime($user['User']['login_last_attempt']) > strtotime($time_to_count_an_attempt) ){

						$this->User->data['User']['login_last_attempts_count'] = $attempts_count + 1;

					}else{

						$this->User->data['User']['login_last_attempts_count'] = 1;

						$this->set('attempts_count',1);

					}

					$this->User->data['User']['login_last_attempt'] = date('Y-m-d H:i:s');


					$this->User->save($this->User->data);

				}

			}

		}
	}

	public function logout() {
		return $this->redirect($this->Auth->logout());
	}

	function forgetPassword(){
		$this->request->onlyAllow('ajax');

		$data = array(
			'content' => '',
			'error' => '',
		);

		$this->User->recursive=-1;

		if(!empty($this->data))	{
			if(empty($this->data['User']['email']))	{
				$data['error'] = __('Please provide email adress that you used to register');
			}
			else{
				$email = $this->data['User']['email'];
				$user = $this->User->find('first',array('conditions' => array('User.email' => $email)));
				if($user)	{
					$token = Security::hash(String::uuid(),'sha512',true);
					$url = Router::url( array('controller'=>'users','action'=>'reset'), true ).'/'.$token;

					$this->User->id = $user['User']['id'];

					if( $this->User->saveField('reset_password_token', $token) && $this->User->saveField('reset_password_token_created', date('Y-m-d H:i:s')) ){

						//============Email================//
						/* SMTP Options */
						$this->Email->smtpOptions = array(
							'port'=>'465',
							'timeout'=>'30',
							'host' => 'ssl://smtp.gmail.com',
							'username'=>'francisco@publinet.com.ar',
							'password'=>'05890589'
							);
						$this->Email->template = 'metrobox_reset_password';
						$this->Email->from = 'Littlebox <info@littlebox.com.ar>';
						$this->Email->to = $user['User']['email'];
						$this->Email->subject = __('Reset Your Example.com Password');
						$this->Email->sendAs = 'both';

						$this->Email->delivery = 'smtp';
						$this->set('url', $url);
						$this->Email->send();
						$this->set('smtp_errors', $this->Email->smtpError);

						$data['content']['title'] = __('Mail sended');
						$data['content']['text'] = __('Check your email to reset your password');

						//============EndEmail=============//
					}
					else{
						$data['error'] = __('Error generating reset link');
					}
				}
				else{
					$data['error'] = __('User with this email does not exist');
				}
			}

		}

		$this->set(compact('data')); // Pass $data to the view
		$this->set('_serialize', 'data'); // Let the JsonView class know what variable to use
	}

	function resetPassword($token = null){
		$this->layout = 'metrobox_login';

		$this->User->recursive=-1;


		do {

			//Check if token is empty
			if( empty($this->request->token) ){
				$this->Session->setFlash(__('No reset token provided.'), 'metrobox_flash_login');
				break;
			}

			$user = $this->User->find('first',array('conditions'=>array('User.reset_password_token' => $this->request->token), 'fields' => array('id', 'reset_password_token_created', 'full_name')));

			//Check if a user has been founded in DB
			if( !$user ){
				$this->Session->setFlash(__('The token has been used or is not valid.'), 'metrobox_flash_login');
				break;
			}

			//Check if token have less than one day since generated
			if( strtotime($user['User']['reset_password_token_created']) < strtotime('-1 day') ){
				$this->Session->setFlash(__('The token has expired.'), 'metrobox_flash_login');
				break;
			}

			$this->set('user', $user); //Pass user variable to the view

			if ($this->request->is('post')) {

				$this->User->id = $user['User']['id'];
				$this->request->data['User']['reset_password_token'] = null;
				$this->User->data = $this->request->data;

				//Validate password fields with validations in model
				if(!$this->User->validates(array('fieldList'=>array('password','password_confirm')))){
					$this->set('errors', $this->User->invalidFields());
					break;
				}

				//Save new password in DB
				if($this->User->save($this->User->data)){
					$this->Session->setFlash(__('Your password has been updated!'), 'metrobox_flash_login_success');
					$this->redirect(array('controller'=>'users','action'=>'login'));
				}

			}
		} while (false); //Runs only once

	}

/*
 * Set remember login cookies ir remember checkbox was marked
 */
	protected function _setCookie($id) {
		if (!$this->request->data('remember')) {
			return false;
		}
		$data = array(
			'email' => $this->request->data('User.email'),
			'password' => $this->request->data('User.password')
		);

		$this->Cookie->write('RememberMe', $data, true, '+2 week');

		return true;
	}

}