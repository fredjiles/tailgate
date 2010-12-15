<?php

namespace app\models;
define("MAPS_HOST", "maps.google.com");
define("KEY", "ABQIAAAADz2VvNuxtY2_jc3E9GbbIhQWb31DrCnLBC1fXtOJYOqutmgeuxSjDTm0ISbnOUxTrrjCgrI3Xe5eAg");
class Tailgate extends \lithium\data\Model {

	public $validates = array();

    private function geoCode($address,$city,$state,$zip){

		$query = '&q='.urlencode("$address $city $state $zip");
		$base_url = "http://" . MAPS_HOST . "/maps/geo?output=json&sensor=false&key=" . KEY;

		$response = @file_get_contents($base_url.$query);

		$json = new Services_JSON();

		$parsed = $json->decode($response);

		if($parsed->Status->code == 200){ // good response

			$address_info = explode(',',$parsed->Placemark[0]->address);

			$point = $parsed->Placemark[0]->Point->coordinates;


			if(count($address_info) == 4){
				$return['address'] = $address_info[0];
				$return['city'] = $address_info[1];
				$return['state'] = substr(str_replace(' ','',$address_info[2]), 0,2);
				$return['lat'] = $point[1];
				$return['lon'] = $point[0];

			}else{
				$return['address'] = '';
			}
		}

		return $return;
   	}

    public static function invite($tailgate,$member,$emails){

        $email_list = explode(',',$emails);
        $email_list = array_map('trim',$email_list);
        
        
        for($i=0;$i<count($email_list); $i++ ){
       
                $m = Member::find('first',array('conditions'=>array('email'=>$email_list[$i])));
                 if($m){
                   Member::addInvite($m->_id,$member,$tailgate);
                    unset($email_list[$i]);
                 }
            
        }
        
       
      
        $body = static :: generateInviteEmail($tailgate,$member);
        echo $body.'<br>';
       
       $transport = \Swift_MailTransport::newInstance();
       $mailer = \Swift_Mailer::newInstance($transport);
       $message = \Swift_Message::newInstance()
                ->setSubject('TailgateWith.me invitation')
               ->setFrom(array($member->email=>$member->name))
               ->setTo(array('fredjiles@gmail.com'))
               ->setBody($body,'text/html');
      $result = $mailer->send($message);
       
      



    }

    public static function addMember($_id,$member){

        $data = array('member_id'=>$member->_id,
                       'member_name'=>$member->name);

        
         $seq = static::_connection()->connection->command(
            array('findandmodify' => 'tailgates',
                  'query' => array('_id' => new \mongoId($_id)),
                  'update' => array('$push' => array('members' => $data)),
                  'new' => TRUE
            )
        );


        return $seq['value'];
    }
    public static function generateInviteEmail($tailgate,$member){
        $body = '<p>'.$member->name.' wants to invite you to join them tailgating for
            '.$tailgate->event.' on '.date('m/d/Y',$tailgate->date).'.  Click the link below to rsvp, join in planning, and follow all the conversation about this
                tailgate.<br><br>';

        $body .= '<a href="http://dev.tailgatewith.me/tailgates/join/'.$tailgate->_id.'">
            http://dev.tailgatewith.me/tailgates/join/'.$tailgate->_id.'</a>';
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

				$entity->date = strtotime($entity->date);

                return parent::save($entity, null, $options);

    }

}

?>