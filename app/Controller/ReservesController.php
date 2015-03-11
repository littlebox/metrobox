<?php
App::uses('AppController', 'Controller');
/**
 * Reserves Controller
 *
 * @property Reserve $Reserve
 * @property PaginatorComponent $Paginator
 */
class ReservesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Reserve->recursive = 0;
		$this->set('reserves', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Reserve->exists($id)) {
			throw new NotFoundException(__('Invalid reserve'));
		}
		$options = array('conditions' => array('Reserve.' . $this->Reserve->primaryKey => $id));
		$this->set('reserve', $this->Reserve->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Reserve->create();
			if ($this->Reserve->save($this->request->data)) {
				$this->Session->setFlash(__('The reserve has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The reserve could not be saved. Please, try again.'));
			}
		}
		$tours = $this->Reserve->Tour->find('list');
		$this->set(compact('tours'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
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

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
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
