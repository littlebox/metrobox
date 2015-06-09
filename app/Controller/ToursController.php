<?php
App::uses('AppController', 'Controller');
/**
 * Tours Controller
 *
 * @property Tour $Tour
 * @property PaginatorComponent $Paginator
 */
class ToursController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'DataTable');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		//debug($this->Auth->user('Group.id'));die();
		$this->layout = 'metrobox';

		$this->paginate = array(
			'conditions' => array('Tour.winery_id' => $this->Auth->user('winery_id')),
			'fields' => array('Tour.color', 'Tour.name', 'Tour.price', 'Tour.quota', 'Tour.length', 'Tour.id'),
			'order' => array('Tour.name' => 'asc'),
			'contain' => false
		);

		$this->DataTable->mDataProp = true;
		$this->set('response', $this->DataTable->getResponse());
		$this->set('_serialize','response');
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->layout = 'metrobox';

		if (!$this->Tour->exists($id)) {
			throw new NotFoundException(__('Invalid tour'));
		}
		$options = array('conditions' => array('Tour.' . $this->Tour->primaryKey => $id), 'contain' => array('Language', 'Day', 'Time'));
		$this->set('tour', $this->Tour->find('first', $options));

		//debug($this->Tour->find('first', $options));die();
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->layout = 'metrobox';

		if ($this->request->is('post')) {
			$this->Tour->create();

			//Set the winery of user logged in
			$this->request->data['Tour']['winery_id'] = $this->Auth->user('winery_id');

			debug($this->request->data);

			//Make length field "hh:mm:ss formated" to save in DB
			list($h, $m) = split(':', $this->request->data['Tour']['length']);
			//Add leading 0 at one digit numbers
			$h = sprintf("%02d", $h);
			$m = sprintf("%02d", $m);
			$s = '00';
			$this->request->data['Tour']['length'] = implode(':', array($h, $m, $s));


			foreach ($this->request->data['Time']['Time'] as $key => $time) {
				//Clean the empty times
				if(empty($time)){
					unset($this->request->data['Time']['Time'][$key]);
				}else{
					//Round time to nearest quarter hour (to match with someone in DB)
					list($h, $m) = split(':', $time);
					$h = $m > 52 ? ($h == 23 ? 0 : ++$h) : $h;
					$m = (intval(($m + 7.5)/15) * 15) % 60;
					//Add leading 0 at one digit numbers
					$h = sprintf("%02d", $h);
					$m = sprintf("%02d", $m);
					$time = implode(':', array($h, $m));

					//Search in DB for the ID of these time
					$timeId = $this->Tour->Time->find('first', array('contain' => false, 'fields' => array('id'), 'conditions' => array('hour' => $time)));

					$this->request->data['Time']['Time'][$key] = $timeId['Time']['id'];
				}

			}

			//debug($this->request->data);die();

			if ($this->Tour->saveAssociated($this->request->data)) {
				$this->Session->setFlash(__('The tour has been saved.'), 'metrobox/flash_success');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tour could not be saved. Please, try again.'), 'metrobox/flash_danger');
				//debug($this->Tour->validationErrors); die();
			}
		}
		//To show wineries, days and languages avaiables in view
		$wineries = $this->Tour->Winery->find('list');
		$days = $this->Tour->Day->find('list');
		$languages = $this->Tour->Language->find('list');
		$times = $this->Tour->Time->find('list');
		$this->set(compact('wineries', 'days', 'languages', 'times'));



	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->layout = 'metrobox';
		if (!$this->Tour->exists($id)) {
			throw new NotFoundException(__('Invalid tour'));
		}

		$this->tourSecurityCheck($id);

		if ($this->request->is(array('post', 'put'))) {

			$this->request->data['Tour']['id'] = $id;

			//Make length field "hh:mm:ss formated" to save in DB
			list($h, $m) = split(':', $this->request->data['Tour']['length']);
			//Add leading 0 at one digit numbers
			$h = sprintf("%02d", $h);
			$m = sprintf("%02d", $m);
			$s = '00';
			$this->request->data['Tour']['length'] = implode(':', array($h, $m, $s));


			foreach ($this->request->data['Time']['Time'] as $key => $time) {
				//Clean the empty times
				if(empty($time)){
					unset($this->request->data['Time']['Time'][$key]);
				}else{
					//Round time to nearest quarter hour (to match with someone in DB)
					list($h, $m) = split(':', $time);
					$h = $m > 52 ? ($h == 23 ? 0 : ++$h) : $h;
					$m = (intval(($m + 7.5)/15) * 15) % 60;
					//Add leading 0 at one digit numbers
					$h = sprintf("%02d", $h);
					$m = sprintf("%02d", $m);
					$time = implode(':', array($h, $m));

					//Search in DB for the ID of these time
					$timeId = $this->Tour->Time->find('first', array('contain' => false, 'fields' => array('id'), 'conditions' => array('hour' => $time)));

					$this->request->data['Time']['Time'][$key] = $timeId['Time']['id'];
				}

			}

			if ($this->Tour->saveAssociated($this->request->data)) {
				$this->Session->setFlash(__('The tour has been saved.'), 'metrobox/flash_success');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tour could not be saved. Please, try again.'), 'metrobox/flash_danger');
			}
		} else {
			$options = array('conditions' => array('Tour.' . $this->Tour->primaryKey => $id), 'contain' => array('Day', 'Language', 'Time'));
			$this->request->data = $this->Tour->find('first', $options);
		}
		//To show wineries, days and languages avaiables in view
		$wineries = $this->Tour->Winery->find('list');
		$days = $this->Tour->Day->find('list');
		$languages = $this->Tour->Language->find('list');
		$this->set(compact('wineries', 'days', 'languages'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->request->allowMethod('post');

		if($this->request->is('ajax')){
			$data = array(
				'content' => '',
				'error' => '',
			);

			//$this->autoRender = $this->layout = false;

			$this->Tour->id = $id;
			if (!$this->Tour->exists()) {
				$data['error'] = __('Invalid Tour');
			} else {
				$this->tourSecurityCheck($id);
				if ($this->Tour->delete()) {
					$data['content'] = __('Tour deleted');
				} else {
					$data['error'] = __('Tour was not deleted');
				}
			}

			$this->set(compact('data')); // Pass $data to the view
			$this->set('_serialize', 'data'); // Let the JsonView class know what variable to use

		}else{

			$this->Tour->id = $id;
			if (!$this->Tour->exists()) {
				throw new NotFoundException(__('Invalid Tour'));
			}
			$this->tourSecurityCheck($id);
			if ($this->Tour->delete()) {
				$this->Session->setFlash(__('Tour deleted'), 'metrobox/flash_success');
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Tour was not deleted', 'metrobox/flash_danger'));
			return $this->redirect(array('action' => 'index'));
		}
	}

	/* SECURITY CHECK */
	/* Verify if the logged user isn't admin and the reserve atempted to modify is inside a winery that he manages */
	private function tourSecurityCheck($tourId){


		//Bring al IDs of user winery's tour
		$tours = $this->Tour->find('all', array('conditions' => array('Tour.winery_id' => $this->Auth->user('winery_id')), 'fields' => array('id'), 'contain' => false));
		$toursIds = [];

		foreach ($tours as $tour) {
			$toursIds[] = $tour['Tour']['id'];
		}

		$tourToModify = $this->Tour->find('first', array(
			'conditions' => array(
				'Tour.id' => $tourId,
			),
			'fields' => array('id'),
			'contain' => false)
		);

		if ((AuthComponent::user('Group.id') != 1) && !in_array($tourToModify['Tour']['id'], $toursIds)) {
			throw new ForbiddenException(__('Not allowed to edit this'));
		}

	}
}
