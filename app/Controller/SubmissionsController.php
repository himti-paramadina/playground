<?php

class SubmissionsController extends AppController {

	public $components = array(
		'Paginator', 'RequestHandler'
	);

	public $paginate = array(
		'limit' => 20
	);

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
			'quiz_identifier' =>
			'problem_identifier' =>
			'score' =>
			'email' =>
			'token' =>
		)
	*/
	public function api_add() {
		if ($this->request->is('post')) {
			$newSubmission = array(
				'Submission' => array(
					'created' => date('Y-m-d H:i:s'),
					'quiz_id' => ,
					'problem_id' => ,
					'score' => ,
				)
			)

			if ($this->Submission->save($newSubmission)) {

			}
		}
	}

}