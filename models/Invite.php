<?php

namespace app\models;

class Invite extends \lithium\data\Model {

	public $validates = array();

    
    public static function invite($tailgate,$member,$emails){

        $email_list = explode(',',$emails);
        $email_list = array_map('trim',$email_list);
        
        //@TODO check there is not an invite already sent

        foreach($email_list as $e){
       		$data = array('from'=>$member->_id,
				'event_id'=>$tailgate->_id,
				'event'=>$tailgate->event,
				'date'=>$tailgate->date);

                $m = Member::find('first',array('conditions'=>array('email'=>$e)));
                 if($m){

			$data['to'] = $m->_id;
                   $invite = Invite::create($data);
			$invite->save();

                    
                 }else{
			$data['email'] = $e;
			$invite = Invite::create($data);
			$invite->save();
			self::sendEmailInvite($tailgate,$member,$invite);
		}
            
        }
        }
       
      protected function sendEmailInvite($tailgate,$member,$invite){
        $body = static :: generateInviteEmail($tailgate,$member,$invite);
        
       
       $transport = \Swift_MailTransport::newInstance();
       $mailer = \Swift_Mailer::newInstance($transport);
       $message = \Swift_Message::newInstance()
                ->setSubject('TailgateWith.me invitation')
               ->setFrom(array($member->email=>$member->name))
               ->setTo(array('fredjiles@gmail.com'))
               ->setBody($body,'text/html');
      $result = $mailer->send($message);
       
      



    }

    
    public static function generateInviteEmail($tailgate,$member,$invite){
        $body = '<p>'.$member->name.' wants to invite you to join them tailgating for
            '.$tailgate->event.' on '.date('m/d/Y',$tailgate->date).'.  Click the link below to rsvp, join in planning, and follow all the conversation about this
                tailgate.<br><br>';

        $body .= '<a href="http://dev.tailgatewith.me/tailgates/join/'.$invite->_id.'">
            http://dev.tailgatewith.me/tailgates/join/'.$invite->_id.'</a>';
        $body .='</p>';

        return $body;
    }
    public function save($entity, $data = null, array $options = array()) {

		if ($data) {
			$entity->set($data);
		}

        if (!$entity->id) {
					$entity->created = date('Y-m-d H:i:s');
				} else {
					$entity->modified = date('Y-m-d H:i:s');
				}

				

                return parent::save($entity, null, $options);

    }

}

?>
