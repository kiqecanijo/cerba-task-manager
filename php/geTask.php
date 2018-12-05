<?php
include("library.php"); 



$where = $_POST["table"];
$id = $_POST["table"];


 print_r(json_encode(geTask($where,$id)));




?>
