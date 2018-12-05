<?php
include("library.php"); 

$subject = $_POST["subject"];
$carrier = $_POST["carrier"];
$college = $_POST["college"];

$upload = new stdClass();

$upload -> college = (addEntrance("college",$college,null,null));

$upload -> carrier = (addEntrance("carrier",$carrier,"college",$college));

$upload -> subject = (addEntrance("subject",$subject,"carrier",$carrier));



echo(json_encode($upload));



?>
