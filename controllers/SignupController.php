<?php

namespace app\controllers;

use \app\models\Member;
use \lithium\security\Auth;
use \lithium\storage\Session;

class SignupController extends \lithium\action\Controller {

	public function index() {
		 if($this->request->data ){

            $member = Member::create($this->request->data);

            if ($member->save()) {
                $results =   Auth::check('member', $this->request);
                $this->redirect("/");
            }else{
                unset($member->password);
            }

        }else{

			$member =  Member::create();

		}

		

        return compact('member', 'title');
	}

}