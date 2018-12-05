<?php

include("library.php"); 




function getPostData(){
  $upload = new stdClass();

  $upload -> email = $_POST["email"];
  $upload -> pass = $_POST["password"];
  return $upload;
}




 if($thisSesion = login(getPostData())){
   http_response_code(200);
   session_start();
  $_SESSION['name'] = $thisSesion->name;
  $_SESSION['lastnamea'] = $thisSesion->lastnamea;
  $_SESSION['id'] = $thisSesion->id;
    $_SESSION['email'] = $thisSesion->email;
    $_SESSION['photo'] = $thisSesion->photo;
  echo "tu nombre logeado es: $_SESSION[name] ";
  echo "tu apellido logeado es: $_SESSION[lastnamea]  ";

 }else{
    http_response_code(400);
 }




//echo json_encode(getPostData());
?>
