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
			'fields' => array('Tour.color', 'Tour.name', 'Tour.price', 'Tour.quota', 'Tour.length', 'Tour.visible', 'Tour.id'),
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
		$this->tourSecurityCheck($id);

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

			//debug($this->request->data);

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
		//To show wineries, days and languages availables in view
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
		//To show wineries, days and languages availables in view
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

	public function admin_statistics($id = null){
		// debug($this->params->query['from']);die();

		if (!$this->Tour->exists($id)) {
			throw new NotFoundException(__('Invalid winery'));
		}

		$this->layout = 'metrobox';

		//Get tour name
		$tour = $this->Tour->find('first', array(
			'fields' => array('name','id'),
			'contain' => false,
		));

		if(empty($this->params->query['from'])){
			$from = new DateTime('first day of last month');
			$from = $from->format('Y-m-d');
		}else{
			$from = DateTime::createFromFormat('d/m/Y', $this->params->query['from'])->format('Y-m-d');
		}

		if(empty($this->params->query['to'])){
			$to = new DateTime('last day of last month');
			$to = $to->format('Y-m-d');
		}else{
			$to = DateTime::createFromFormat('d/m/Y', $this->params->query['to'])->format('Y-m-d');
		}


		$options = array(
			'fields' => array(
				'id',
				'mp_status',
				'number_of_adults',
				'number_of_minors',
				'price',
				'minors_price',
				'from_web',
				'date',
			),
			'conditions' => array(
				'Reserve.tour_id' => $id,
				'Reserve.date >=' => $from,
				'Reserve.date <=' => $to,
			),
			'contain' => array(
				'Client' => array(
					'fields' => array(
						'id',
						'full_name',
						'country',
					),
				)
			),
		);


		$reserves = $this->Tour->Reserve->find('all', $options);

		$data = [];

		foreach($reserves as $reserve){
			$data[] = array(
				'client_name' => $reserve['Client']['full_name'],
				'date' => DateTime::createFromFormat('Y-m-d', $reserve['Reserve']['date'])->format('d/m/Y'),
				'count_adults' => $reserve['Reserve']['number_of_adults'],
				'price_adults' => $reserve['Reserve']['price'],
				'count_minors' => $reserve['Reserve']['number_of_minors'],
				'price_minors' => $reserve['Reserve']['minors_price'],
				'from_web' => $reserve['Reserve']['from_web'] ? '<i class="fa fa-check font-green"></i>' : '<i class="fa fa-times font-red"></i>' ,
				'total' => ($reserve['Reserve']['number_of_adults']*$reserve['Reserve']['price'])+($reserve['Reserve']['number_of_minors']*$reserve['Reserve']['minors_price']),
			);
		}

		//Convert date Y-m-d to d/m/Y format to show in frontend
		$dates = array(
			'from' => DateTime::createFromFormat('Y-m-d', $from)->format('d/m/Y'),
			'to' => DateTime::createFromFormat('Y-m-d', $to)->format('d/m/Y'),
		);

		// debug($data);die();
		// debug($tours);die();

		// $this->set('tours', $tours);
		// $this->set(compact('container')); // Pass $data to the view
		// $this->set('_serialize', 'container'); // Let the JsonView class know what variable to use
		$this->set('data', $data); // send variable to view
		$this->set('dates', $dates); // send variable to view
		$this->set('tour', $tour); // send variable to view

	}

	public function getToursAvailablesInSelectedDate($date){
		//Render always as json
		$this->RequestHandler->renderAs($this, 'json');

		//Set day of week number (1-7) from date
		$dateObject = DateTime::createFromFormat('Y-m-d', $date);
		$dayOfWeek = $dateObject->format('N');

		$options = array(
			'conditions' => array(
				'Tour.winery_id' => $this->Auth->user('winery_id')
			),
			'fields' => array('id', 'name'),
			'joins'=>array( //Estos Joins descartan los tours que no tienen ningun tour en el día especificado
				array(
					'table'=>'tours_days',
					'alias'=>'ToursDay',
					'type'=>'inner',
					'conditions'=>array(
						'ToursDay.tour_id = Tour.id',
						'ToursDay.day_id = ' . $dayOfWeek
					)
				),
			),
			'contain' => false
		);

		$tours = $this->Tour->find('all', $options);

		$this->set(compact('tours')); // Pass $data to the view
		$this->set('_serialize', 'tours'); // Let the JsonView class know what variable to use

	}

	/* SECURITY CHECK */
	/* Verify if the logged user isn't admin and the reserve atempted to modify is inside a winery that he manages */
	public function tourSecurityCheck($tourToModifyId){

		//Bring al IDs of user winery's tour
		$tours = $this->Tour->find('all', array('conditions' => array('Tour.winery_id' => $this->Auth->user('winery_id')), 'fields' => array('id'), 'contain' => false));
		$toursAllowedIds = [];

		foreach ($tours as $tour) {
			$toursAllowedIds[] = $tour['Tour']['id'];
		}

		if ((AuthComponent::user('Group.id') != 1) && !in_array($tourToModifyId, $toursAllowedIds)) {
			throw new ForbiddenException(__('Not allowed to touch this tour.'));
		}

	}
}
