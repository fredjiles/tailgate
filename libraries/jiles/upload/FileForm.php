<?php
/**
 * Description of FileForm
 *
 * @author fredjiles
 */
class Form {

    static function save($path){
		move_uploaded_file($_FILES['qqfile']['tmp_name'], $path);
	}

	static function getName(){
		return $_FILES['qqfile']['name'];
	}
    
	static function getSize(){
		return $_FILES['qqfile']['size'];
	}

}
?>
