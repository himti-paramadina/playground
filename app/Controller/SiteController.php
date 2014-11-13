<?php

class SiteController extends AppController {
	
	public $uses = array();

	public function beforeFilter() {
		parent::beforeFilter();

		$this->layout = 'bootstrap/default_site';

		$this->Auth->allow();
	}

	public function index() {
		$this->loadModel('Group');
		$this->Group->recursive = 1;

		$userGroups = $this->Group->find('all');

		$this->set('userGroups', $userGroups);

		$this->set('title_for_layout', "Home");
	}

}
