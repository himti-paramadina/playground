<?php

class SubmissionsController extends AppController {

	public $components = array(
		'Paginator', 'RequestHandler'
	);

	public $paginate = array(
		'limit' => 20
	);

	public function beforeFilter() {
		parent::beforeFilter();

		$this->Auth->allow('api_add');
	}

	public function index() {
		$this->Paginator->settings = $this->paginate;
		$submissions = $this->Paginator->paginate();

		$this->set('submissions', $submissions);

		$this->set('title_for_layout', "Index of Submissions");
	}

	public function history($problemUniqueName) {
		$this->loadModel('Problem');
		$problem = $this->Problem->findByunique_name($problemUniqueName);

		$this->paginate['conditions'] = array(
			'Submission.problem_id' => $problem['Problem']['id_problem']
		);
		$this->Paginator->settings = $this->paginate;
		$submissions = $this->Paginator->paginate();

		$this->set('submissions', $submissions);

		$this->set('title_for_layout', "Submission History for " . $problem['Problem']['unique_name']);
	}

	/* Administration Functions */



	/* API Functions */

	/*
		data = array(
			'email' =>
			'token' =>

			'problem_identifier' =>

			'score' =>
		)
	*/
	public function api_add() {
		$response = array();

		if ($this->request->is('post')) {
			$this->loadModel('Participation')
			$this->loadModel('Problem');
			$this->loadModel('Quiz');
			$this->loadModel('User');

			$participation = $this->Participation->findBytoken($this->request->data['token']);
			
			$quiz = $this->Quiz->findByid_quiz($participation['Participation']['quiz_id']);

			if ($participation) {
				$user = $this->User->findByuser_id($participation['Participation']['user_id']);

				if (strcmp($user['User']['email'], $this->request->data['email'])) {
					$problem = $this->Problem->findByidentifer($this->request->data['problem_identifier']);

					if ($problem) {
						$newSubmission = array(
							'Submission' => array(
								'created' => date('Y-m-d H:i:s'),
								'quiz_id' => $problem['Problem']['quiz_id'],
								'problem_id' => $this->request->data['problem_id'],
								'user_id' => $this->request->data['quiz_id'],
								'score' => $this->request->data['score'],
							)
						);

						if ($this->Submission->save($newSubmission)) {
							$this->loadModel('Scoreboard');

							$scoreboardEntry = $this->Scoreboard->findByproblem_id($problem['Problem']['id_problem']);

							if ($scoreboardEntry['Scoreboard']['score'] < $newSubmission['Submission']['score']) {
								$scoreboardEntry['Scoreboard']['score'] = $newSubmission['Submission']['score'];

								$this->Scoreboard->save($scoreboardEntry);
							}
						}

						$response['message'] = "Success submitting your score.";
						$response['result'] = $newSubmission;
					}
					else {
						$response['message'] = "Wrong problem identifier. (Are you trying to hack the system?)";
					}
				}
				else {
					$response['message'] = "Wrong email supplied. Please check your credential.";	
				}
			}
			else {
				$response['message'] = "Wrong token supplied. Please check your credential.";
			}
		}

		$this->set(compact('response'));
        $this->set('_serialize', array('response'));
	}

}