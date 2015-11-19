<?php
App::uses('AppController', 'Controller');
/**
 * Holidays Controller
 *
 * @property Holiday $Holiday
 * @property PaginatorComponent $Paginator
 */
class HolidaysController extends AppController {

	public function admin_edit() {

		$this->layout = 'metrobox';

		if ($this->request->is(array('post', 'put'))) {

			$hasError = false;

			// debug($this->request->data['Holiday']);die();

			$this->Holiday->deleteAll(array(
				'Holiday.id IS NOT NULL'
			));

			$holiday_to_save = [];
			foreach ($this->request->data['Holiday'] as $holiday) {
				$this->Holiday->create();
				//Convert date d/m/Y to Y-m-d format tosave in DB
				$holiday_to_save['Holiday']['day'] = DateTime::createFromFormat('d/m/Y', $holiday)->format('Y-m-d');;
				if(!$this->Holiday->save($holiday_to_save)){
					$hasError = true;
				}
			}

			if($hasError){
				$this->Session->setFlash(__('Holidays could not be saved. Please, try again.'), 'metrobox/flash_danger');
			}else{
				$this->Session->setFlash(__('Holidays has been saved'), 'metrobox/flash_success');
			}

			return $this->redirect(array('action' => 'edit', 'admin' => true));

		} else {
			//To show in view
			$holidays = $this->Holiday->find('all');
			$this->set(compact('holidays'));
		}
	}

}
