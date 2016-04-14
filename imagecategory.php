<?php
$basePath = 'http://shopsy.zoplay.com/';

$imagPath ='images/category/';
$savepath = 'images/category/mb/';

if ($handle = opendir($imagPath)) {

    while (false !== ($fileName = readdir($handle))) {
		echo '<br>'.$fileName; 
		if(strlen($fileName) > 3 && $fileName!='banner' && $fileName!='Thumbs.db') {
			$newFiles = explode('.',$fileName);
	        @copy($imagPath.$fileName, $savepath.$fileName);
			ImageResizeWithCrop('350','350',$fileName,$savepath);
			
		}
    }
    closedir($handle);
}



 function ImageResizeWithCrop($width, $height, $thumbImage, $savePath){
		
		$thumb_file = $savePath.$thumbImage;
		
		//$newimgPath = $basePath.substr($savePath,2).$thumbImage;
		$newimgPath = 'http://shopsy.zoplay.com/'.$savePath.$thumbImage;
		//echo $newimgPath;die;
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
			case 'image/bmp':
				imagejpeg($tmp, $path, 100);
				break;
			case 'image/bmp':
				imagejpeg($tmp, $path, 100);
				break;	
			case 'image/x-ms-bmp':
				imagejpeg($tmp, $path, 100);
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
 ?>