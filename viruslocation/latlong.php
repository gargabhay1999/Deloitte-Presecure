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
//$virus->date= date("Y-m-d");
if($_POST['date']==''){
	$virus->date= date("Y-m-d");
}
else{
	$virus->date= $_POST['date'];
}
$virus->add = $_POST['address'];
$virus->spec = $_POST['species'];
$virus->lat = $_POST['latitude'];
$virus->long = $_POST['longitude'];
$virus->add_acc = $_POST['add_acc'];
$virus->num_mosq = $_POST['num_mosq'];
$virus->vpresent = 1;

//echo $virus->date . $virus->add . $virus->spec . $virus->lat . $virus->long . $virus->add_acc . $virus->num_mosq . $virus->vpresent;



if( ( isset($virus->lat, $virus->long) ) || ( isset($virus->add) ) ) {
	$virus->insertion();
}

/*$message = "Your data has been recorded..";
echo "<script> alert(".$message."); <script>";*/


	header('Location: http://localhost/presecure_v4/'); 

?>
