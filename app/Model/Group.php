<?php

class Group extends AppModel {
	public $recursive = -1;

	public $primaryKey = 'id_group';

	public $hasMany = array(
		'Quiz'
	);
}