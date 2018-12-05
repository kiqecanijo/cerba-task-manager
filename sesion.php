<?php
session_start();
if(isset($_SESSION['name'])){
}else{
  header("Location: http://localhost/cerba/");
die();

}

include("php/library.php"); 



echo getFunction("jquery");

echo getStyle("materialize");
echo getFunction("task");

 getAsset("head");


 getAsset("nav-sesion");
 getAsset("sesion");

 getAsset("foot");


 echo getFunction("library");

 echo getFunction("materialize");
 echo getFunction("sesion");
 ?>
