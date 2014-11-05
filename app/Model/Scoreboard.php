<?php

class Scoreboard extends AppModel {
	public $recursive = -1;

	public $primaryKey = 'id_scoreboard';

	public $belongsTo = array(
		'User'
	);
}