<?php

namespace app\models;
use \app\models\Tailgate;

class Comment extends \lithium\data\Model {

	public $validates = array();

    public function save($entity, $data = null, array $options = array()) {

		if ($data) {
			$entity->set($data);
		}
        $_id = $entity->_id;
        unset($entity->_id);
       
         $seq = static::_connection()->connection->command(
            array('findandmodify' => 'tailgates',
                  'query' => array('_id' => new \mongoId($_id)),
                  'update' => array('$push' => array('comments' => $entity->data())),
                  'new' => TRUE
            )
        );

       
        return $seq['value'];

        

    }
}

?>
