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

    public function indexOrder(){
        sort($this->filearray);
    }

    public function naturalCaseInsensitiveOrder(){
        natcasesort($this->filearray);
    }

    public function getCount(){
        return count($this->filearray);
    }

   
    // Method to generate new file titles 
    private function createTitle($title){
        // Strip extnsion
        $title = substr($title, 0, strrpos($title, "."));

        // replace word separator
        $title = str_replace($this->replacechar, " ", $title);
        return $title;
    }

    // Check all the file extension of the files
    public function checkAllSpecificTypes($extension){
        $extension = strtolower($extension);
        $bln = true;
        $ext = "";
        foreach ($this->filearray as $key => $value) {
            $ext = substr($key, (strpos($key, ".") + 1));
            $ext = strtolower($ext);
            if ($extension != $ext) {
                $bln = false;
                break;
            }
        }
        return $bln;
    }

    // filter method to filter all the files
    public function filter($extension){
        $extension = strtolower($extionsoion);
        foreach ($this->filearray as $key => $value) {
            $ext = substr($key, (strpos($key, ".") + 1));
            $ext = strtolower($ext);
            if ($ext != $extension) {
                unset($this->filearray[$key]);
            }
        }
    }

    // reset the file directory to show files again
    public function removeFilter(){
        unset($this->filearray);
        $d = "";
        $d = opendir($this->directory)
            or die("Could not open the directory");
        while (false !== ($f = readdir($d))) {
            if(is_file("$this->directory/$f")){
                $title = $this->createTitle($f);
                $this->filearray[$f] = title;
            }
        }
    }

    // filter all images/ Image only
    public function imagesOnly(){
        $extension = '';
        $types = array("jpg", "jpeg", "gif", "png");
        foreach ($this->filearray as $key => $value) {
            $extension = substr($key, (strpos($key, ".") + 1));
            $extension = strrolower($extension);
            if (!in_array($extionsion, $types)) {
                unset($this->filearray[$key]);
            }
        }
    }
}

?>