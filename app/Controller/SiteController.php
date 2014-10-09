<?php

class SiteController extends AppController {
	
	public $uses = array();

	public function beforeFilter() {
		parent::beforeFilter();

		$this->layout = 'bootstrap/default_site';

		$this->Auth->allow();
	}

	public function index() {
		$this->set('title_for_layout', "Home");
	}

}
