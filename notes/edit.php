<?php

include "../connect.php";


$userid    = getUserIdFromToken();
$noteid    = filterRequest("id");

$title     = filterRequest("title");
$content   = filterRequest("content");
$imagename = filterRequest("imagename");



if(isset($_FILES['file'])){

    deleteFile("../upload" , $imagename);

    $imagename = imageUpload("file");

}



$stmt = $con->prepare("
UPDATE notes SET 
notes_title = ?,
notes_content = ?,
notes_image = ?

WHERE notes_id = ?
AND notes_users = ?
");



$stmt->execute([
    $title,
    $content,
    $imagename,
    $noteid,
    $userid
]);



if($stmt->rowCount() > 0){

echo json_encode([
    "status"=>"success"
]);

}else{

echo json_encode([
    "status"=>"fail"
]);

}
