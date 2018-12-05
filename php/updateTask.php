<?php
include("library.php"); 



$status = $_POST["status"];
$id = $_POST["id"];


updateTask($id,$status);




?>
