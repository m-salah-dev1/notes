<?php

define("MB",10485576);

function filterRequest($requestname){

  return    htmlspecialchars(strip_tags($_POST[$requestname]));
} 



function imageUpload($imageRequest){
 
global $msgError;
$imagename = rand(1000 ,10000) . $_FILES[$imageRequest]['name'];
$imagetmp  = $_FILES[$imageRequest]['tmp_name'];
$imagesize = $_FILES[$imageRequest]['size'];
$allowed_exts = array( "jpg", "png" ,"gif" ,"mp3" ,"pdf");
$strToArray =explode(".", $imagename);
$ext = end($strToArray);
$ext = strtolower($ext);



if(!empty($imagename) && !in_array($ext , $allowed_exts)){

$msgError []='EXT';
}


if ($imagesize > 2 * MB){
  $msgError []= 'size';
}

if(empty($msgError)){
  move_uploaded_file($imagetmp , "../upload/" . $imagename);
  return $imagename;
} else{
 return 'fail';

}

}



function deleteFile( $dir  , $imagename){

  if(file_exists($dir ."/". $imagename )){
    unlink($dir ."/". $imagename);

  }



  
}

function getUserIdFromToken(){

    global $con;

    $header = $_SERVER['HTTP_AUTHORIZATION'] ?? '';

    if($header == ''){
        return 0;
    }

    $token = str_replace("Bearer ", "", $header);


    $stmt = $con->prepare(
        "SELECT id FROM users WHERE token = ?"
    );

    $stmt->execute([$token]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);


    if($user){
        return $user['id'];
    }

    return 0;
}



 