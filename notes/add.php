

<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);

include "../connect.php";

$title   = filterRequest("title");
$content = filterRequest("content");
$userid  = getUserIdFromToken();

$imagename = imageUpload("file");

if ($title == "" || $content == "" || $userid == "") {
    echo json_encode([
        "status" => "fail",
        "message" => "Missing data"
    ]);
    exit;
}

if ($imagename == "fail" || $imagename == null) {
    echo json_encode([
        "status" => "fail",
        "message" => "Image upload failed"
    ]);
    exit;
}

$stmt = $con->prepare("
    INSERT INTO notes (notes_title, notes_content, notes_users, notes_image)
    VALUES (?, ?, ?, ?)
");

$stmt->execute([$title, $content, $userid, $imagename]);

if ($stmt->rowCount() > 0) {
    echo json_encode([
        "status" => "success",
        "message" => "Inserted successfully",
        "data" => null
    ]);
} else {
    echo json_encode([
        "status" => "fail",
        "message" => "Database insert failed",
        "data" => null
    ]);
}
















