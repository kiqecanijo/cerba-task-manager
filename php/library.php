<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

function betweenTag($tag,$content){
  $between = "<$tag>".$content."</$tag>";
  return $between;
};

function getAsset($path){
  $asset = include("assets/$path.html");
  return $asset;
};

function getFunction($path){
  $asset = file_get_contents("js/functions/$path.js");
  return betweenTag("script",$asset);
};

function getStyle($path){
  $asset = file_get_contents("css/$path.css");
  return betweenTag("style",$asset);
};

function RemoveCorrentSession(){
  // remove all session variables
  session_unset();

  // destroy the session
  session_destroy();
}


function cleanSQL($cleanme){
  $cleanme = (stripslashes($cleanme));
  return $cleanme;
};

function checkStatus(){
  if (session_status() == PHP_SESSION_NONE) {
    header("Location: http://example.com/myOtherPage.php");
  }else{
    header("Location: http://example.com/myOtherPage.php");
  }
}





//inserting data in database
function conectUpload($upload){
  $name = cleanSQL($upload->name);
  $lastnamea = cleanSQL($upload->lastnamea);
  $lastnameb = cleanSQL($upload->lastnameb);
  $email = cleanSQL($upload->email);
  $pass = cleanSQL($upload->pass);
  $cpass = cleanSQL($upload->cpass);

  //definition, and access
  include("access.php");
  $path =  "mysql:dbname=$dbname;host=$servername";
  //concection try via PDO
  try{
    $conn = new PDO($path,$put_username,$put_password);
    $insertion = $conn->prepare("INSERT INTO user(name,lastnamea,lastnameb,email,pass,type)VALUES (:name,:lastnamea,:lastnameb,:email,:pass,1)");

    $insertion->bindValue(':name', $name, PDO::PARAM_STR);
    $insertion->bindValue(':lastnamea', $lastnamea, PDO::PARAM_STR);
    $insertion->bindValue(':lastnameb', $lastnameb, PDO::PARAM_STR);
    $insertion->bindValue(':email', $email, PDO::PARAM_STR);
    $insertion->bindValue(':pass', $pass, PDO::PARAM_STR);
    //insertion error
    if(!$insertion->execute() ){
      http_response_code(406);
      echo "error al insertar";
    }
  } catch (PDOException $e) {
    //concetion error
    http_response_code(401);
    echo "error al conectar";
  }
}

function getID($where,$insert){
  //definition, and access
  include("access.php");
  $path =  "mysql:dbname=$dbname;host=$servername";
  //concection try via PDO
  try{
    $conn = new PDO($path,$get_username,$get_password);
    //$insertion = $conn->prepare("SELECT count(*) FROM user WHERE email = :email ");

    $query = $conn->prepare( "SELECT id FROM $where WHERE name = '$insert'" );

    $query->execute();
    $query = $query->fetchAll();
    $query = $query[0]['id'];
    return $query;

  }catch (PDOException $e) {
    http_response_code(401);
    echo "error al conectar";
  }


};


//add entrance whit a refencenced key
function addEntrance($whereInsert,$insert,$whereReference,$toReference){
  $insert = cleanSQL($insert);
  $toReference = cleanSQL($toReference);
  $toId = null;
  if($whereReference != null && $toReference != null) {
    $toId = getID($whereReference,$toReference);
  }
  //definition, and access
  include("access.php");
  $path =  "mysql:dbname=$dbname;host=$servername";

  //concection try via PDO
  try{
    $conn = new PDO($path,$get_username,$get_password);
    //$insertion = $conn->prepare("SELECT count(*) FROM user WHERE email = :email ");
    if($toId == null){
      $query =  $conn->prepare("INSERT INTO $whereInsert (name) VALUES (:name)");
      $query->bindValue( ':name', $insert,PDO::PARAM_STR);
    }else{
      $query =  $conn->prepare("INSERT INTO $whereInsert (name,$whereReference)VALUES (:name,$toId)");
      $query->bindValue( ':name', $insert,PDO::PARAM_STR);
    }

    if(!$query->execute() ){
      http_response_code(406);
      return false;
    }else{
      http_response_code(200);
      return true;
    }
  } catch (PDOException $e) {
    http_response_code(401);
    echo "error al conectar";
  }


};



//get Colleges
function getField($toGet){
  $toGet = cleanSQL($toGet);

  //definition, and access
  include("access.php");
  $path =  "mysql:dbname=$dbname;host=$servername";
  //concection try via PDO
  try{
    $conn = new PDO($path,$get_username,$get_password);

    $query = $conn->prepare( "SELECT name FROM $toGet" );
    $query->execute();


    $query = $query->fetchAll();

    return $query;

  } catch (PDOException $e) {
    http_response_code(401);
    echo "error al conectar";
  }
}

//get task
function geTask($toGet){
  session_start();

  $toGet = cleanSQL($toGet);
    $id = $_SESSION['id'];

  //definition, and access
  include("access.php");
  $path =  "mysql:dbname=$dbname;host=$servername";
  //concection try via PDO
  try{
    $conn = new PDO($path,$get_username,$get_password);

    $query = $conn->prepare( "SELECT * FROM $toGet WHERE visible = 1 AND user = $id ORDER BY date DESC");


    $query->execute();


    $query = $query->fetchAll();

    return $query;

  } catch (PDOException $e) {
    http_response_code(401);
    echo "error al conectar";
  }
}





function allreadyTask($name,$user,$subject,$date){
  //definition, and access
  include("access.php");
  $path =  "mysql:dbname=$dbname;host=$servername";
echo "x";
  echo $date;


  //concection try via PDO
  try{
    $conn = new PDO($path,$get_username,$get_password);
    //$insertion = $conn->prepare("SELECT count(*) FROM user WHERE email = :email ");

    $query = $conn->prepare( "SELECT id FROM task WHERE name = :name && user = :user && subject = :subject && date = :fecha" );

    $query->bindValue(':name', $name, PDO::PARAM_STR);
    $query->bindValue(':user', $user, PDO::PARAM_INT);
    $query->bindValue(':subject', $subject, PDO::PARAM_INT);
    $query->bindValue(':fecha', $date, PDO::PARAM_INT);
    $query->execute();

    if( $query->rowCount() > 0 ) {
        return  true;
    }
    else {
        return false;

    }
  }catch (PDOException $e) {
    http_response_code(401);
  }
}


//validate allready using email data in database
function allreadyuser($upload){
  $email = cleanSQL($upload->email);
  //definition, and access
  include("access.php");
  $path =  "mysql:dbname=$dbname;host=$servername";
  //concection try via PDO
  try{
    $conn = new PDO($path,$get_username,$get_password);
    //$insertion = $conn->prepare("SELECT count(*) FROM user WHERE email = :email ");

    $query = $conn->prepare( "SELECT * FROM user WHERE email = :email" );
    $query->bindValue( ':email', $email,PDO::PARAM_STR);
    $query->execute();

    /*who have mi email?

    $query = $query->fetchAll();

    print_r("el email ya a sido asignado al usuario se a asignado al usuario ".$query[0]['name']);*/


    if( $query->rowCount() > 0 ) {
      return true;
      echo "Email found!";
      print_r($query);
    }
    else {
      return false;
      echo "Email not found!";
      print_r($query);

    }


  } catch (PDOException $e) {
    http_response_code(401);
    echo "error al conectar";
  }
};

//add task

function addTask($upload){
  session_start();


  $hour = cleanSQL($upload->hour);
  $subject = cleanSQL($upload->subject);
  $date = cleanSQL($upload->date);
  $name = cleanSQL($upload->name);
  $description = cleanSQL($upload->description);
  $id = $_SESSION['id'];


  $subject  = getID('subject',$subject);

  //definition, and access
  include("access.php");
  $path =  "mysql:dbname=$dbname;host=$servername";

  if(allreadyTask($name,$id,$subject,$date)){
    http_response_code(406);

  }else{
      //concection try via PDO
      try{
        $conn = new PDO($path,$put_username,$put_password);
        $insertion = $conn->prepare("INSERT INTO task VALUES (null,:name,:user,:subject,:fecha,:description,false,true)");

        $insertion->bindValue(':name', $name, PDO::PARAM_STR);
        $insertion->bindValue(':user', $id, PDO::PARAM_INT);
        $insertion->bindValue(':subject', $subject, PDO::PARAM_INT);
        $insertion->bindValue(':fecha', $date, PDO::PARAM_INT);
        $insertion->bindValue(':description', $description, PDO::PARAM_STR);


        //insertion error
        if(!$insertion->execute() ){
          http_response_code(406);
          echo "error al insertar";
        }
      } catch (PDOException $e) {
        //concetion error
        http_response_code(401);
        echo "error al conectar";
      }
  }
}

//updateTask

function updateTask($id,$status){
  $status = cleanSQL($status);
  $id = cleanSQL($id);


  if($status == 'true'){
    $status = 1;
  }else{
    $status = 0;
  }

  //definition, and access
  include("access.php");
  $path =  "mysql:dbname=$dbname;host=$servername";

      //concection try via PDO
      try{
        $conn = new PDO($path,$put_username,$put_password);
        $insertion = $conn->prepare("UPDATE  task SET status  = :status WHERE task.id = :id");
        $insertion->bindValue(':status', $status, PDO::PARAM_STR);
        $insertion->bindValue(':id', $id, PDO::PARAM_INT);

        //insertion error
        if(!$insertion->execute() ){
          http_response_code(406);
          echo "error al insertar";
        }else{
          http_response_code(200);
        }
      } catch (PDOException $e) {
        //concetion error
        http_response_code(401);
        echo "error al conectar";
      }
}


//deleteTask

function deleteTask($id){
  $id = cleanSQL($id);



  //definition, and access
  include("access.php");
  $path =  "mysql:dbname=$dbname;host=$servername";

      //concection try via PDO
      try{
        $conn = new PDO($path,$put_username,$put_password);
        $insertion = $conn->prepare("UPDATE  task SET visible  = 0 WHERE task.id = :id");
        $insertion->bindValue(':id', $id, PDO::PARAM_INT);

        //insertion error
        if(!$insertion->execute() ){
          http_response_code(406);
          echo "error al insertar";
        }else{
          http_response_code(200);
        }
      } catch (PDOException $e) {
        //concetion error
        http_response_code(401);
        echo "error al conectar";
      }
}



//validate allready using email data in database
function login($upload){
  $email = cleanSQL($upload->email);
  $pass = cleanSQL($upload->pass);

  //definition, and access
  include("access.php");
  $path =  "mysql:dbname=$dbname;host=$servername";
  //concection try via PDO
  try{
    $conn = new PDO($path,$get_username,$get_password);
    //$insertion = $conn->prepare("SELECT count(*) FROM user WHERE email = :email ");

    $query = $conn->prepare( "SELECT * FROM user WHERE email = :email" );
    $query->bindValue( ':email', $email,PDO::PARAM_STR);
    $query->execute();

    /*who have mi email?

    $query = $query->fetchAll();

    print_r("el email ya a sido asignado al usuario se a asignado al usuario ".$query[0]['name']);*/
    $query = $query->fetchAll();
    if(($query[0]['pass']) == $pass && $pass != ""){

      $thisUser = new stdClass();
      $thisUser -> name = $query[0]['name'];
      $thisUser -> lastnamea = $query[0]['lastnamea'];
      $thisUser -> id = $query[0]['id'];
      $thisUser -> email = $query[0]['email'];

      $default = "https://www.gravatar.com/avatar/?s=200";
      $size = 200;

       $grav_url = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $thisUser -> email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;

       if (filter_var($grav_url, FILTER_VALIDATE_URL) === false) {
          $grav_url  = "http://localhost/cerba/img/cerba.jpg";
       }


       $thisUser -> photo = $grav_url;


      return $thisUser;

    }else{
      return false;
    }


  } catch (PDOException $e) {
    http_response_code(401);
    echo "error al conectar";
  }
};


?>
