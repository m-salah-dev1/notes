<?php

// header("Access-Control-Allow-Origin: * ");
// header("Access-Control-Allow-Headers: Content-Type, Authorization");
// header("Access-Control=Allow-Methode: POST , OPTIONS , GET");
// header("Content-Type : application/json");






$dns = "mysql:host=localhost;dbname=noteapp";
$user = "root";
$pass = "";
$option = array( 
    PDo::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"
);


try {

$con = new PDO($dns ,$user , $pass ,$option);  


$con-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);





include_once"functions.php";

// checkAuthenticate();





}catch(PDOException $e){

    echo  $e->getMessage(); 

}