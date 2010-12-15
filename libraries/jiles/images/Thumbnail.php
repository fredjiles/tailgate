<?php
/**
 * Description of Thumbnail
 *
 * @author fredjiles
 */
namespace app\libraries\jiles\images;

class Thumbnail {

    protected $_image;

    public function __construct($image) {
        
        $this->_image = new \Imagick( $image );

    }
    
    public function createThumbnail($height, $width=null){
        $size = $this->getSize();

		if($height == null && width== null){
			Throw new Exception('Both Height and Width can not be empty');
		}
		if($height == null){
			$height = $width / $size['width']  * $size['height'];
		}
		
		$this->_image->cropThumbnailImage($width, $height);
		
       return  $this->_image->setImageFormat('jpg');
       
    }
    
    public function save($path){
       
        $this->_image->writeImage($path);
        
    }

    public function crop($height,$width,$x= 0,$y=0){

        $this->_image->chopImage($height, $width, 0, 0);

    }
    public function getSize(){
        $height = $this->_image->getImageHeight();
        $width = $this->_image->getImageWidth();

        return compact('height','width');
    }
}
?>
