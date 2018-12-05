<?php

include("library.php"); 


  $upload = new stdClass();
  $upload -> hour = $_POST["hour"];
  $upload -> subject = $_POST["subject"];
  $upload -> date = $_POST["date"];
  $upload -> name = $_POST["name"];
  $upload -> description = $_POST["description"];

  addTask($upload);


// print_r(json_encode($upload));



?>
