<?php

App::import('Vendor', 'Parsedown', array('file' => 'Parsedown/Parsedown.php'));

class QuizzesController extends AppController {

	public $components = array(
		'Paginator', 'RequestHandler'
	);

	public $paginate = array(
		'limit' => 20
	);

	public function detail($uniqueName) {
		$quiz = $this->Quiz->findByunique_name($uniqueName);

		$this->loadModel('Group');
		$group = $this->Group->findByid_group($quiz['Quiz']['group_id']);

		$this->loadModel('Problem');
		$problems = $this->Problem->find('all', array(
			'conditions' => array(
				'quiz_id' => $quiz['Quiz']['id_quiz']
			),
			'order' => array(
				'Problem.order' => 'ASC'
			)
		));

		/* Prepare Scoreboard */

		$this->loadModel('Scoreboard');

		$scoreboardData = $this->Scoreboard->find('all', array(
			'conditions' => array(
				'user_id' => $this->Auth->user('id_user'),
				'quiz_id' => $quiz['Quiz']['id_quiz']
			)
		));

		$this->loadModel('Participation');

		if (count($scoreboardData) == 0) {
			$this->Participation->create();

			$newParticipation = array(
				'Participation' => array(
					'token' => md5(uniqid($this->Auth->email . '_', true)),
					'quiz_id' => $quiz['Quiz']['id_quiz'],
					'user_id' => $this->Auth->user('id_user')
				)
			);

			$this->Participation->save($newParticipation);
			$this->set('participation', $newParticipation);

			foreach ($problems as $problem) {
				$this->Scoreboard->create();
				$this->Scoreboard->save(array(
					'Scoreboard' => array(
						'score' => 0,
						'attempt' => 0,
						'last_accepted_attempt' => null,
						'user_id' => $this->Auth->user('id_user'),
						'problem_id' => $problem['Problem']['id_problem'],
						'quiz_id' => $quiz['Quiz']['id_quiz']
					)
				));
			}
		}
		else {
			$participation = $this->Participation->find('first', array(
				'conditions' => array(
					'user_id' => $this->Auth->user('id_user'),
					'quiz_id' => $quiz['Quiz']['id_quiz']
				)
			));

			$this->set('participation', $participation);
		}

		$this->set('group', $group);
		$this->set('problems', $problems);
		$this->set('quiz', $quiz);

		$this->set('title_for_layout', $quiz['Quiz']['name']);
	}

	/* Administration Functions */

	public function administration_index() {
		$this->Quiz->recursive = 0;

		$this->Paginator->settings = $this->paginate;

		$quizzes = $this->Paginator->paginate();

		$this->set('quizzes', $quizzes);

		$this->set('title_for_layout', "Index of Quizzes");
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

	public function administration_publish($identifier) {
		$quiz = $this->Quiz->findByidentifier($identifier);

		$quiz['Quiz']['published'] = true;

		$this->Quiz->save($quiz);

		$this->Session->setFlash("Your desired quiz has been published.", 'flash/success');

		$this->redirect(array('controller' => 'problems', 'action' => 'index', $quiz['Quiz']['identifier'], 'administration' => true));
	}

	public function administration_unpublish($identifier) {
		$quiz = $this->Quiz->findByidentifier($identifier);

		$quiz['Quiz']['published'] = false;

		$this->Quiz->save($quiz);

		$this->Session->setFlash("Your desired quiz has been unpublished.", 'flash/warning');

		$this->redirect(array('controller' => 'problems', 'action' => 'index', $quiz['Quiz']['identifier'], 'administration' => true));
	}


	/* API Functions */

	public function api_check_availability() {

	}

}
