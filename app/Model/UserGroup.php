<?php

class UserGroup extends AppModel {
	public $recursive = -1;

	public $primaryKey = 'id_user_group';

	public $belongsTo = array(
		'Group'
	);
}