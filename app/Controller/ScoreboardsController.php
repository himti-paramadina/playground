<?php

class ScoreboardsController extends AppController {

	public function view($quizUniqueName) {
		$this->loadModel('Quiz');
	}
	
}