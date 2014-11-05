<?php

class Quiz extends AppModel {
	public $recursive = -1;

	public $primaryKey = 'id_quiz';

	public $belongsTo = array(
		'User', 'Group'
	);

	public $hasMany = array(
		'Problem'
	);

	public function getScoreBoard($quiz_id) {
		
	}
}
