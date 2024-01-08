<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');

$conn= mysqli_connect("localhost", "root", "123456789", "LoveAndRespectDb");
$info =json_decode(file_get_contents("php://input"));
 $pkfield=''; $pkvalue='';  $c=true;
		 foreach($info as $key=>$value) { 
		 	if ($c==true) { $pkfield=$key;  $pkvalue=mysqli_real_escape_string($conn, $value[0]);  $tName= mysqli_real_escape_string($conn, $value[2]);  $c=false; } }
		$query = "DELETE FROM ". $tName. " WHERE " .$pkfield. "='".$pkvalue."'";
	if (mysqli_query($conn, $query)) { echo "Deleted Successfully...";  }  else {  echo "Failed Delete". mysqli_error($conn); }
?>

