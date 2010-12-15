<?php

namespace app\controllers;

use \app\models\Invite;
use \app\models\Tailgate;
use \app\models\Member;

use \lithium\storage\Session;

class InvitesController extends JilesController {
	public function add(){
       
        $tailgate = Tailgate::first($this->request->id);
        $member = Member::create($this->_session);
        if ( ($this->request->data) ) {

            Invite::invite($tailgate,$member,$this->request->data['emails']);
		//@TODO Post flash message about invites sent.
		$this->redirect(array('Members::index'));
		}
        return compact('tailgate');
    }

    public function join(){

	$invite = Invite::first($this->request->id);
        $tailgate = Tailgate::first($invite->event_id);
	
        if($this->_session){
            $member = Member::create($this->_session);
            Tailgate::addMember($tailgate->_id,$member);
		$invite->joined = strtotime('now');
		$invite->complete = 'X';
		$invite->save();
        }else{
		echo 'you shouldn\'t be here';
	}

    }
	
}

?>
