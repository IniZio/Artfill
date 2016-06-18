<?php

$imagPath ='images/product/';
$savepath = 'images/product/thumb/';

if ($handle = opendir($imagPath)) {

    while (false !== ($fileName = readdir($handle))) {
		echo '<br>'.$fileName; 
		if(strlen($fileName) > 3) {
			$newFiles = explode('.',$fileName);
	        copy($imagPath.$fileName, $savepath.$fileName);
			ImageResizeWithCrop('280','206',$fileName,$savepath);
			
			
			
			@copy('./images/product/temp_img/'.$image_upload0, './images/product/org-image/'.$timeImg.'-'.$image_upload0);
					@copy('./images/product/temp_img/'.$image_upload0, './images/product/'.$timeImg.'-'.$image_upload0);
					$this->ImageResizeWithCrop(550, 350, $timeImg.'-'.$image_upload0, './images/product/');
					@copy('./images/product/'.$timeImg.'-'.$image_upload0, './images/product/thumb/'.$timeImg.'-'.$image_upload0);
					$this->ImageResizeWithCrop(175, 150, $timeImg.'-'.$image_upload0, './images/product/thumb/');
					@copy('./images/product/temp_img/'.$image_upload0, './images/product/list-image/'.$timeImg.'-'.$image_upload0);
					$this->ImageResizeWithCrop(75, 75, $timeImg.'-'.$image_upload0, './images/product/list-image/');
			
		}
    }
    closedir($handle);
}



 function ImageResizeWithCrop($width, $height, $thumbImage, $savePath){
		
		$thumb_file = $savePath.$thumbImage;
		
		$newimgPath = base_url().substr($savePath,2).$thumbImage;
		
		/* Get original image x y*/
		list($w, $h) = getimagesize($thumb_file);
		$size=getimagesize($thumb_file);
		/* calculate new image size with ratio */
		$ratio = max($width/$w, $height/$h);
		$h = ceil($height / $ratio);
		$x = ($w - $width / $ratio) / 2;
		$w = ceil($width / $ratio);
		/* new file name */
		$path = $savePath.$thumbImage;
		/* read binary data from image file */
		
		$imgString = file_get_contents($newimgPath);
		/* create image from string */
		$image = imagecreatefromstring($imgString);
		$tmp = imagecreatetruecolor($width, $height);
		imagecopyresampled($tmp, $image, 0, 0, $x, 0, $width, $height, $w, $h); 
	
		/* Save image */
		switch ($size["mime"]) {
			case 'image/jpeg':
				imagejpeg($tmp, $path, 100);
				break;
			case 'image/png':
				imagepng($tmp, $path, 0);
				break;
			case 'image/gif':
				imagegif($tmp, $path);
				break;
			default:
				exit;
			break;
		}
		return $path;
		/* cleanup memory */
		imagedestroy($image);
		imagedestroy($tmp);
	}

function imageResizeWithSpace($box_w,$box_h,$userImage,$savepath){
			
			$thumb_file = $savepath.$userImage;
				
			list($w, $h, $type, $attr) = getimagesize($thumb_file);
				
				$size=getimagesize($thumb_file);
			    switch($size["mime"]){
			        case "image/jpeg":
            			$img = imagecreatefromjpeg($thumb_file); //jpeg file
			        break;
			        case "image/gif":
            			$img = imagecreatefromgif($thumb_file); //gif file
				      break;
			      case "image/png":
			          $img = imagecreatefrompng($thumb_file); //png file
			      break;
				
				  default:
				        $im=false;
				    break;
				}
				
			$new = imagecreatetruecolor($box_w, $box_h);
			if($new === false) {
				//creation failed -- probably not enough memory
				return null;
			}
		
		
			$fill = imagecolorallocate($new, 255, 255, 255);
			imagefill($new, 0, 0, $fill);
		
			//compute resize ratio
			$hratio = $box_h / imagesy($img);
			$wratio = $box_w / imagesx($img);
			$ratio = min($hratio, $wratio);
		
			if($ratio > 1.0)
				$ratio = 1.0;
		
			//compute sizes
			$sy = floor(imagesy($img) * $ratio);
			$sx = floor(imagesx($img) * $ratio);
		
			$m_y = floor(($box_h - $sy) / 2);
			$m_x = floor(($box_w - $sx) / 2);
		
			if(!imagecopyresampled($new, $img,
				$m_x, $m_y, //dest x, y (margins)
				0, 0, //src x, y (0,0 means top left)
				$sx, $sy,//dest w, h (resample to this size (computed above)
				imagesx($img), imagesy($img)) //src w, h (the full size of the original)
			) {
				//copy failed
				imagedestroy($new);
				return null;
				
			}
			//imagedestroy($i);
			imagejpeg($new, $thumb_file, 99);
			
	}




 ?>