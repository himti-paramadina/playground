<?php

App::import('Vendor', 'Parsedown', array('file' => 'Parsedown/Parsedown.php'));

class QuizzesController extends AppController {

	public $components = array(
		'Paginator', 'RequestHandler'
	);

	public function detail($unique_name) {
		$this->Quiz->recursive = 1;
		$quiz = $this->Quiz->findByunique_name($unique_name);

		$this->set('quiz', $quiz);

		$this->set('title_for_layout', $quiz['Quiz']['name']);
	}

	/* Administration Functions */

	public function administration_index() {

	}

	public function administration_add() {
		if ($this->request->is('post')) {
			$newIdentifier = md5(uniqid($this->Auth->user('email'), true));

			$this->request->data['Quiz']['identifier'] = $newIdentifier;
			$this->request->data['Quiz']['library_url'] = Router::url('/', true);
			$this->request->data['Quiz']['published'] = false;
			$this->request->data['Quiz']['user_id'] = $this->Auth->user('id_user');
			$this->request->data['Quiz']['created'] = date('Y-m-d H:i:s');

			if ($this->Quiz->save($this->request->data)) {
				$this->Session->setFlash("Success creating your quiz. Now, please add some problems.", 'flash/success');
				$this->redirect(array('controller' => 'problems', 'action' => 'index', $newIdentifier, 'administration' => true));
			}
		}
		
		$this->loadModel('Group');
		$groups = $this->Group->find('list');

		$this->set('groups', $groups);

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
