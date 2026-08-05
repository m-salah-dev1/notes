<?php

include "../connect.php";

$username = filterRequest("username");
$email = filterRequest("email");
$firebase_uid = filterRequest("firebase_uid");

$stmt = $con->prepare(
    "SELECT id FROM users WHERE firebase_uid = ?"
);

$stmt->execute([
    $firebase_uid
]);


if ($stmt->rowCount() > 0) {

    echo json_encode([
        "status" => "failure",
        "message" => "User already exists"
    ]);

    exit;
}

$insert = $con->prepare("
INSERT INTO users
(username, email, firebase_uid)
VALUES (?, ?, ?)
");


$insert->execute([
    $username,
    $email,
    $firebase_uid
]);



if ($insert->rowCount() > 0) {

    echo json_encode([
        "status" => "success"
    ]);

} else {

    echo json_encode([
        "status" => "failure"
    ]);
}

?>
