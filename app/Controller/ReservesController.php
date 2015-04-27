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

			$this->Reserve->create();
			if ($this->Reserve->save($this->request->data)) {
				$this->Session->setFlash(__('The reserve has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The reserve could not be saved. Please, try again.'));
			}
		}

		$this->set(compact('data')); // Pass $data to the view
		$this->set('_serialize', 'data'); // Let the JsonView class know what variable to use
	}

	public function edit($id = null) {
		if (!$this->Reserve->exists($id)) {
			throw new NotFoundException(__('Invalid reserve'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Reserve->save($this->request->data)) {
				$this->Session->setFlash(__('The reserve has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The reserve could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Reserve.' . $this->Reserve->primaryKey => $id));
			$this->request->data = $this->Reserve->find('first', $options);
		}
		$tours = $this->Reserve->Tour->find('list');
		$this->set(compact('tours'));
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
