<?php
    class ThumbnailImage{
        // declaration of data members
        private $image;
        private $quality = 100;
        private $mimetype;
        private $imageproperties = array();
        private $initialfilesize;

        // Deconstructing the constructor
        public function __construct($file, $thumbnailsize=100){
            // check file
            is_file($file)
                or die("File: $file does not exit.");
            $this->initialfilesize = filesize($file);
            $this->imageproperties = getimagesize($file)
                or die("Incorrect file_type.");
        
        // new fuction image_type_to_mime_type
            $this->mimetype = image_type_to_mime_type($this->imageproperties[2]);
            
            //create an image
            switch ($this->imageproperties[2]) {
                case IMAGETYPE_JPEG:
                    $this->image = imagecreatefromJPEG($file);
                    break;
                
                case IMAGETYPE_GIF:
                    $this->image = imagecreatefromJPEG($file);
                    break;
                
                case IMAGETYPE_PNG:
                    $this->image = imagecreatefromJPEG($file);
                    break;
                    
                default:
                    die("Could not create image");
            }
            $this->createThumb($thumbnailsize); 
        }

        // image reduction method
        private function createThumb($thumbnail){
            // array elements for width and height
            $srcW = $this->imageproperties[0];
            $srcH = $this->imageproperties[1];

            // only adjust if the size is larger than the maximum
            if ($srcW > $thumbnailsize || $srcH > $thumbnailsize) {
                $reduction = $this->calculateReduction($thumbnailsize);

                // get propertions
                $desW = $srcW/$reduction;
                $desH = $srcH/$reduction;

                $copy = imagecreatetruecolor($desW, $desH);
                imagecopyresampled($copy, $this->image, 0, 0, 0, 0, $desW, $desH, $srcW, $srcH)
                    or die("Image copy failed.");
                // destroy original
                imagedestroy($this->image);
                $this->image = $copy;

            } 
        }

        // method to calculate and reduce the size of the image
        private function calculateReduction($thumbnailsize){
            $srcW = $this->imageproperties[0];
            $srcH = $this->imageproperties[1];

            // adjust the size
            if ($srcW < $srcH) {
                $reduction = round($srcH/$thumbnailsize);
            } else {
                $reduction = round($srcW/$thumbnailsize);
            }
            return $reduction;
        }

        // Displaying the image to the browser
        public function getImage(){
            header("Content-type: $this->mimetype");
            switch ($this->imageproperties[2]) {
                case IMAGETYPE_JPEG:
                    imagejpeg($this->image, "", $this->quality);
                    break;
                
                case IMAGETYPE_GIF:
                    imagejpeg($this->image, "", $this->quality);
                    break;
                
                case IMAGETYPE_PNG:
                    imagejpeg($this->image, "", $this->quality);
                    break;    
                
                default:
                    die("Could not create an Image");
            }
        }

        // getting the mimetype to the browser
        public function getMimeType(){
            return $this->mimetype;
        }
        
        // improving the image quality
        public function setQuality($quality){
            if ($quality > 100 || $quality < 1) {
                $quality = 75;
                if ($this->imageproperties[2] == IMAGE_JPEG || $this->imageproperties[2] == IMAGE_PNG) {
                    $this->quality = $quality;
                }
            }
        }
}
?>