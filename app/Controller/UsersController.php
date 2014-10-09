<?php

App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class UsersController extends AppController {

	public $components = array(
		'Paginator'
	);

	public function beforeFilter() {
		parent::beforeFilter();

		$this->Auth->allow('administration_add');
	}

	public function login() {
		if ($this->request->is('post')) {
			
			echo $passwordHasher->hash($this->request->data['User']['password']);
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

	}

	/* Administration Functions */

	public function administration_index() {
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
