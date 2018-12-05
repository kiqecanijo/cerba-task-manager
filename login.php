<?php
include("php/library.php"); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);



echo getFunction("jquery");
echo getFunction("materialize");
echo getFunction("library");
echo getStyle("materialize");


echo getAsset("head");
echo getAsset("login");
echo getFunction("login");
echo getAsset("foot");

?>
