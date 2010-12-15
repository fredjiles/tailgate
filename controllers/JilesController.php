<?php
namespace app\controllers;

use app\models\Member;
use \lithium\security\Auth;
use \lithium\storage\Session;

class JilesController extends \lithium\action\Controller
{

    protected $_session;

	public function _init() {

		parent::_init();

         $this->_session = Session::read('member');
		if( $this->request->action != 'login' )  {


			if(!Auth::check( 'member' ) ){

				Session::write('return_url',$this->request->url);
				$this->redirect('/members/login');

			}
		}

	}
}