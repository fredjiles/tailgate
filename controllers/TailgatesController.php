<?php

namespace app\controllers;

use \lithium\storage\Session;
use \app\models\Tailgate;
use \app\models\Member;

class TailgatesController extends JilesController {

	public function index() {
		$tailgates = Tailgate::all();
		return compact('tailgates');
	}

	public function view() {
		$tailgate = Tailgate::first(array('id'=>$this->request->id));
		return compact('tailgate');
	}

	public function add() {
		$tailgate = Tailgate::create();
         $session = Session::read('member');
         
         $tailgate->members = array();
         $tailgate->members[] = array('member_name'=>$session['name'],
                                      'member_id'=>$session['_id'],
                                        'creator'=>'X');

		if (($this->request->data) && $tailgate->save($this->request->data)) {
			$this->redirect(array('Tailgates::view', 'args' => array($tailgate->id)));
		}
		return compact('tailgate');
	}

	public function edit() {
		$tailgate = Tailgate::find($this->request->id);

		if (!$tailgate) {
			$this->redirect('Tailgates::index');
		}
		if (($this->request->data) && $tailgate->save($this->request->data)) {
			$this->redirect(array('Tailgates::view', 'args' => array($tailgate->id)));
		}
		return compact('tailgate');
	}

    
}

?>
