<?php

namespace app\models;

use \lithium\util\Validator;
use \lithium\util\String;


class Member extends \lithium\data\Model {

    static $userSalt = 'goGreen';
    public $validates = array(
        'name' => 'Please enter some content for this post',
        'email' => array(
            array('notEmpty', 'message' => 'Email cannot be empty'),
            array('isUniqueEmail', 'message' => 'Email must be unique')
        )
    );

    public static function __init(array $options = array()) {

			parent::__init($options);


			Validator::add('isUniqueEmail', function ($value, $format, $options) {
				$conditions = array('email' => $value);

				// If editing the user, skip the current user
				if (isset($options['values']['_id'])) {
					$conditions[] = '_id != ' . $options['values']['_id'];
				}

				// Lookup for users with same email
				return !Member::find('first', array('conditions' => $conditions));
			});

			

		}

	public static function validate($data) {



        if (!$data['conditions']['email']) {
            return;
        }

        $user = static::find('first', array(
            'conditions' => array(
                'email' => $data['conditions']['email'],
                'password' => String::hash($data['conditions']['password'], 'sha1', static::$userSalt)
            ),
        ));

        if ($user->email) {
            return $user;
        }
        return;
    }

    public static function addInvite($_id,$invite,$tailgate){

        $data = array('to'=>$tailgate->_id,
                        'from'=>$invite->_id,
                        'event'=>$tailgate->event,
                        'date'=>$tailgate->date);
        
        $seq = static::_connection()->connection->command(
            array('findandmodify' => 'members',
                  'query' => array('_id' => new \mongoId($_id)),
                  'update' => array('$push' => array('invites' => $data)),
                  'new' => TRUE
            )
        );


        return $seq['value'];


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
