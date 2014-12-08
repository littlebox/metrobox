<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('add', 'forgetPassword', 'resetPassword');
	}

	public function index() {
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

		$this->layout = 'login';

		if($this->Auth->loggedIn()){
			return $this->redirect($this->Auth->redirect());
		}

		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$this->_setCookie($this->Auth->user('id'));
				return $this->redirect($this->Auth->redirect());
			}
			$this->Session->setFlash(__('Invalid username or password, try again'), 'metrobox_flash_login');
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

					if( $this->User->saveField('reset_password_token', $token) && $this->User->saveField('reset_password_token_created', date("Y-m-d H:i:s")) ){

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
						$this->Email->to = $user['User']['username'].'<'.$user['User']['email'].'>';
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
		$this->layout="login";
		$this->User->recursive=-1;
		if(!empty($token)){
			$user = $this->User->find('first',array('conditions'=>array('User.reset_password_token' => $token)));

			if($user){
				$this->User->id = $user['User']['id'];
				if(!empty($this->data)){
					$this->User->data = $this->data;
					//TODO: Poner token en null al resetear password
					$this->User->data['User']['username'] = $user['User']['username'];
					$new_hash=sha1($user['User']['username'].rand(0,100));//created token
					$this->User->data['User']['reset_password_token'] = $new_hash;
					if($this->User->validates(array('fieldList'=>array('password','password_confirm')))){
						if($this->User->save($this->User->data))
						{
							$this->Session->setFlash('Password Has been Updated');
							$this->redirect(array('controller'=>'users','action'=>'login'));
						}

					}
					else{

						$this->set('errors',$this->User->invalidFields());
					}
				}
			}
			else
			{
				$this->Session->setFlash(__('Token corrupted or has been used, please retry.'));
			}
		}
		else{
			$this->redirect('/');
		}
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