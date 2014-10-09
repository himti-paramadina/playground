<?php

App::import('Vendor', 'Parsedown', array('file' => 'Parsedown/Parsedown.php'));

class MarkdownController extends AppController {

	public $uses = array();

	public $components = array(
		'RequestHandler'
	);

	public function beforeFilter() {
		parent::beforeFilter();

		$this->Auth->allow();
	}

	public function api_parse() {
		$response = array();

		if ($this->request->is('post')) {
			$text = $this->request->data['text'];

			$parser = new Parsedown();

			$response['parsed_text'] = $parser->text($text);
		}

		$this->set(compact('response'));
        $this->set('_serialize', array('response'));
	}

}