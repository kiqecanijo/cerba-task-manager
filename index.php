<?php
include("php/library.php");

session_start();

echo getFunction("jquery");
echo getStyle("materialize");

 getAsset("head");
 getAsset("home");
 getAsset("foot");

 echo getFunction("library");
 echo getFunction("materialize");
 echo getFunction("home");

?>
