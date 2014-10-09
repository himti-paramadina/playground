<?php

class ProblemsController extends AppController {
	public $components = array(
		'Paginator', 'RequestHandler'
	)

	$paginate = array(
		'limit' => 10,
		'fields' => array(
			'Problem.name',
			'Problem.unique_name',
		)
	);

	public function beforeFilter() {
		parent::beforeFilter();

		$this->Auth->allow('api_download');
	}

	public function index($quizUniqueName) {
		$this->loadModel('Quiz');
		$quiz = $this->Quiz->findByunique_name($quizUniqueName);

		$this->Paginator->settings = $this->paginate;
		$problems = $this->Paginator->paginate();

		$this->set('problems', $problems);

		$this->set('title_for_layout', $quiz['Quiz']['name']);
	}

	public function view($uniqueName) {
		$problem = $this->Problem->findByunique_name($uniqueName);

		$this->set('problem', $problem);

		$this->set('title_for_layout', $problem['Problem']['name']);
	}

	/* Administration Functions */

	public function administration_index($quizIdentifier) {

	}

	public function administration_add($quizIdentifier) {

	}

	public function administration_edit($id) {

	}

	public function administration_delete($id) {

	}

	/* API Functions */

	public function api_index() {

	}

	public function api_detail() {

	}

	public function api_download($identifier) {
		$problem = $this->Problem->findByidentifier($identifier);

		$response = $problem['Problem'];

		$this->set(compact('response'));
        $this->set('_serialize', array('response'));
	}
}
