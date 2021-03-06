<?php
    // http://localhost/Test_image2svg.php?gif
    if(!@include_once "XML/image2svg.php") {
        include_once "../../image2svg.php";
    }

    // Define test images 
    $arr = array(
        "png" => "test.png",
        "gif" => "test.gif",
        "jpg" => "test.jpg",
        "bmp" => "test.bmp"     // Force an unsupported mimetype
    );

    // Define a template SVG to be used
    $useTpl = true;

    if(isset($argv[0]) && !array_key_exists((string)$argv[0], $arr) || !isset($argv[0])) {
        $file = "test.png";
    } else {
        $file = $arr[$argv[0]];
    }

    // Convert an image to SVG
    $i = &new XML_image2svg($file);
    if($useTpl) $i->tplFile = "tpl.image.svg";
    $i->show();
?>