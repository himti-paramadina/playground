<?php

class QuizzesController extends AppController {

	public $components = array(
		'Paginator', 'RequestHandler'
	);

	public function detail($identifier) {

	}

	/* Administration Functions */

	public function administration_index() {

	}

	public function administration_add() {
		if ($this->request->is('post')) {
			$newIdentifier = md5(uniqid($this->Auth->user('email'), true));
			if ($this->Quiz->save($this->request->data)) {
				$this->Session->setFlash("Success creating your quiz. Now, please add some problems.", 'flash/success');
				$this->redirect(array('controller' => 'problems', 'action' => 'index', $newIdentifier, 'administration' => true));
			}
		}
		
		$this->set('title_for_layout', "Add New Quiz");
	}

	public function administration_edit($id) {

	}

	public function administration_delete($id) {

	}

	/* API Functions */

	public function api_check_availability() {

	}

}
