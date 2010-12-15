<?php

namespace app\controllers;


use \app\models\Member;
use app\libraries\jiles\Upload;

class ImagesController extends JilesController{

	

	public function addProfileImage() {
		// need to change this to use other method if not firefox

		
		$upload_path = LITHIUM_APP_PATH."/resources/tmp/images/";
        $temp_file = Upload::handleUpload('test',$upload_path);

        $thumb = new \app\libraries\jiles\images\Thumbnail($upload_path.$temp_file);
		$file_name = $this->_session['_id'].'.jpg';
       $thumb->createThumbnail(null,200);

	      $thumb->save(LITHIUM_APP_PATH."/webroot/img/members/profile/".$file_name);

        $thumb->createThumbnail(50,50);

		
        $thumb->save(LITHIUM_APP_PATH."/webroot/img/members/small/".$file_name);
      
      
        // add time stamp on so that the picture will refresh in the view.
		
       $result = array("success"=>true,"file"=>"/img/members/profile/".$file_name."?".strtotime('now'));
        echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
        
		  die();
			
		
	}


}

?>