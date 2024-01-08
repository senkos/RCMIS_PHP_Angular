<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
	$getName = htmlspecialchars($_POST['getName']); $dbName= htmlspecialchars($_POST['dbName']); $rootP = htmlspecialchars($_POST['root_P']); $t_Name = htmlspecialchars($_POST['t_Name']);  
	$licenseNo = htmlspecialchars($_POST['licenseNo']);  $pkV = htmlspecialchars($_POST['pkV']); 
	$docName=htmlspecialchars($_FILES['file']['name']);  $docData=htmlspecialchars($_FILES['file']['tmp_name']); $docType=htmlspecialchars($_FILES['file']['type']);
	$docSize= htmlspecialchars($_FILES['file']['size']);

	$conn = new mysqli("localhost", "root", $rootP, $dbName); 
	$query="INSERT INTO docexpense (RevExpId, docname,Receipt) VALUES ('$pkV' , '$docName', '$docData' )"; 
	try {  if (mysqli_query($conn, $query)) { echo "Data inserted Successfully..."; } else { echo "Failed Insert". mysqli_error($conn);  }	} catch(Exception $e) { echo $e; }  mysqli_close($conn);	
	//echo "<img src='data:image/jpeg; base64," . base64_encode($_FILES['myfile']['name']) ."' height='250px' width='250px'/>";
	//echo $getName ."\n". $dbName  ."\n".  $rootP ."\n".  $t_Name ."\n".   $licenseNo ."\n".  $pkV  ."\n".  $docName ; //$docName."\n". $docother// htmlspecialchars($docother['getName']);
?>