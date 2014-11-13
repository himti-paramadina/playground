<?php

class ScoreboardsController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();

		$this->Auth->allow('view');
	}

	public function view($quizUniqueName) {
		$this->loadModel('Quiz');
		$this->loadModel('Problem');

		$quiz = $this->Quiz->findByunique_name($quizUniqueName);
		$problems = $this->Problem->find('all', array(
			'conditions' => array(
				'Problem.quiz_id' => $quiz['Quiz']['id_quiz']
			),
			'order' => array(
				'Problem.order' => 'ASC'
			)
		));

		$scoreboardData = $this->Scoreboard->getPivotTable($quiz, $problems);

		$this->set('problems', $problems);
		$this->set('quiz', $quiz);
		$this->set('scoreboardData', $scoreboardData);

		$this->set('title_for_layout', "Scoreboard - " . $quiz['Quiz']['name']);
	}
	
}