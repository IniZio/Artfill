<?php 
class ImageGrid
{

    private $realWidth;
    private $realHeight;
    private $gridWidth;
    private $gridHeight;
    public $image;
	
	 public function __construct($realWidth, $realHeight, $gridWidth, $gridHeight,$filename_result)
    {
        $this->realWidth = $realWidth;
        $this->realHeight = $realHeight;
        $this->gridWidth = $gridWidth;
        $this->gridHeight = $gridHeight;
		$this->filename_result=$filename_result;
        // create destination image
        $this->image = imagecreatetruecolor($realWidth, $realHeight);
        $white = imagecolorallocate($this->image, 255, 255, 255);
        imagecolortransparent($this->image, $white);
    }

    public function makegrid($realWidth, $realHeight, $gridWidth, $gridHeight,$filename_result)
    {
        $this->realWidth = $realWidth;
        $this->realHeight = $realHeight;
        $this->gridWidth = $gridWidth;
        $this->gridHeight = $gridHeight;
		$this->filename_result=$filename_result;
        // create destination image
        $this->image = imagecreatetruecolor($realWidth, $realHeight);

        // set image default background
        $white = imagecolorallocate($this->image, 255, 255, 255);
        imagefill($this->image, 0, 0, $white);
    }

   
       //imagedestroy($this->image);
	public function demoGrid()
	{
		$black = imagecolorallocate($this->image, 255, 255, 255);
		imagesetthickness($this->image, 3);
		$cellWidth = ($this->realWidth - 1) / $this->gridWidth;   // note: -1 to avoid writting
		$cellHeight = ($this->realHeight - 1) / $this->gridHeight; // a pixel outside the image
		for ($x = 0; ($x <= $this->gridWidth); $x++)
		{
			for ($y = 0; ($y <= $this->gridHeight); $y++)
			{
				imageline($this->image, ($x * $cellWidth), 0, ($x * $cellWidth), $this->realHeight, $black);
				imageline($this->image, 0, ($y * $cellHeight), $this->realWidth, ($y * $cellHeight), $black);
			}
		}
	}
	public function putImage($img, $sizeW, $sizeH, $posX, $posY,$i=0,$j=0)
	{
	
		// Cell width
		$cellWidth = $this->realWidth / $this->gridWidth;
		$cellHeight = $this->realHeight / $this->gridHeight;
		// Conversion of our virtual sizes/positions to real ones
		$realSizeW = ceil($cellWidth * $sizeW);
		$realSizeH = ceil($cellHeight * $sizeH);
		$realPosX = ($cellWidth * $posX);
		$realPosY = ($cellHeight * $posY);
	

		// Copying the image
	
		//bool imagecopyresampled ( resource $dst_image , resource $src_image , int $dst_x , int $dst_y , int $src_x , int $src_y , int $dst_w , int $dst_h , int $src_w , int $src_h )
		//echo "sdf";
		//echo "sdf";
		if($j== 4 ){
		if($i==4){
		$realSizeH = 250;
		}
		if($i==3){
		$realSizeW = 250;
		$realSizeH = 250;
		}
		}
		imagecopyresampled($this->image, $img, $realPosX, $realPosY, 0, 0, $realSizeW, $realSizeH, imagesx($img), imagesy($img));
		//header("Content-type: image/png");
		//imagepng($this->image);  
		///echo "sdf";die;
	}
	
	
	
	public function putImage1($img, $sizeW, $sizeH, $posX, $posY)
	{
	
		// Cell width
		
		
		$cellWidth = $this->realWidth / $this->gridWidth;
		$cellHeight = $this->realHeight / $this->gridHeight;

		// Conversion of our virtual sizes/positions to real ones
		$realSizeW = ceil($cellWidth * $sizeW);
		$realSizeH = ceil($cellHeight * $sizeH);
		$realPosX = ($cellWidth * $posX);
		$realPosY = ($cellHeight * $posY);
	   
        print_r('$sizeW='.$sizeW.'$sizeH='.$sizeH.'$posX='.$posX.'$posY='.$posY.'</br></br></br>');
		   print_r('$cellWidth='.$cellWidth.'$cellHeight='.$cellHeight.'$realSizeW='.$realSizeW.'$realSizeH='.$realSizeH.'</br></br></br>');
		    print_r('$realPosX='.$realPosX.'$realPosY='.$realPosY);
		
		// Copying the image
	
		//bool imagecopyresampled ( resource $dst_image , resource $src_image , int $dst_x , int $dst_y , int $src_x , int $src_y , int $dst_w , int $dst_h , int $src_w , int $src_h )
		//echo "sdf";
		//echo "sdf";
		//echo imagesx($img);
		//echo imagesy($img);die;
		imagecopyresampled($this->image, $img, $realPosX, $realPosY, 0, 0, $realSizeW, $realSizeH, imagesx($img), imagesy($img));
		//header("Content-type: image/png");
		//imagepng($this->image);  
		///echo "sdf";die;
	}
	
	
    public function display()
    {
		header("Content-type: image/png");
		imagepng($this->image);
       $imgname=md5(time().rand(10,99999999).time()).".jpg";
          imagejpeg($this->image, './imageprocess/'.$imgname, 99);   
return base_url().'/imageprocess/'.$imgname	;	  
        imagejpeg($this->image,$this->filename_result);
		imagedestroy($this->image);
    }
	 public function save_image()
    {
		
        $imgname=md5(time().rand(10,99999999).time()).".jpg";
          imagejpeg($this->image, './imageprocess/'.$imgname, 99);   
      return base_url().'/imageprocess/'.$imgname	;	  
     
    }

}
?>