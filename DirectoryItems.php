<?php

// Creating a class
class DirectoryItems{
    private $filearray = array();

    // Creating the constructor
    public function __construct($directory, $replacechar = "_"){
        $this->directory = $directory;
        $this->replacechar = $replacechar;
        $d = '';

        if (is_dir($directory)) {
            $d = opendir($directory) 
               or die("Could not open directory");
               while (false !== ($f = readdir($d))) {
                   if (is_file("$directory/$f")) {
                       $title = $this->createTitle($f);
                       $this->filearray[$f] = $title;
                   }
               }
               closedir($d);
        } else {

            die("Must pass in a directory");
        }
        
    }

    function indexOrder(){
        sort($this->filearray);
    }

    function naturalCaseInsensitiveOrder(){
        natcasesort($this->filearray);
    }

    function getCount(){
        return count($this->filearray);
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

    private function createTitle($title){
        // Strip extnsion
        $title = substr($title, 0,strrpos($title, "."));

        // replace word separator
        $title = str_replace($this->replacechar, " ", $title);
        return $title;
    }
}

?>