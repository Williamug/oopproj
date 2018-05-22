<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Images</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <?php
    
     require_once 'DirectoryItems.php';
     $di = new DirectoryItems('graphics');
     $di->checkAllImages()
        or die("Not all files are Images.");
     $di->naturalCaseInsensitiveOrder();

    //  get array
    echo '<div style="text-align:center;">';
    foreach ($di->filearray as $key => $value) {
        echo '<img src="graphics/$value" />\n';
    }
    echo '</div><br />';

    ?>
</body>
</html>