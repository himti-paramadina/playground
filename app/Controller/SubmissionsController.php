<?php

class SubmissionsController extends AppController {

	public $components = array(
		'Paginator', 'RequestHandler'
	);

	public $paginate = array(
		'limit' => 10,
		'order' => array(
			'Submission.created' => 'DESC'
		)
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

	public function history($quizUniqueName) {
		$this->loadModel('Quiz');
		$quiz = $this->Quiz->findByunique_name($quizUniqueName);

		$this->loadModel('Problem');
		unset($this->Problem->belongsTo['Quiz']);

		$this->Submission->recursive = 2;

		$this->paginate['conditions'] = array(
			'Submission.quiz_id' => $quiz['Quiz']['id_quiz']
		);
		$this->Paginator->settings = $this->paginate;
		$submissions = $this->Paginator->paginate();

		$this->set('quiz', $quiz);
		$this->set('submissions', $submissions);

		$this->set('title_for_layout', "Submission History for " . $quiz['Quiz']['name']);
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
			$this->loadModel('Participation');
			$this->loadModel('Problem');
			$this->loadModel('Quiz');
			$this->loadModel('User');

			$participation = $this->Participation->findBytoken($this->request->data['token']);
			
			if ($participation) {
				$quiz = $this->Quiz->findByid_quiz($participation['Participation']['quiz_id']);

				if (strcmp($quiz['Quiz']['identifier'], $this->request->data['quiz_identifier']) == 0) {
					$user = $this->User->findByid_user($participation['Participation']['user_id']);

					if (strcmp($user['User']['email'], $this->request->data['email']) == 0) {
						$problem = $this->Problem->findByunique_name($this->request->data['problem_unique_name']);

						if ($problem) {
							$newSubmission = array(
								'Submission' => array(
									'created' => date('Y-m-d H:i:s'),
									'quiz_id' => $problem['Problem']['quiz_id'],
									'problem_id' => $problem['Problem']['id_problem'],
									'user_id' => $user['User']['id_user'],
									'score' => $this->request->data['score'],
								)
							);

							$this->loadModel('Scoreboard');

							$scoreboardEntry = $this->Scoreboard->findByproblem_id($problem['Problem']['id_problem']);	

							if ($scoreboardEntry['Scoreboard']['score'] < 100) {
								if ($this->Submission->save($newSubmission)) {
							
									$scoreboardEntry['Scoreboard']['attempt']++;

									if ($scoreboardEntry['Scoreboard']['score'] < $newSubmission['Submission']['score']) {
										$scoreboardEntry['Scoreboard']['score'] = $newSubmission['Submission']['score'];
										$response['message'] = "Your submission has been checked. Good, your score increased. ;)";
									}
									else {
										$response['message'] = "Your submission has been checked. Go try harder!";	
									}

									if ($this->request->data['score'] == 100) {
										$scoreboardEntry['Scoreboard']['last_accepted_attempt'] = date('Y-m-d H:i:s');
										if ($scoreboardEntry['Scoreboard']['attempt'] == 1) {
											$response['message'] = "Your submission has been checked. Accepted in 1 shot! Congratulations!";
										}
										else {
											$response['message'] = "Your submission has been checked. After " . " attempts, your solution has been accepted. Congratulations!";
										}
									}

									$this->Scoreboard->save($scoreboardEntry);
								}
							}
							else {
								$response['message'] = "Your solutions for this answer had already accepted. No need to submit it again. :)";
							}							

							$response['success'] = true;
							$response['result'] = $newSubmission['Submission'];
							$response['user'] = $user['User'];
						}
						else {
							$response['success'] = false;
							$response['message'] = "Wrong problem identifier. (Are you trying to hack the system?)";
						}
					}
					else {
						$response['success'] = false;
						$response['message'] = "Wrong email supplied. Please check your credential.";	
					}
				}
				else {
					$response['success'] = false;
					$response['message'] = "Wrong quiz identifier. (Are you trying to hack the system?)";
				}
			}
			else {
				$response['success'] = false;
				$response['message'] = "Wrong token supplied. Please check your credential.";
			}
		}

		$this->set(compact('response'));
        $this->set('_serialize', array('response'));
	}

}