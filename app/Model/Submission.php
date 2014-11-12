<?php

class Submission extends AppModel {
	public $recursive = -1;

	public $primaryKey = 'id_submission';

	public $belongsTo = array(
		'Problem', 'User'
	);
}
