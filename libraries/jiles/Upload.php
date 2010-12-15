<?php
namespace app\libraries\jiles;



class Upload {

static function handleUpload($variable_name,$uploaddir,$max_size = null){

    

	if (isset($_GET['qqfile'])){

		$class =  '\app\libraries\jiles\upload\Xhr';
        

   	} elseif (isset($_FILES['qqfile'])){

		$class =  '\app\libraries\jiles\upload\Form';


	} else {
		return array(success=>false);
	}


	$size = $class::getSize();
    
	if ($size == 0){
		return array(success=>false, error=>"File is empty.");
	}
	if ($max_size && $size > $max_size){
		return array(success=>false, error=>"File is too large.");
	}
    
	$pathinfo = pathinfo($class::getName());
	
	$filename = $pathinfo['filename'];
	$ext = $pathinfo['extension'];

    

	$class::save($uploaddir . $filename . '.' . $ext);

   return $class::getName();

    





}

}
?>