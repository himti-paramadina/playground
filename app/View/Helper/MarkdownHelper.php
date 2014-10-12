<?php

App::import('Vendor', 'Parsedown', array('file' => 'Parsedown/Parsedown.php'));

App::uses('AppHelper', 'View/Helper');

class MarkdownHelper extends AppHelper {
	
	public function parse($text) {
		$parser = new Parsedown();

		return $parser->text($text);
	}

}
