<?php
App::uses('AppController', 'Controller');
/**
 * Wineries Controller
 *
 * @property Winery $Winery
 * @property PaginatorComponent $Paginator
 */
class WineriesController extends AppController {

	public $components = array('Paginator', 'DataTable');

	public $helpers = array(
		'Form' => array('className' => 'BootstrapForm')
	);

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('get');
	}

	public function admin_index(){
		$this->layout = 'metrobox';

		$this->paginate = array(
			'fields' => array('Winery.name', 'Winery.priority', 'Winery.visible', 'Winery.created', 'Winery.id', 'Winery.reserve_count'),
			'order' => array('Winery.created' => 'desc'),
			'contain' => false,
		);

		$this->DataTable->mDataProp = true;
		$this->set('response', $this->DataTable->getResponse());
		$this->set('_serialize','response');
	}

	public function view($id = null) {
		if (!$this->Winery->exists($id)) {
			throw new NotFoundException(__('Invalid winery'));
		}
		$options = array('conditions' => array('Winery.' . $this->Winery->primaryKey => $id));
		$this->set('winery', $this->Winery->find('first', $options));
	}

	public function get() {
		// $this->request->allowMethod('ajax'); //Only Ajax
		// $this->Security->csrfCheck = false;
		header('Access-Control-Allow-Origin:*');
		header('Access-Control-Allow-Methods:*');
		header('Access-Control-Allow-Headers:X-Requested-With');
		header('X-pennesi-puto?:si!!!');

		//Render always as json
		$this->RequestHandler->renderAs($this, 'json');

		if (empty($this->request['named']['date'])){
			throw new NotFoundException(__('Invalid Date'));
		}

		$date = $this->request['named']['date']; //Has to be AAAA-MM-DD
		$language = !empty($this->request['named']['language']) ? $this->request['named']['language'] : 1; //Has to be a language id(if not setted, set to 1 (spanish)

		//Set day of week number (1-7) from date
		$dateObject = DateTime::createFromFormat('Y-m-d', $date);
		$dayOfWeek = $dateObject->format('N');

		//This unbind and bind association allow bringing only tours that have the selected languaje and day of week
		$this->Winery->unbindModel(array('hasMany' => array('Tour')));
		$this->Winery->bindModel(
			array('hasMany' => array(
					'Tour' => array(
						'className' => 'Tour',
						'foreignKey' => 'winery_id',
						'dependent' => false,
						'finderQuery' => "SELECT Tour.* FROM tours AS Tour INNER JOIN tours_languages AS ToursLanguage ON ToursLanguage.tour_id = Tour.id AND ToursLanguage.language_id = '$language' INNER JOIN tours_days AS ToursDay ON ToursDay.tour_id = Tour.id AND ToursDay.day_id = '$dayOfWeek'"
					)
				)
			)
		);

		//Set recursive to -1 for correct joins
		$this->Winery->recursive = -1;

		$options = array(
			'fields' => array(
				'id',
				'name',
				'latitude',
				'longitude',
				'address',
				'description',
				'priority',
			),
			'joins'=>array( //Estos Joins descartan las bodegas que no tienen ningun tour en el idioma especificado o no tienen tour en el día especificado, pero de las bodegas que no descarta trae todos los tours, icluso los que no tienen el idioma o el día
				array(
					'table'=>'tours',
					'alias'=>'Tour',
					'type'=>'inner',
					'conditions'=>array(
						'Tour.winery_id = Winery.id'
					)
				),
				array(
					'table'=>'tours_languages',
					'alias'=>'ToursLanguage',
					'type'=>'inner',
					'conditions'=>array(
						'ToursLanguage.tour_id = Tour.id',
						'ToursLanguage.language_id = ' . $language
					)
				),
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
			'contain' => array(
				'Image' => array(
					'id',
					'name',
				),
				'Tour' => array(
					'id',
					'name',
					'length',
					'quota',
					'price',
					'minors_price',
					'description',
					'Time' => array(
						'id',
						'hour',
						'quota_available',
					),
					'Language'=> array(
						'id',
						'name',
					)
				),
			),
			'order' => array(
				'Winery.priority DESC'
			),

		);

		$wineries = $this->Winery->find('all', $options);

		foreach ($wineries as &$winery) {
			foreach ($winery['Tour'] as &$tour) {
				foreach ($tour['Time'] as &$time) {
					$tourId = $tour['id'];
					$timeHour = $time['hour'];
					//Query to calculate quota available of tour un specific date y specific
					$query = $this->Winery->Tour->Time->query("SELECT (tours.quota - (SELECT COALESCE(SUM(reserves.number_of_adults)+SUM(reserves.number_of_minors), 0) FROM reserves WHERE reserves.tour_id = $tourId AND reserves.date = '$date' AND reserves.time = '$timeHour')) AS quota_available FROM tours WHERE tours.id = $tourId");
					$time['quota_available'] = $query[0][0]['quota_available'];
				}
			}
		}

		// $log = $this->Winery->getDataSource()->getLog(false, false);debug($log);

		$this->set(compact('wineries')); // Pass $data to the view
		$this->set('_serialize', 'wineries'); // Let the JsonView class know what variable to use

		// debug($wineries);die();
		// echo json_encode($wineries);
		// die();
	}


	public function admin_add() {
		$this->layout = 'metrobox';

		if ($this->request->is('post')) {
			$this->Winery->create();
			if ($this->Winery->save($this->request->data)) {
				$this->Session->setFlash(__('The winery has been saved.'), 'metrobox/flash_success');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The winery could not be saved. Please, try again.'), 'metrobox/flash_danger');
			}
		}
	}


	public function admin_edit($id = null) {
		$this->layout = 'metrobox';

		if (!$this->Winery->exists($id)) {
			throw new NotFoundException(__('Invalid winery'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$this->Winery->id = $id;
			if ($this->Winery->save($this->request->data)) {
				$this->Session->setFlash(__('The winery has been saved.'), 'metrobox/flash_success');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The winery could not be saved. Please, try again.'), 'metrobox/flash_danger');
			}
		} else {
			$options = array('conditions' => array('Winery.' . $this->Winery->primaryKey => $id), 'contain' => array('Image'));
			$this->request->data = $this->Winery->find('first', $options);
		}
	}

	public function delete($id = null) {
		$this->Winery->id = $id;
		if (!$this->Winery->exists()) {
			throw new NotFoundException(__('Invalid winery'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Winery->delete()) {
			$this->Session->setFlash(__('The winery has been deleted.'));
		} else {
			$this->Session->setFlash(__('The winery could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function admin_delete($id = null) {
		$this->request->allowMethod('post');

		if($this->request->is('ajax')){
			$data = array(
				'content' => '',
				'error' => '',
			);

			//$this->autoRender = $this->layout = false;

			$this->Winery->id = $id;
			if (!$this->Winery->exists()) {
				$data['error'] = __('Invalid Winery');
			} else {
				if ($this->Winery->delete()) {
					$data['content'] = __('Winery deleted');
				} else {
					$data['error'] = __('Winery was not deleted');
				}
			}

			$this->set(compact('data')); // Pass $data to the view
			$this->set('_serialize', 'data'); // Let the JsonView class know what variable to use

		}else{

			$this->Winery->id = $id;
			if (!$this->Winery->exists()) {
				throw new NotFoundException(__('Invalid winery'));
			}
			if ($this->Winery->delete()) {
				$this->Session->setFlash(__('Winery deleted'), 'metrobox/flash_success');
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Winery was not deleted'), 'metrobox/flash_danger');
			return $this->redirect(array('action' => 'index'));
		}

	}
}
