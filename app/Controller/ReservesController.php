<?php
App::uses('AppController', 'Controller');
/**
 * Reserves Controller
 *
 * @property Reserve $Reserve
 * @property PaginatorComponent $Paginator
 */
class ReservesController extends AppController {

	public $components = array('Paginator');


	public function index() {
		$this->layout = 'metrobox';
		if (empty($this->Auth->user('winery_id'))) {
			throw new NotFoundException(__('Missed Winery ID in Argument'));
		}
		$wineryId = $this->Auth->user('winery_id');
		$this->loadModel('Winery', 'Language');
		if (!$this->Winery->exists($wineryId)) {
			throw new NotFoundException(__('Invalid Winery'));
		}
		$this->Winery->id = $wineryId;
		//To show Winery's Tours in view
		$tours = $this->Winery->Tour->find('list', array('contain' => false, 'conditions' => array('winery_id' => $wineryId)));
		$this->set('tours', $tours);
		//To use Tour's Lnaguajes and Reserves in view
		$toursData = $this->Winery->Tour->find('all', array('contain' => array('Language', 'Reserve', 'Time', 'Day'), 'conditions' => array('winery_id' => $wineryId)));
		$this->set('toursData', $toursData);
		//debug($toursData);die();
	}

	public function admin_index() {
		$this->layout = 'metrobox';
		$this->Reserve->recursive = 0;
		$this->set('reserves', $this->Paginator->paginate());
	}

	public function view($id = null) {
		if (!$this->Reserve->exists($id)) {
			throw new NotFoundException(__('Invalid reserve'));
		}
		$options = array('conditions' => array('Reserve.' . $this->Reserve->primaryKey => $id));
		$this->set('reserve', $this->Reserve->find('first', $options));
	}

	public function add() {
		$this->request->allowMethod('ajax'); //Call only with .json at end on url

		//Check if request is post or put
		if ($this->request->is('post') || $this->request->is('put')) {

			if (!$this->Reserve->Tour->exists($this->request->data['Reserve']['tour_id'])) {
				throw new NotFoundException(__('Invalid Tour'));
			}

			$data = array(
				'content' => '',
				'error' => '',
			);

			//Convert date d/m/Y to Y-m-d format tosave in DB
			$this->request->data['Reserve']['date'] = DateTime::createFromFormat('d/m/Y', $this->request->data['Reserve']['date'])->format('Y-m-d');
			$this->request->data['Client']['birth_date'] = DateTime::createFromFormat('d/m/Y', $this->request->data['Client']['birth_date'])->format('Y-m-d');

			//if the client exist, put the id in the request data array
			if(!empty($client = $this->Reserve->Client->find('first', array('conditions' => array('Client.email' => $this->request->data['Client']['email']), 'contain' => false)))){
				//WARING!! All Client data will be overwritten!!
				$this->request->data['Client']['id'] = $client['Client']['id'];
			}

			//debug($this->request->data);debug($client);die();
			$this->Reserve->create();
			if ($this->Reserve->saveAssociated($this->request->data)) {
				$data['content']['title'] = __('Good.');
				$data['content']['text'] = __('The reserve has been saved.');
			} else {
				debug($this->Reserve->validationErrors); die();
				$data['error'] = __('The reserve could not be saved. Please, try again.');
			}
		}

		$this->set(compact('data')); // Pass $data to the view
		$this->set('_serialize', 'data'); // Let the JsonView class know what variable to use
	}

	//Return a JSON encode respons with reserves to show in calendar (http://fullcalendar.io/docs/event_data/events_json_feed/)
	public function get() {
		$this->request->allowMethod('ajax'); //Call only with .json at end on url

		//Bring al IDs of user winery's tour
		$tours = $this->Reserve->Tour->find('all', array('conditions' => array('Tour.winery_id' => $this->Auth->user('winery_id')), 'fields' => array('id'), 'contain' => false));
		$toursIds = [];

		foreach ($tours as $tour) {
			$toursIds[] = $tour['Tour']['id'];
		}

		//Bring only reserves of those tours
		$reserves = $this->Reserve->find('all', array('conditions' => array('Reserve.tour_id' => $toursIds), 'contain' => array('Client')));
		//debug($reserves);die();

		//Prepare response for fullcalendar
		$response = [];
		foreach ($reserves as $reserve) {
			$arrayToPush = array(
				'id' => $reserve['Reserve']['id'],
				'title' => $reserve['Client']['full_name'],
				'start' => $reserve['Reserve']['date'].' '.$reserve['Reserve']['time'],
				'quantity' => $reserve['Reserve']['quantity'],
				'language' => $reserve['Reserve']['language_id'],
				'clientName' => $reserve['Client']['full_name'],
			);
			$response[] = $arrayToPush;
		}

		$this->set(compact('response')); // Pass $data to the view
		$this->set('_serialize', 'response'); // Let the JsonView class know what variable to use
	}

	public function edit() {
		$this->request->allowMethod('ajax'); //Call only with .json at end on url

		if (!$this->request->is(array('post', 'put'))) {
			throw new MethodNotAllowedException(__('Only POST or PUT methods allowed.'));
		}

		if (!$this->Reserve->exists($this->request->data['Reserve']['id'])) {
			throw new NotFoundException(__('Invalid reserve'));
		}


		$data = array(
			'content' => '',
			'error' => '',
		);

		//Convert date d/m/Y to Y-m-d format tosave in DB
		$this->request->data['Reserve']['date'] = DateTime::createFromFormat('d/m/Y', $this->request->data['Reserve']['date'])->format('Y-m-d');

		if ($this->Reserve->save($this->request->data)) {
			$data['content']['title'] = __('Good.');
			$data['content']['text'] = __('The reserve has been saved.');
		} else {
			$data['error'] = __('The reserve could not be saved. Please, try again.');
		}

		$this->set(compact('data')); // Pass $data to the view
		$this->set('_serialize', 'data'); // Let the JsonView class know what variable to use

	}

	public function delete($id = null) {
		$this->Reserve->id = $id;
		if (!$this->Reserve->exists()) {
			throw new NotFoundException(__('Invalid reserve'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Reserve->delete()) {
			$this->Session->setFlash(__('The reserve has been deleted.'));
		} else {
			$this->Session->setFlash(__('The reserve could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
