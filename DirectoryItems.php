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
}

?>