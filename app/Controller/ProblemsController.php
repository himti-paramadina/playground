<?php

App::import('Vendor', 'Parsedown', array('file' => 'Parsedown/Parsedown.php'));

class ProblemsController extends AppController {
	public $components = array(
		'Paginator', 'RequestHandler'
	);

	public $paginate = array(
		'limit' => 10,
		'fields' => array(
			'Problem.name',
			'Problem.unique_name',
			'Problem.order'
		),
		'order' => array(
			'Problem.order' => 'ASC'
		)
	);

	public function beforeFilter() {
		parent::beforeFilter();

		$this->Auth->allow('api_download');
	}

	public function index($quizUniqueName) {
		$this->loadModel('Quiz');
		$quiz = $this->Quiz->findByunique_name($quizUniqueName);

		$this->paginate['conditions'] = array(
			'Problem.quiz_id' => $quiz['Quiz']['id_quiz']
		);
		$this->Paginator->settings = $this->paginate;
		$problems = $this->Paginator->paginate();

		$this->set('problems', $problems);
		$this->set('quiz', $quiz);

		$this->set('title_for_layout', $quiz['Quiz']['name']);
	}

	public function view($uniqueName) {
		$problem = $this->Problem->findByunique_name($uniqueName);

		$this->set('problem', $problem);

		$this->set('title_for_layout', $problem['Problem']['name']);
	}

	/* Administration Functions */

	public function administration_index($quizIdentifier) {
		$this->loadModel('Quiz');
		$quiz = $this->Quiz->findByidentifier($quizIdentifier);

		$this->paginate['conditions'] = array(
			'Problem.quiz_id' => $quiz['Quiz']['id_quiz']
		);
		$this->Paginator->settings = $this->paginate;
		$problems = $this->Paginator->paginate();

		$this->set('problems', $problems);
		$this->set('quiz', $quiz);

		$this->set('title_for_layout', $quiz['Quiz']['name'] . " Problems");
	}

	public function administration_add($quizIdentifier) {
		$this->loadModel('Quiz');
		$quiz = $this->Quiz->findByidentifier($quizIdentifier);

		if ($this->request->is('post')) {
			$newIdentifier = md5(uniqid($this->Auth->user('email'), true));

			$this->request->data['Problem']['identifier'] = $newIdentifier;
			$this->request->data['Problem']['quiz_id'] = $quiz['Quiz']['id_quiz'];
			$this->request->data['Problem']['created'] = date('Y-m-d H:i:s');

			if ($this->Problem->save($this->request->data)) {
				$this->Session->setFlash("Your new problem has been successfully saved.", 'flash/success');
				$this->redirect(array('controller' => 'problems', 'action' => 'index', $quizIdentifier, 'administration' => true));
			}
			else {
				$this->Session->setFlash("Error while saving your new data.", 'flash/danger');
			}
		}

		$this->set('quiz', $quiz);

		$this->set('title_for_layout', $quiz['Quiz']['name'] . ": Add New Problem");
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
