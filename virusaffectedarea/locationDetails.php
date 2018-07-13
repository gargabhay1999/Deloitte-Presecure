<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../objects/viruslocation.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

$virus = new Virus($db);
$locationArray = $virus->getlocationDetails();
echo $locationArray;
?> 