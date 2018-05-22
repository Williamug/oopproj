<?php

// Creating a class
class DirectoryItems{
    var $filearray = array();

    // Creating the constructor
    function DirectoryItems($directory){
        $d = '';
        if (is_dir($directory)) {
            $d = opendir($directory) 
               or die("Could not open directory");
               while (false !== ($f = readdir($d))) {
                   if (is_file("$directory/$f")) {
                       $this->filearray[] = $f;
                   }
               }
               closedir($d);
        } else {

            die("Must pass in a directory");
        }
        
    }

    // check if file is an image
    function checkAllImages(){
        $bln = true;
        $extention = "";
        $types = array("jpg", "jpeg", "gif", "png");

        foreach ($this->filearray as $key => $value) {
            $extention = substr($value, (strpos($value, ".") + 1));
            $extention = strtolower($extention);

            if (!in_array($extention, $types)) {
                $bln = false;
                break;
            }
        }
        return $bln;
    }
}

?>