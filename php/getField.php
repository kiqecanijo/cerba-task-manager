<?php
include("library.php"); 



$toGet = $_POST["table"];


 print_r(json_encode(getField($toGet)));




?>
