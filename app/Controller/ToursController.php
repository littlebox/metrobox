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
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Tour->recursive = 0;
		$this->set('tours', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Tour->exists($id)) {
			throw new NotFoundException(__('Invalid tour'));
		}
		$options = array('conditions' => array('Tour.' . $this->Tour->primaryKey => $id));
		$this->set('tour', $this->Tour->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Tour->create();
			if ($this->Tour->save($this->request->data)) {
				$this->Session->setFlash(__('The tour has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tour could not be saved. Please, try again.'));
			}
		}
		$wineries = $this->Tour->Winery->find('list');
		$days = $this->Tour->Day->find('list');
		$languages = $this->Tour->Language->find('list');
		$this->set(compact('wineries', 'days', 'languages'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Tour->exists($id)) {
			throw new NotFoundException(__('Invalid tour'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Tour->save($this->request->data)) {
				$this->Session->setFlash(__('The tour has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tour could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Tour.' . $this->Tour->primaryKey => $id));
			$this->request->data = $this->Tour->find('first', $options);
		}
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
		$this->Tour->id = $id;
		if (!$this->Tour->exists()) {
			throw new NotFoundException(__('Invalid tour'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Tour->delete()) {
			$this->Session->setFlash(__('The tour has been deleted.'));
		} else {
			$this->Session->setFlash(__('The tour could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
