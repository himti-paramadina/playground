<?php

App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

App::import('Vendor', 'Parsedown', array('file' => 'Parsedown/Parsedown.php'));

class UsersController extends AppController {

	public $components = array(
		'Paginator'
	);

	public $helpers = array(
		'Markdown'
	);

	public $paginate = array(
		'limit' => 20
	);

	public function beforeFilter() {
		parent::beforeFilter();

		$this->Auth->allow('register', 'administration_add');
	}

	public function login() {
		if ($this->Auth->user('id_user') != null) {
			$this->redirect(array('controller' => 'users', 'action' => 'dashboard', 'administration' => false));
		}

		if ($this->request->is('post')) {

			if ($this->Auth->login()) {
	            return $this->redirect($this->Auth->redirect());
	        }
	        
	        $this->Session->setFlash("Wrong email and/or password combination.", 'flash/danger');
	    }

		$this->set('title_for_layout', "Passport needed.");
	}

	public function logout() {
		return $this->redirect($this->Auth->logout());
	}

	public function dashboard() {
		$this->loadModel('UserGroup');
		$this->UserGroup->recursive = 2;

		$userGroups = $this->UserGroup->find('all', array(
			'conditions' => array(
				'UserGroup.user_id' => $this->Auth->user('id_user')
			)
		));

		$this->set('userGroups', $userGroups);

		$this->set('title_for_layout', "Dashboard");
	}

	public function register() {
		$this->set('title_for_layout', "Registration");
	}

	/* Administration Functions */

	public function administration_index() {
		$this->User->recursive = 0;

		$this->Paginator->settings = $this->paginate;

		$users = $this->Paginator->paginate();

		$this->set('users', $users);

		$this->set('title_for_layout', "Index of Users");
	}

	public function administration_add() {
		if ($this->request->is('post')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash("New user has been successfully saved.", 'flash/success');
			}
			else {
				$this->Session->setFlash("Error while saving your new data.", 'flash/danger');
			}
		}

		$roles = $this->User->Role->find('list');
		$this->set('roles', $roles);

		$this->set('title_for_layout', "Add New User");
	}

	public function administration_edit($id) {
		$this->set('title_for_layout', "Edit User Data");
	}

	public function administration_delete($id) {
		$this->set('title_for_layout', "User Deletion Confirmation");
	}

}
