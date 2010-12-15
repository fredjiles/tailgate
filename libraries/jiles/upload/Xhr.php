<?php
namespace app\libraries\jiles\upload;

class Xhr {

    static function save($path){
		$input = fopen("php://input", "r");
		$fp = fopen($path, "w");
		while ($data = fread($input, 1024)){
			fwrite($fp,$data);
		}
		fclose($fp);
		fclose($input);
	}
	static function getName(){
		return $_GET['qqfile'];
	}
	static function getSize(){
		$headers = apache_request_headers();
		return (int)$headers['Content-Length'];
	}
    
}
?>
