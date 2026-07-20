<?php
require __DIR__ . '/vendor/autoload.php';
use Firebase\JWT\JWT;

$key = "MY_SECRET_KEY";  // خليها سرية
$payload = ["user_id" => 1, "name" => "Test User"];

$jwt = JWT::encode($payload, $key, 'HS256');
echo "Generated Token: - test_jwt.php:9" . $jwt;
?>
