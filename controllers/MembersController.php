<?php

namespace app\controllers;

use \app\models\Member;
use \app\models\Tailgate;
use \app\models\Comment;
use \app\models\Invite;
use \lithium\security\Auth;
use \lithium\storage\Session;

class MembersController extends JilesController {

	public function index() {
    
		$member = Member::create($this->_session);

        if($this->request->id){

            Session::write('tailgate',$this->request->id);
        }
        if($this->request->data){
            
             Session::write('tailgate',$this->request->data['id']);
        }

        if($_id = Session::read('tailgate')){
            $conditions = array('_id'=>new \mongoId($_id),'members.member_id'=>$member->_id);
        }else{

            $conditions = array('date'=>array('>'=>strtotime('-1 day')),'members.member_id'=>$member->_id);

        }
       $tailgate = Tailgate::find('first',array('conditions'=>$conditions,'order'=>array('date'=>'asc')));
	$invites = Invite::find('all',array('conditions'=>array('to'=>$member->_id,'complete'=>array('<>'=>'X')),'order'=>array('date'=>'asc')));
       if($tailgate){
           $tailgates = Tailgate::find('all',array('conditions'=>array('members.member_id'=>$member->_id),
                   'order'=>array('date'=>'asc')));
           if($tailgates){
               foreach($tailgates as $tg){
                   $all["$tg->_id"] = $tg->event;
               }
           }
           
       }
		return compact('member','tailgate','all','invites');
	}

	

	

	public function edit() {
		$member = Member::first($this->_session['_id']);

		if (!$member) {
			$this->redirect('Members::index');
		}
		if (($this->request->data) && $member->save($this->request->data)) {
			$this->redirect(array('Members::index'));
		}
		unset($member->password);
		return compact('member');
	}

    public function comment(){

        $comment = Comment::create();
        $comment->post = $this->request->data['post'];
        $comment->member_id = $this->_session['_id'];
        $comment->datetime = strtotime('now');
        $comment->_id = $this->request->data['_id'];
        $comment->member_name = $this->_session['name'];

       // var_dump($comment);
        //die();
        $comment->save();
        $this->redirect(array('Members::index', 'args' => array($comment->_id)));
    }

    public function Login(){

	 if ($this->request->data) {

         $results =   Auth::check('member', $this->request);
         $redirect = (Session::read('return_url'));
         if($redirect == ''){
             $redirect = '/members/';
         }
		$this->redirect(Session::read('return_url'));
    }

	$sessions = Session ::  read('member');



	return compact('sessions');

	}

	public function  Logout() {

		$results = Auth::clear('member');

		$this->redirect('/');

	}
}

?>
