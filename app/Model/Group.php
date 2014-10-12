<?php

class Group extends AppModel {
	public $recursive = -1;

	public $primaryKey = 'id_group';

	public $belongsTo = array(
		'User'
	);

	public $hasMany = array(
		'Quiz'
	);
}