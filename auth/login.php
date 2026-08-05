<?php

include "../connect.php";

$firebase_uid = filterRequest("firebase_uid");



$stmt = $con->prepare(
    "SELECT id, username, email
    FROM users
    WHERE firebase_uid = ?"
);


$stmt->execute([
    $firebase_uid
]);


$data = $stmt->fetch(PDO::FETCH_ASSOC);



if ($data) {


    $token = bin2hex(random_bytes(32));


    $update = $con->prepare(
        "UPDATE users SET token = ? WHERE id = ?"
    );


    $update->execute([
        $token,
        $data["id"]
    ]);



    echo json_encode([
        "status" => "success",
        "token" => $token,
        "data" => $data
    ]);



} else {


    echo json_encode([
        "status" => "failure",
        "message" => "User not found"
    ]);

}

?>
