<?php

namespace app\controllers;

class PagesController extends \lithium\action\Controller {

	public function view() {
        $sessions = \lithium\storage\Session ::  read('member');
        var_dump($sessions);
		$path = func_get_args();

		if (empty($path)) {
			$path = array('home');
		}
		$this->render(join('/', $path));
	}
}

?>