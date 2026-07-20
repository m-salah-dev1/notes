<?php

include "../connect.php";


$noteid = filterRequest("id");
$userid = filterRequest("userid");
$imagename = filterRequest("imagename");



$stmt = $con->prepare("
DELETE FROM notes 
WHERE notes_id = ?
AND notes_users = ?
");


$stmt->execute([
    $noteid,
    $userid
]);



if($stmt->rowCount() > 0){

    deleteFile("../upload" , $imagename);

    echo json_encode([
        "status"=>"success"
    ]);

}else{

    echo json_encode([
        "status"=>"fail"
    ]);

}