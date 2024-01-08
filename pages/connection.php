<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
use PHPMailer\PHPMailer\PHPMailer;  require_once ('../PHPMailer/PHPMailer.php');   require_once "../PHPMailer/SMTP.php";   require_once "../PHPMailer/Exception.php";
$servername = "localhost"; $username = "root"; $getName=htmlspecialchars($_GET['getName']); $r_P=htmlspecialchars($_GET['root_P']);  $Data=array(); 

function  decrypt ($tData, $t_Name) {  if ($t_Name=='employee') foreach($tData as $k=>$v) { if ($k=='EmpFName' || $k=='EmpMName' || $k=='EmpLName' || $k=='EmpBD' || $k=='EmpPhone' || $k=='EmpEaddress' || $k=='EmpUserId' || $k=='EmpStreetAdd' || $k=='EmpPassword' )  { $tData[$k]= htmlspecialchars(decryption($v));  }  }
				else if ($t_Name=='resident') { foreach($tData as $k=>$v) {  if ($k=='1' || $k=='2' || $k=='3' || $k=='ResDB' || $k=='ResFName' || $k=='ResMName' || $k=='ResLName' || $k=='ResSSN') $tData[$k]= htmlspecialchars(decryption($v)); } }
				else if ($t_Name=='progressnote') { foreach($tData as $k=>$v) { if ($k=='ProDoc') $tData[$k]= htmlspecialchars(decryption($v)); } }
				return $tData;
}
function  decryption ($ciphertext) { 
			$key="STEJ!asla@merp#uloh%eoie^lth&";  $cipher = "AES-128-CTR";  
			$original_plaintext = openssl_decrypt(htmlspecialchars($ciphertext), $cipher, $key, $options=0, $iv='1212121212121212'); 
			if ($original_plaintext==FALSE) return $ciphertext; else return $original_plaintext;
}
function  encryption ($plaintext) {  $key="STEJ!asla@merp#uloh%eoie^lth&";  $cipher = "AES-128-CTR";  $ciphertext = openssl_encrypt($plaintext, $cipher, $key, $options=0, $iv='1212121212121212'); 
			return $ciphertext;
}
/*1*/if ($getName=='connection') {
		try {
			$conn = new mysqli($servername, $username, $r_P);
				if (!$conn->error)  { $res = mysqli_query($conn, "SHOW DATABASES");  while ($row = mysqli_fetch_assoc($res)) { $Data[]=array('dbName'=>$row['Database'], 'enadis'=>true, 'enadisOk'=>true, 'onoff'=>'off', 'save'=>'ok', 'tblSelected'=>$row['Database'], 'userSelected'=>$row['Database'], 'passSelected'=>$row['Database'], 'default'=>'', 'tName'=>'', 'userId'=>'', 'userpass'=>'', 'indexf'=>''); } }	else {  throw new Exception();  }
				} catch(Exception $e) { $Data[]= null; } mysqli_close($conn); 
				header('Content-type: application/json'); echo json_encode($Data);
			}
/*2*/else if ($getName=='configTRecord') {
		try { $conn = new mysqli($servername, $username, $r_P,"configuration"); $query="SELECT * FROM configtable";
	$result= mysqli_query ($conn, $query);	if (mysqli_num_rows($result)>0) { $Data=array(); while($row=mysqli_fetch_array($result)){ $Data[]= $row; } }
	 } catch(Exception $e) { $Data[]= 'What is up man!'; }  mysqli_close($conn); header('Content-type: application/json'); echo json_encode($Data);
			}
/*3updated*/ else if ($getName=='logginRecord') { $dbName=htmlspecialchars($_GET['dbName']);  $uPV= encryption(htmlspecialchars($_GET['uPV'])); $uIdV=encryption(htmlspecialchars($_GET['uIdV'])); $D1=array();
		try { $conn = new mysqli($servername, $username, $r_P,$dbName); 
		$query="SELECT Employee.EmpId, Licensed.licenseNo, Licensed.lictype, fosterhome.Name, fosterhome.Address, fosterhome.City, fosterhome.State, fosterhome.Zipcode, operator.CellPhone, fosterhome.HomePhone, fosterhome.Fax, operator.OpFName, operator.OpMName, operator.OpLName, operator.OpAddress , operator.OpCity , operator.OpState , operator.OpZipCode, operator.Email, operator.OpDb,  Employee.EmpFName, Employee.EmpMName, Employee.EmpLName, Employee.EmpBD, Employee.PrevName, Employee.EmpEaddress, Employee.EmpUserId, Employee.EmpPassword, Employee.Dis   FROM licensed INNER JOIN hasEmployee ON hasEmployee.licenseNo=licensed.licenseNo INNER JOIN fosterhome ON fosterhome.FostId=licensed.FostId INNER JOIN operator ON operator.OpId=licensed.OpId  JOIN Employee ON Employee.EmpId=hasEmployee.EmpId WHERE EmpUserId='".$uIdV."' and EmpPassword='".$uPV."'"; 
	$result= mysqli_query ($conn, $query);	if (mysqli_num_rows($result)>0) { while($row=mysqli_fetch_array($result)){ $Data[]= decrypt ($row, 'employee'); } }
	 } catch(Exception $e) { $D1[]= 'What is up man!'; }   mysqli_close($conn); header('Content-type: application/json'); echo json_encode($Data);
	}
/*4*/else if ($getName=='createConfigurationTable') {
		try { $dbName="configuration";
		$conn = new mysqli($servername, $username, $r_P); 
			if (!$conn->error) 
				{ 	$sqldb="CREATE DATABASE configuration"; $Data[]= 0;
					if ($conn->query($sqldb) === TRUE) 
					{ $sqltbl = "CREATE TABLE configTable (flddbName VARCHAR (30) NOT NULL PRIMARY KEY, fldTName VARCHAR (30),  fldUserId VARCHAR(30), fldPassword VARCHAR(30), fldStyle VARCHAR(30))";		
						try { mysqli_close($conn);	$conn = new mysqli($servername, $username, $r_P, $dbName); 
							if (!$conn->error)    if ($conn->query($sqltbl) === TRUE) $Data[]= 1;	
						} catch (Exception $e) { $Data[]=2; } 
					}		
				}
			} catch (Exception $e) { $Data[]= 3; }	
				header('Content-type: application/json'); echo json_encode($Data);
	}				
/*5*/else if ($getName=='getdbTable') { $dbName=htmlspecialchars($_GET['dbName']); $conn= mysqli_connect ($servername, $username, $r_P, "Information_Schema");
		$query="SELECT DISTINCT Table_Name FROM KEY_COLUMN_USAGE WHERE Table_Schema='$dbName'"; $result= mysqli_query ($conn, $query);		
			if (mysqli_num_rows($result)>0) { $Data=array(); while($row=mysqli_fetch_array($result)){ $Data[]=array( 'Table_Name'=>$row['Table_Name']); } }
		 mysqli_close($conn); header('Content-type: application/json'); echo json_encode($Data);
	}	
/*6*/else if ($getName=='getColNames') { $dbName=htmlspecialchars($_GET['dbName']); $conn= mysqli_connect ($servername, $username, $r_P, $dbName);						
		 	$t_Name = htmlspecialchars($_GET['tName']);  $sql = "SHOW FULL COLUMNS FROM ". $t_Name;  $result = mysqli_query($conn,$sql);
			$Data=array();  while($row = mysqli_fetch_array($result)){ $Data[]=array('tblLabel'=>$row['Field'] , 'tblName'=>$row['Field']);  }
			mysqli_close($conn); header('Content-type: application/json');  echo json_encode($Data);
	}	
/*7*/else if ($getName=='saveConfiguration') { $t_Name = htmlspecialchars($_GET['tName']); $u_Id = htmlspecialchars($_GET['uId']); $u_P = htmlspecialchars($_GET['uP']); $style = htmlspecialchars($_GET['style']); 
		$conn= mysqli_connect ($servername, $username, $r_P, "configuration"); $dbName=mysqli_real_escape_string($conn, $_GET['dbName']); 
		$sql = "INSERT INTO configTable (flddbName, fldTName, fldUserId, fldPassword, fldStyle) VALUES ('".$dbName. "', '" .$t_Name. "', '". $u_Id. "', '". $u_P.  "', '" .$style. "')";
		$sqlDelete = "DELETE FROM configTable";
		if ($conn->query($sqlDelete) === TRUE) if (mysqli_query($conn, $sql)) { echo "Login Information update successfully!"; } else { echo "Error: " . $sql . "<br>" . $conn->error; }
		mysqli_close($conn);  
	}	
/*8*/else if ($getName=='fetch_Info_Schema_Main_Tables') { $dbName=htmlspecialchars($_GET['dbName']); $conn= mysqli_connect ($servername, $username, $r_P, "Information_Schema");			
		$query="SELECT DISTINCT Referenced_Table_Name, Referenced_Column_Name FROM KEY_COLUMN_USAGE WHERE Referenced_Table_Name IS NOT NULL and Table_Schema='$dbName'";
			$result= mysqli_query ($conn, $query);	if (mysqli_num_rows($result)>0) {
					while($row=mysqli_fetch_array($result)){$Data[]=array('R_Table_Name'=>$row['Referenced_Table_Name'], 'R_Column_Name'=>$row['Referenced_Column_Name']);} }
		 mysqli_close($conn);  header('Content-type: application/json');  echo json_encode($Data);
	}
/*9*/else if ($getName=='fetch_RecFields') { $dbName=htmlspecialchars($_GET['dbName']); $t_Name = htmlspecialchars($_GET['t_Name']);	
				 $conn= mysqli_connect ($servername, $username, $r_P, $dbName);						
				$sql = "SHOW FULL COLUMNS FROM ". $t_Name; $result = mysqli_query($conn,$sql);
					while($row = mysqli_fetch_array($result)){ $Data[]=array('tblLabel'=>$row['Field'] , 'tblName'=>'', 'tblChecked'=>'', 'tblType'  => $row['Type'], 'tblInputType'=> 'text', 'tblStyle'=> '', 'ngEnaDis' =>$row['Field'], 'tblPat'=>'', 'tblNgIf' =>false, 'tblKey'=> $row['Key'], 'tblInvalid'=>false, 'tblNull'=>$row['Null'], 'exp'=>false, 'tblColSize'=>0, 'tblComments'=> $row['Comment'], 'tblId'=>$row['Field'], 'tblAutoInc'=>$row['Extra']); }
			mysqli_close($conn);  header('Content-type: application/json'); echo json_encode($Data);
	}			
/*10Filtered*/ else if ($getName=='fetch_Record') { $dbName=htmlspecialchars($_GET['dbName']); $t_Name = htmlspecialchars($_GET['t_Name']);	 $licenseNo=htmlspecialchars($_GET['licenseNo']);	$E=array(); $R=array(); $P=array(); $Rx=array(); 
		$conn= mysqli_connect ($servername, $username, $r_P, $dbName); 
		try { $q1="SELECT EmpId FROM hasEmployee WHERE LicenseNo='". $licenseNo."'"; $r1= mysqli_query ($conn, $q1); if (mysqli_num_rows($r1)>0) { while($row=mysqli_fetch_array($r1)){ $E[]= $row; } } } catch(Exception $e) { $Data[]= $e; } 	 
		try { $qR="SELECT Resident.ResId FROM FosterHome INNER JOIN Resident ON FosterHome.FostId=Resident.FostId INNER JOIN Licensed ON Licensed.FostId=FosterHome.FostId WHERE licenseNo='".$licenseNo."'"; $rR= mysqli_query ($conn, $qR); if (mysqli_num_rows($rR)>0) { while($row=mysqli_fetch_array($rR)){ $R[]= $row; } } } catch(Exception $e) { $Data[]= $e; } 	 
		if ($t_Name==='employee') {  foreach($E as $key=>$value) { $q2="SELECT * FROM Employee WHERE EmpId='".$E[$key]['EmpId']."'";  try { $r2= mysqli_query ($conn, $q2); if (mysqli_num_rows($r2)>0) { while($row=mysqli_fetch_array($r2)){  $Data[]= decrypt ($row, $t_Name);  } } } catch(Exception $e) { $Data[]= $e;  }  }	 }
		else if ($t_Name==='resident') {  foreach($R as $key=>$value) { $q2="SELECT * FROM Resident WHERE ResId='".$R[$key]['ResId']."'";  try { $r2= mysqli_query ($conn, $q2); if (mysqli_num_rows($r2)>0) { while($row=mysqli_fetch_array($r2)){ $Data[]= decrypt ($row, $t_Name); } } } catch(Exception $e) { $Data[]= $e;   }  }	 }
		else if ($t_Name==='drappointment') {  foreach($R as $key=>$value) { $q2="SELECT * FROM drappointment WHERE ResId='".$R[$key]['ResId']."'";  try { $r2= mysqli_query ($conn, $q2); if (mysqli_num_rows($r2)>0) { while($row=mysqli_fetch_array($r2)){ $Data[]= $row; } } } catch(Exception $e) { $Data[]= $e; }  }	 }
		else if ($t_Name==='prescription') {  foreach($R as $key=>$value) { $q2="SELECT prescription.PreId FROM drappointment INNER JOIN  prescription ON prescription.AppId= drappointment.AppId WHERE drappointment.ResId='".$R[$key]['ResId']."'";  try { $r2= mysqli_query ($conn, $q2); if (mysqli_num_rows($r2)>0) { while($row=mysqli_fetch_array($r2)){ $P[]= $row; } } } catch(Exception $e) { $Data[]= $e; }  }	
			foreach($P as $key=>$value) { $q2="SELECT * FROM prescription WHERE PreId='".$P[$key]['PreId']."'";  try { $r2= mysqli_query ($conn, $q2); if (mysqli_num_rows($r2)>0) { while($row=mysqli_fetch_array($r2)){ $Data[]= $row; } } } catch(Exception $e) { $Data[]= $e; }  }	
		 }
		else if ($t_Name==='rx') {  foreach($R as $key=>$value) { $q2="SELECT Rx.RxNo FROM  prescription INNER JOIN drappointment ON prescription.AppId= drappointment.AppId INNER JOIN Rx ON Rx.PreId=prescription.PreId WHERE drappointment.ResId='".$R[$key]['ResId']."'";  try { $r2= mysqli_query ($conn, $q2); if (mysqli_num_rows($r2)>0) { while($row=mysqli_fetch_array($r2)){ $Rx[]= $row; } } } catch(Exception $e) { $Data[]= $e; }  }	
			foreach($Rx as $key=>$value) { $q2="SELECT * FROM Rx WHERE RxNo='".$Rx[$key]['RxNo']."'";  try { $r2= mysqli_query ($conn, $q2); if (mysqli_num_rows($r2)>0) { while($row=mysqli_fetch_array($r2)){ $Data[]= $row; } } } catch(Exception $e) { $Data[]= $e; }  }	
		 }		
		else if ($t_Name==='licensed') {  $q2="SELECT * FROM ".$t_Name. " WHERE LicenseNo='".$licenseNo."'";  try { $r2= mysqli_query ($conn, $q2); if (mysqli_num_rows($r2)>0) { while($row=mysqli_fetch_array($r2)){ $Data[]= $row; } } } catch(Exception $e) { $Data[]= $e; }  }	 
		else if ($t_Name==='delappointment') {  foreach($R as $key=>$value) { $q2="SELECT DISTINCT delappointment.DelApptNo FROM delappointment INNER JOIN  delegation ON delegation.DelApptNo= delappointment.DelApptNo WHERE delegation.ResId='".$R[$key]['ResId']."'";  try { $r2= mysqli_query ($conn, $q2); if (mysqli_num_rows($r2)>0) { while($row=mysqli_fetch_array($r2)){ $P[]= $row; } } } catch(Exception $e) { $Data[]= $e; }  }	
			foreach($P as $key=>$value) { $q2="SELECT * FROM delappointment WHERE DelApptNo='".$P[$key]['DelApptNo']."'";  try { $r2= mysqli_query ($conn, $q2); if (mysqli_num_rows($r2)>0) { while($row=mysqli_fetch_array($r2)){ $Data[]= $row; } } } catch(Exception $e) { $Data[]= $e; }  }	
		 }	
		else if ($t_Name==='evacuationdrill') {  $q2="SELECT * FROM ".$t_Name. " WHERE LicenseNo='".$licenseNo."'";  try { $r2= mysqli_query ($conn, $q2); if (mysqli_num_rows($r2)>0) { while($row=mysqli_fetch_array($r2)){ $Data[]= $row; } } } catch(Exception $e) { $Data[]= $e; }  }	 
		else { $q2="SELECT * FROM ".$t_Name;  try { $r2= mysqli_query ($conn, $q2); if (mysqli_num_rows($r2)>0) { while($row=mysqli_fetch_array($r2)){ $Data[]= $row; } } } catch(Exception $e) { $Data[]= $e; }  }		 
		mysqli_close($conn); header('Content-type: application/json'); echo json_encode($Data);
 }
 /*11*/else if ($getName=='fetch_Ass_Table_Info') { $dbName=htmlspecialchars($_GET['dbName']); $t_Name = htmlspecialchars($_GET['t_Name']); $pkValue= htmlspecialchars($_GET['pkV']); $pkLabel= htmlspecialchars($_GET['pkL']); $EmpId= htmlspecialchars($_GET['EmpId']); $prevName= htmlspecialchars($_GET['prevName']);
		$conn= mysqli_connect ($servername, $username, $r_P, $dbName); 
		if ($t_Name=='progressnote' && $prevName=='Admin') $query="SELECT *  FROM ".$t_Name. " WHERE " . $pkLabel. "='". $pkValue. "'"; 
		else if ($t_Name=='progressnote') $query="SELECT *  FROM ".$t_Name. " WHERE EmpId='".$EmpId. "' AND " . $pkLabel. "='". $pkValue. "'";  else $query="SELECT *  FROM ".$t_Name. " WHERE " . $pkLabel. "='". $pkValue. "'"; 
		$result= mysqli_query ($conn, $query); if (mysqli_num_rows($result)>0) { while($row=mysqli_fetch_array($result)){ $Data[]= decrypt ($row, $t_Name); } }
			 mysqli_close($conn);  header('Content-type: application/json');  echo json_encode($Data); 
 	}
 /*12*/else if ($getName=='fetch_Info_Schema') { $dbName=htmlspecialchars($_GET['dbName']); $t_Name = htmlspecialchars($_GET['t_Name']);	
 		$conn= mysqli_connect ($servername, $username, $r_P, "Information_Schema");
		$query="SELECT Constraint_Name, Table_Name, Column_Name  FROM KEY_COLUMN_USAGE WHERE Table_Schema='". $dbName. "' AND Referenced_Table_Name='$t_Name'";
		$result= mysqli_query ($conn, $query); if (mysqli_num_rows($result)>0) { while($row=mysqli_fetch_array($result)){ $Data[]=array('Table_Name'=>$row['Table_Name'],'Table_Name_Checkbox'=>$row['Table_Name'],'Table_Column_Name'=>$row['Column_Name']); } }
		mysqli_close($conn); header('Content-type: application/json'); echo json_encode($Data);
 }
  /*13*/else if ($getName=='fetch_Ass_Column_Names') { $dbName=htmlspecialchars($_GET['dbName']); $p_tN = htmlspecialchars($_GET['ptN']); $ass_tN = htmlspecialchars($_GET['asstN']);
		$conn= mysqli_connect ($servername, $username, $r_P, "Information_Schema");				
		$query="SELECT Referenced_Table_Name, Referenced_Column_Name FROM KEY_COLUMN_USAGE WHERE  Table_Schema=". $dbName. " AND Table_Name='$ass_tN' AND Referenced_Table_Name<>'$p_tN' AND Referenced_Table_Name IS NOT NULL";
			$result= mysqli_query ($conn, $query);	if (mysqli_num_rows($result)>0) {
			while($row=mysqli_fetch_array($result)){ $Data[]=array('R_Table_Name'=>$row['Referenced_Table_Name'], 'R_Column_Name'=>$row['Referenced_Column_Name']); } }
			mysqli_close($conn); header('Content-type: application/json'); echo json_encode($Data);		
  }	
  /*14*/ else if ($getName=='fetch_Info_Schema_ref_Table') { $dbName= htmlspecialchars($_GET['dbName']); $t_Name=htmlspecialchars($_GET['t_Name']); $cN= htmlspecialchars($_GET['cN']);
	$conn= mysqli_connect ($servername, $username, $r_P, "Information_Schema");
		$query="SELECT Referenced_Table_Name FROM KEY_COLUMN_USAGE WHERE Table_Schema='$dbName' and Table_Name='$t_Name' and Referenced_Column_Name='$cN'"; //Referenced_Table_Name IS NOT NULL and NOT Referenced_Table_Name ='$pt_Name'";
		$result= mysqli_query ($conn, $query); if (mysqli_num_rows($result)>0) { while($row=mysqli_fetch_array($result)){ $Data[]=array('R_Table_Name'=>$row['Referenced_Table_Name']); } }
		 mysqli_close($conn); header('Content-type: application/json'); echo json_encode($Data);
	}			
/*15 Replaced by 10*/	else if ($getName=='fetch_ref_ColumnList') { $dbName= htmlspecialchars($_GET['dbName']); $t_Name= htmlspecialchars($_GET['t_Name']); $cN= htmlspecialchars($_GET['cN']);
		try { $conn= mysqli_connect ($servername, $username, $r_P, $dbName); $query="SELECT * FROM ".$t_Name; 
			$result= mysqli_query($conn, $query);	if (mysqli_num_rows($result)>0) { while($row=mysqli_fetch_array($result)){ $Data[]=$row;} }
			}  catch(Exception $e) { $Data[]= $e; }  
			mysqli_close($conn); header('Content-type: application/json'); echo json_encode($Data);
	}
/*16*/	else if ($getName=='pK') { $dbName= htmlspecialchars($_GET['dbName']); $t_Name= htmlspecialchars($_GET['t_Name']); 
			try { $conn= mysqli_connect ($servername, $username, $r_P, "Information_Schema"); $query="SELECT COLUMN_NAME FROM KEY_COLUMN_USAGE  WHERE CONSTRAINT_SCHEMA='".$dbName."' and TABLE_NAME='". $t_Name. "' and CONSTRAINT_NAME='PRIMARY'";
			$result= mysqli_query($conn, $query);	if (mysqli_num_rows($result)>0) { while($row=mysqli_fetch_array($result)){ $Data[]=array('pK'=>$row['COLUMN_NAME']);} }
			}  catch(Exception $e) { $Data[]= $e; }   mysqli_close($conn); header('Content-type: application/json'); echo json_encode($Data);
	}
/*17*/	else if ($getName=='aggSum') { $diff=0; $dbName= htmlspecialchars($_GET['dbName']); $t_Name= htmlspecialchars($_GET['t_Name']);  $pK= htmlspecialchars($_GET['pK']); $pKV= htmlspecialchars($_GET['pKV']); 
		$countF= (int) htmlspecialchars($_GET['countF']);  $countD= (int) htmlspecialchars($_GET['countD']); $datepos=$countF+1; $date= htmlspecialchars($_GET[$datepos]);  
			if ($countD>=1) { $count=0;
				for ($i=1;$i<=$countF; $i++) {  $temp= htmlspecialchars($_GET[$i]); $tempT= htmlspecialchars($_GET[$temp]);
				$conn= mysqli_connect ($servername, $username, $r_P, $dbName); $query="SELECT SUM( ".$temp." ) as total FROM ". $t_Name. " WHERE $pK='". $pKV."'";  //GROUP BY EXTRACT(YEAR FROM $date)";
				$result = $conn->query($query); while($record = $result->fetch_array()){ $Data[]= array($count=> $temp, $temp=>$tempT, $tempT=>$record['total']);  } $count++;																			
				mysqli_close($conn); 	
				}			
				$diff=  round( floatval ($Data[0][$Data[0][$Data[0][0]]])- floatval($Data[1][$Data[1][$Data[1][1]]]), 2);  $Data[]= array($count=> 'Bal', 'Bal'=>'Balance', 'Balance'=>floatval($diff)); 	
			}
		header('Content-type: application/json');  echo json_encode($Data);
	}
/*18*/	else if ($getName=='finRec') { $movedate= date('Y-m-d', strtotime('2021/08/14')); $dbName= htmlspecialchars($_GET['dbName']); $t_Name= htmlspecialchars($_GET['t_Name']);  $pK= htmlspecialchars($_GET['pK']); $pKV= htmlspecialchars($_GET['pKV']); 
		$countF= (int) htmlspecialchars($_GET['countF']); $countD= (int) htmlspecialchars($_GET['countD']); $datepos=$countF+1; $date= htmlspecialchars($_GET[$datepos]);  
				$conn= mysqli_connect ($servername, $username, $r_P, $dbName); $query="SELECT *  FROM ". $t_Name. " WHERE $pK='". $pKV."' AND ResFinDate>'".$movedate."' ORDER BY ResFinDate";  //GROUP BY EXTRACT(YEAR FROM $date)";
				$result= mysqli_query($conn, $query); if(mysqli_num_rows($result)>0) { while($row=mysqli_fetch_array($result)){ $Data[]=$row;} }
				mysqli_close($conn); 	
		header('Content-type: application/json');  echo json_encode($Data); 
	}   
/*19*/		else if ($getName=='progressNote') {  $movedate= date('Y-m-d', strtotime('2021/08/13')); $dbName= htmlspecialchars($_GET['dbName']); $t_Name= htmlspecialchars($_GET['t_Name']);  $pK= htmlspecialchars($_GET['pK']); $pKV= htmlspecialchars($_GET['pKV']); 		
				$conn= mysqli_connect ($servername, $username, $r_P, $dbName); $query="SELECT *  FROM ". $t_Name. " WHERE $pK='". $pKV."'  AND progDate>'".$movedate."' ORDER BY ProgDate";  //GROUP BY EXTRACT(YEAR FROM $date)";
				$result= mysqli_query($conn, $query); if(mysqli_num_rows($result)>0) { while($row=mysqli_fetch_array($result)){ $Data[]= decrypt ($row, $t_Name); } }
				mysqli_close($conn); 	
		header('Content-type: application/json');  echo json_encode($Data); 
	}   		
/*20Filtered*/ else if ($getName=='docSummary') { $data=array();  $dbName= htmlspecialchars($_GET['dbName']); $licenseNo=htmlspecialchars($_GET['licenseNo']); $prevName=htmlspecialchars($_GET['prevName']);	 $empId=htmlspecialchars($_GET['empId']);
		$data[]= array('expCertif' => expCertificates($servername, $username, $r_P, $dbName, $licenseNo, $prevName,  $empId)); 
		$data[]= array('getCurren' => getCurrentMed($servername, $username, $r_P, $dbName, $licenseNo, $prevName,  $empId));
		$data[]= array('drapptRem' => drapptRem($servername, $username, $r_P, $dbName, $licenseNo, $prevName,  $empId));
		$data[]= array('deligatio' => deligation($servername, $username, $r_P, $dbName, $licenseNo, $prevName,  $empId));	
		$data[]= array('fireDrill' => fireDrill($servername, $username, $r_P, $dbName, $licenseNo, $prevName,  $empId));
		header('Content-type: application/json');  echo json_encode($data);
	}
/*24*/	else if ($getName=='nextdeligation') { $dbName= htmlspecialchars($_GET['dbName']);  $data=array();	 
			try { $Curdate = new DateTime("now", new DateTimeZone('America/Phoenix')); $Curdate=$Curdate->format('Y-m-d');	  
				$conn= mysqli_connect ($servername, $username, $r_P, $dbName); 
				$query="SELECT  Resident.ResLName as RLName, Employee.EmpFName as EFName,  deligatedTask.delTasId as delTasId, MAX(DelAppointment.DelAptDate) as maxDate, DATEDIFF(MAX(DelAppointment.DelAptDate), '$Curdate') as DatesRemained  from Delegation INNER JOIN DelAppointment ON Delegation.DelApptNo=DelAppointment.DelApptNo INNER JOIN Resident ON Resident.ResId = delegation.ResId INNER JOIN Employee ON Employee.EmpId =delegation.EmpId INNER JOIN DeligatedTask ON DeligatedTask.DelTasId= Delegation.DelTasId WHERE DelAppointment.DelStatus=0 AND DelAppointment.DelAptDate=(SELECT  MAX(DelAptDate) from DelAppointment D WHERE DelAppointment.DelApptno=D.DelApptNo) GROUP BY Delegation.EmpId, Delegation.ResId, Delegation.DelTasId ORDER BY DatesRemained";  
				$result= mysqli_query($conn, $query); if(mysqli_num_rows($result)>0) { while($row=mysqli_fetch_array($result)){ $Data[]=$row;} }
				mysqli_close($conn); 	foreach($Data as $key=>$value) { if ($Data[$key]['DatesRemained']<=30 OR  $Data[$key]['maxDate']>$Curdate) $data[]=$value;  }   
				}  catch(Exception $e) { $Data[]='What is Going on here!'; }
		header('Content-type: application/json');  echo json_encode($data); 
	}		 
/*25*/	else if ($getName=='lastProgNote') { $dbName= htmlspecialchars($_GET['dbName']); $t_Name= htmlspecialchars($_GET['t_Name']); $pK= htmlspecialchars($_GET['pK']); $pKV= htmlspecialchars($_GET['pKV']); $data=array();	 
			try { $Curdate = new DateTime("now", new DateTimeZone('America/Phoenix')); $Curdate=$Curdate->format('Y-m-d');	  
				$conn= mysqli_connect ($servername, $username, $r_P, $dbName); 
				$query="SELECT  Resident.ResId as ResId,  Resident.ResFName as RFName, Resident.ResLName as RLName, MAX(ProgressNote.ProgDate) as maxDate, DATEDIFF('$Curdate', MAX(ProgressNote.ProgDate) ) as DatesDiff  from Resident INNER JOIN ProgressNote ON ProgressNote.ResId=Resident.ResId INNER JOIN Employee ON ProgressNote.EmpId = Employee.EmpId  WHERE Resident.ResId='$pKV' AND ProgressNote.ProgDate=(SELECT  MAX(ProgDate) from ProgressNote P WHERE  ProgressNote.ProgDate=P.ProgDate) GROUP BY Resident.ResId";  
				$result= mysqli_query($conn, $query); if(mysqli_num_rows($result)>0) { while($row=mysqli_fetch_array($result)){ $Data[]=$row;} }
				mysqli_close($conn); 	//foreach($Data as $key=>$value) { if ($Data[$key]['DatesRemained']<=30 OR  $Data[$key]['maxDate']>$Curdate) $data[]=$value;  }   
				}  catch(Exception $e) { $Data[]='What is Going on here!'; }
		header('Content-type: application/json');  echo json_encode($Data); 
	}
/*26*/ else if ($getName=='fireDrill') { $data=array();  $dbName= htmlspecialchars($_GET['dbName']); $licenseNo=htmlspecialchars($_GET['licenseNo']); $prevName=htmlspecialchars($_GET['prevName']);	 $empId=htmlspecialchars($_GET['empId']);
		$Data= fireDrill($servername, $username, $r_P, $dbName, $licenseNo, $prevName,  $empId);
		header('Content-type: application/json');  echo json_encode($Data);
	}	
/*27updated*/	else if ($getName=='firedrillReport') { $dbName= htmlspecialchars($_GET['dbName']); $t_Name= htmlspecialchars($_GET['t_Name']); $pK= htmlspecialchars($_GET['pK']); $pKV= htmlspecialchars($_GET['pKV']); $data=array(); $D1=array(); $D2=array(); $D3=array(); $D4=array(); $D5=array();	 
			try { $conn= mysqli_connect ($servername, $username, $r_P, $dbName);
			$q1="SELECT evacuationdrill.EvaDrilId, EvacDriDate, evacuationdrill.Description,  evacuationdrill.EvacDrilStTime, evacuationdrill.EvacRoute, evacuationdrill.EvaDrilId, evacuationdrill.FinalPtSafety, evacuationdrill.InitialPtSafety, evacuationdrill.LocSimFire, evacuationdrill.MinStaffSchAnyTtime, evacuationdrill.OcAlertBy, evacuationdrill.SleepingDrill, evacuationdrill.StaffPartInDrill, evacuationdrill.StPtStaffInitDril, evacuationdrill.TimetoFinalPtSafety, evacuationdrill.TimetoInitialPtSafety from evacuationdrill INNER JOIN licensed ON evacuationdrill.licenseNo=licensed.licenseNo WHERE EvacuationDrill.licenseNo='$pKV' GROUP BY evacuationdrill.EvaDrilId"; 
				$r1= mysqli_query($conn, $q1); if(mysqli_num_rows($r1)>0) 
				{ while($row1=mysqli_fetch_array($r1))
					{ 
					try { $q2="SELECT  Employee.EmpFName, Employee.EmpMName, Employee.EmpLName, staffevacdrill.EmpId, staffevacdrill.Notes, staffevacdrill.Role, staffevacdrill.StartingPt  from staffevacdrill INNER JOIN employee ON employee.EmpId=staffevacdrill.EmpId WHERE staffevacdrill.EvaDrilId='". $row1['EvaDrilId']."'";  $r2= mysqli_query($conn, $q2); if(mysqli_num_rows($r2)>0) { while($row2=mysqli_fetch_array($r2)){ $D2[]= decrypt ($row2, 'employee');  } } 	}  catch(Exception $e) { $D2[]='What is Going on here!'; }  
					try { $q3="SELECT  Resident.ResFName, Resident.ResMName, Resident.ResLName, residentevacuation.ResId, residentevacuation.AssNeeded, residentevacuation.StPoint, residentevacuation.Note  from residentevacuation INNER JOIN resident ON resident.ResId=residentevacuation.ResId WHERE residentevacuation.EvaDrilId='". $row1['EvaDrilId']."'";  $r3= mysqli_query($conn, $q3); if(mysqli_num_rows($r3)>0) { while($row3=mysqli_fetch_array($r3)){ $D3[]= decrypt ($row3, 'resident');  } } }  catch(Exception $e) { $D3[]='What is Going on here!'; }  
					$Data[]=array( $row1, $D2,  $D3 );  $D2=array(); $D3=array();
					} 
				}	
			}  catch(Exception $e) { $Data[]='What is Going on here!'; }   
		header('Content-type: application/json');  echo json_encode($Data);  
	}		
/*28*/	else if ($getName=='weeklyMenu') { $dbName= htmlspecialchars($_GET['dbName']); $t_Name= htmlspecialchars($_GET['t_Name']); $pK= htmlspecialchars($_GET['pK']); $pKV= htmlspecialchars($_GET['pKV']); $data=array(); $D1=array(); $D2=array(); $D3=array(); $D4=array(); $D5=array();
			try { $Curdate = new DateTime("now", new DateTimeZone('America/Phoenix')); $Curdate=$Curdate->format('Y-m-d'); $timestamp = strtotime('1st January 2004');
				$conn= mysqli_connect ($servername, $username, $r_P, $dbName); 
				$query="SELECT  Menu.MenuDate, FosterHome.Address, FosterHome.City, FosterHome.FostId, FosterHome.Name, FosterHome.State, FosterHome.Zipcode,  Menu.MealSno, Menu.MenuSNo, MAX(Menu.MenuDate) as maxDate , MIN(Menu.MenuDate) as minDate, DATEDIFF(MAX(Menu.MenuDate), '$Curdate') as DatesDiff, DATEDIFF(MAX(Menu.MenuDate), MIN(Menu.MenuDate)) as MaxMinDiff   from Menu INNER JOIN FosterHome ON Menu.FostId=FosterHome.FostId WHERE FosterHome.FostId='$pKV' AND Menu.MenuDate=(SELECT  MAX(MenuDate) from Menu M WHERE  Menu.MenuDate=M.MenuDate)";  
				$result= mysqli_query($conn, $query); if(mysqli_num_rows($result)>0) { while($row=mysqli_fetch_array($result)){ $D1[]=$row;} }
				}  catch(Exception $e) { $Data[]='What is Going on here!'; }  $data[]=$D1;
		try { $query="SELECT  DISTINCT Menu.MenuDate from Menu INNER JOIN FosterHome ON Menu.FostId=FosterHome.FostId WHERE (Menu.MenuDate > '2021-11-22') AND FosterHome.FostId='$pKV' ORDER BY Menu.MenuDate";  $result= mysqli_query($conn, $query); if(mysqli_num_rows($result)>0) { while($row=mysqli_fetch_array($result)){ $D2[]=$row;} } 	}  catch(Exception $e) { $Data[]='What is Going on here!'; }  	
				foreach($D2 as $key=>$value) {
		try { $query="SELECT  Menu.MenuDate,Menu.MealSno, Meal.MealCat, Meal.MealName, Meal.Recipe, Meal.RecipeLink from Menu INNER JOIN FosterHome ON Menu.FostId=FosterHome.FostId INNER JOIN Meal ON Menu.MealSno=Meal.MealSno WHERE FosterHome.FostId='$pKV' and Menu.MenuDate='".$value[0]."'";  $result= mysqli_query($conn, $query); if(mysqli_num_rows($result)>0) { while($row=mysqli_fetch_array($result)){ $D3[]=$row;} } 	}  catch(Exception $e) { $Data[]='What is Going on here!'; }  $data[]=$D3;	$D3=array();	
		}
		mysqli_close($conn); header('Content-type: application/json');  echo json_encode($data);   	  
	}				
/*29updated*/	else if ($getName=='staffCertificate') { $dbName= htmlspecialchars($_GET['dbName']);  $pKV= htmlspecialchars($_GET['pKV']);  $data=array(); $D1=array(); $D2=array();	$totalCr=0; 
			//try { 
			$Curdate = new DateTime("now", new DateTimeZone('America/Phoenix')); $Curdate=$Curdate->format('Y-m-d'); $conn= mysqli_connect ($servername, $username, $r_P, $dbName);  
				//$query="SELECT   MAX(certified.Certtaken) as maxDate, certified.CrsCode from Employee INNER JOIN certified ON certified.EmpId=Employee.EmpId WHERE certified.EmpId='". $pKV."' GROUP BY certified.CrsCode";  				
				//$result= mysqli_query($conn, $query); if(mysqli_num_rows($result)>0) { while($row=mysqli_fetch_array($result)){ $D1[]=$row; if ($row['CrsCode']=='DD-Caregiver' || $row['CrsCode']=='DD-Operator') { $maxD=$row['maxDate']; $maxDY= date_create($maxD); date_add($maxDY, date_interval_create_from_date_string("-365 days"));  $maxDY=$maxDY->format('Y-m-d');}  } }  }  catch(Exception $e) { $D1[]='What is Going on here!';
				//} 
			try {   
				$query="SELECT  certified.CrsCode, MAX(certified.Certtaken) as maxDate,  CURDATE() as curdate, DateDiff(CURDATE(), MAX(certified.Certtaken)) as datefifference, trainningcertificates.CrHrs, trainningcertificates.certification  from Employee INNER JOIN certified ON certified.EmpId=Employee.EmpId JOIN trainningcertificates ON trainningcertificates.CrsCode=certified.CrsCode 
WHERE certified.EmpId='". $pKV."' AND   DateDiff(CURDATE(), certified.Certtaken) < 365 GROUP BY certified.CrsCode ORDER BY maxDate";
				$result= mysqli_query($conn, $query); if(mysqli_num_rows($result)>0) { while($row=mysqli_fetch_array($result)){ $D2[]=$row; $totalCr=$totalCr+$row['CrHrs']; } } 	 }  catch(Exception $e) { $D2[]='What is Going on here!'; }
		$Data[]=$D2; $Data[]=$totalCr;
		 mysqli_close($conn); header('Content-type: application/json');  echo json_encode($Data); 
	}		
/*30*/	else if ($getName=='Main_Tables2') { $dbName=htmlspecialchars($_GET['dbName']); $prevName= htmlspecialchars($_GET['prevName']); 
	$conn= mysqli_connect ($servername, $username, $r_P, $dbName);			
		$query="SELECT dropdownmenu.mainTable,  dropdownmenu.tableTask, dropdownmenu.relTable  FROM dropdownmenu INNER JOIN previlege ON  dropdownmenu.dropDMId=previlege.dropDMId WHERE previlege.prevName='".$prevName . "' ORDER BY dropdownmenu.tableTask";  $result= mysqli_query ($conn, $query);	if (mysqli_num_rows($result)>0) { while($row=mysqli_fetch_array($result)){ $Data[]=array('M_Table'=>$row['mainTable'], 'R_Table'=>$row['relTable'], 'Task'=>$row['tableTask']); }  }
		 mysqli_close($conn);   header('Content-type: application/json');  echo json_encode($Data);	
	}  		  
/*31 replace by 10*/	else if ($getName=='getSummaryData') { $t_Name= htmlspecialchars($_GET['t_Name']); $dbName=htmlspecialchars($_GET['dbName']); 
	$conn= mysqli_connect ($servername, $username, $r_P, $dbName);	$query="SELECT * FROM ".$t_Name;
			try { $result= mysqli_query ($conn, $query);	if (mysqli_num_rows($result)>0) { while($row=mysqli_fetch_array($result)){  $Data[]= decrypt ($row, $t_Name); }  } } catch(Exception $e) { $Data[]= $e;   }
		 mysqli_close($conn);  header('Content-type: application/json');  echo json_encode($Data);	
	}  		  
/*32*/	else if ($getName=='PhyOrderRec') { $dbName=htmlspecialchars($_GET['dbName']);  $ResId=htmlspecialchars($_GET['ResId']);  $data=array(); $D1=array(); 
		try { $conn = new mysqli($servername, $username, $r_P,$dbName);  $q1="SELECT DISTINCT Medication.MedId, prescription.strength, prescription.Amt, prescription.Time, prescription.PRN, prescription.Cur, Medication.GenericName  FROM prescription INNER JOIN drappointment ON drappointment.AppId=prescription.AppId INNER JOIN medication ON medication.MedId=prescription.MedId WHERE  drappointment.ResId='". $ResId."' AND prescription.Cur=True GROUP BY prescription.preId ORDER BY prescription.PRN, Medication.GenericName "; 
		$r1= mysqli_query ($conn, $q1);	if (mysqli_num_rows($r1)>0) { while($row=mysqli_fetch_array($r1)){ $Data[]= $row; } } } catch(Exception $e) { $Data[]= 'What is up man!'; }  
		try { $q2="SELECT predetail.Location, predetail.StDate, predetail.location, predetail.MedExpDate, predetail.MedQnt, Medication.MedId, predetail.comment, predetail.StDate, prescription.strength, prescription.Amt, prescription.Time, prescription.PRN, prescription.Cur, predetail.RxNo  FROM rx INNER JOIN prescription ON prescription.preId=rx.preId  INNER JOIN predetail ON predetail.RxNo=rx.RxNo JOIN medication ON medication.MedId=Prescription.MedId JOIN drappointment ON drappointment.appId=prescription.appId  WHERE  drappointment.ResId='". $ResId."' AND prescription.Cur=True AND (predetail.Disp=FALSE AND predetail.Emp=FALSE) ORDER BY Medication.GenericName, predetail.RxNo, predetail.StDate,  predetail.location ";
		$r2= mysqli_query ($conn, $q2);	if (mysqli_num_rows($r2)>0) { while($row=mysqli_fetch_array($r2)){ $data[]= $row; } } } catch(Exception $e) { $data[]= 'What is up man!'; }  mysqli_close($conn);  $Data[]= $data;
	  header('Content-type: application/json'); echo json_encode($Data);
	}			
/*33*/	else if ($getName=='disposed') { $movedate= date('Y-m-d', strtotime('2021/08/14')); $dbName=htmlspecialchars($_GET['dbName']);  $ResId=htmlspecialchars($_GET['ResId']); $data=array(); $D1=array(); 
		try { $conn = new mysqli($servername, $username, $r_P,$dbName);  $query="SELECT Medication.SideEffect, Medication.BrandName, Medication.Uses, Medication.Control, Medication.MedId, predetail.DispDate, predetail.DispPro, predetail.reason, predetail.noDisposed, predetail.comment, predetail.StDate, prescription.strength, prescription.Amt, prescription.Time, prescription.PRN, prescription.Cur,  Medication.GenericName  FROM rx INNER JOIN prescription ON prescription.preId=rx.preId  INNER JOIN predetail ON predetail.RxNo=rx.RxNo JOIN medication ON medication.MedId=Prescription.MedId JOIN drappointment ON drappointment.appId=prescription.appId  WHERE  predetail.DispDate > '" .$movedate."' AND drappointment.ResId='". $ResId."' AND predetail.disp=True GROUP BY Medication.MedId ORDER BY Medication.GenericName";  $result= mysqli_query ($conn, $query);	if (mysqli_num_rows($result)>0) { while($row=mysqli_fetch_array($result)){ $Data[]= $row; } } } catch(Exception $e) { $Data[]= 'What is up man!'; }  
		try { $query="SELECT Prescription.MedId, medication.Control, medication.GenericName, predetail.disp, predetail.DispDate, predetail.noDisposed, predetail.Reason, predetail.RxNo, predetail.MedExpDate, predetail.StDate, predetail.DispPro, prescription.Strength, predetail.reason  FROM rx INNER JOIN  prescription ON prescription.preId=rx.preId  INNER JOIN predetail ON predetail.RxNo=rx.RxNo JOIN drappointment ON drappointment.appId=prescription.appId JOIN medication ON medication.MedId=Prescription.MedId WHERE  predetail.DispDate > '" .$movedate."' AND drappointment.ResId='". $ResId."' AND predetail.disp=True ORDER BY predetail.DispDate";  $result= mysqli_query ($conn, $query);	if (mysqli_num_rows($result)>0) { while($row=mysqli_fetch_array($result)){ $data[]= $row; } } } catch(Exception $e) { $data[]= 'What is up man!'; }  mysqli_close($conn); 
	$Data[]=$data; header('Content-type: application/json'); echo json_encode($Data);
	}			
/*34 not yet updated for Menu*/ else if ($getName=='MonthlyMenu') { $dbName=htmlspecialchars($_GET['dbName']); $D1=array(); $D2=array(); $D3=array(); $D4=array(); $D5=array(); $D6=array(); $D7=array();
		try { $Curdate = new DateTime("now", new DateTimeZone('America/Phoenix')); 
		 $conn= mysqli_connect ($servername, $username, $r_P, $dbName);  
		$query="SELECT Meal.MealSno from Meal INNER JOIN MealCategory ON Meal.MealCat=MealCategory.MealCat WHERE MealCategory.MealCat='Meal BreakFast'";  $result= mysqli_query($conn, $query); if(mysqli_num_rows($result)>0) { while($row=mysqli_fetch_array($result)){ $D1[]=$row['MealSno'];  } } 	} catch(Exception $e) { $Data[]='What is Going on here!'; } 
		try { $query="SELECT Meal.MealSno from Meal INNER JOIN MealCategory ON Meal.MealCat=MealCategory.MealCat WHERE MealCategory.MealCat='Meal Lunch'";  $result= mysqli_query($conn, $query); if(mysqli_num_rows($result)>0) { while($row=mysqli_fetch_array($result)){ $D2[]=$row['MealSno'];  } } 	} catch(Exception $e) { $D2[]='What is Going on here!'; }  		
		try { $query="SELECT Meal.MealSno from Meal INNER JOIN MealCategory ON Meal.MealCat=MealCategory.MealCat WHERE MealCategory.MealCat='Meal Dinner'";  $result= mysqli_query($conn, $query); if(mysqli_num_rows($result)>0) { while($row=mysqli_fetch_array($result)){ $D3[]=$row['MealSno'];  } } 	} catch(Exception $e) { $D3[]='What is Going on here!'; }  		
		try { $query="SELECT Meal.MealSno from Meal INNER JOIN MealCategory ON Meal.MealCat=MealCategory.MealCat WHERE MealCategory.MealCat='Veggies/Fruits'";  $result= mysqli_query($conn, $query); if(mysqli_num_rows($result)>0) { while($row=mysqli_fetch_array($result)){ $D4[]=$row['MealSno'];  } } 	} catch(Exception $e) { $D4[]='What is Going on here!'; }  		
		try { $query="SELECT Meal.MealSno from Meal INNER JOIN MealCategory ON Meal.MealCat=MealCategory.MealCat WHERE MealCategory.MealCat='Drinks/Beverages'";  $result= mysqli_query($conn, $query); if(mysqli_num_rows($result)>0) { while($row=mysqli_fetch_array($result)){ $D5[]=$row['MealSno'];  } } 	} catch(Exception $e) { $D5[]='What is Going on here!'; }  				
		$Data[]=$D1;  $Data[]=$D2;  $Data[]=$D3;  $Data[]=$D4;  $Data[]=$D5; 
		header('Content-type: application/json'); echo json_encode($Data);
	}
/*35 */ else if ($getName=='getrevexpcategory') {  $dbName=htmlspecialchars($_GET['dbName']); $D1=array();   $D3=array();
		$conn= mysqli_connect ($servername, $username, $r_P, $dbName);	$query="SELECT RevExpcatId as catId, RevExpCategory as category,  RevExpType as type FROM revexpcategory ORDER BY category";
		try { $result= mysqli_query ($conn, $query);	if (mysqli_num_rows($result)>0) { while($row=mysqli_fetch_array($result)){  $D1[]= $row; }  } } catch(Exception $e) { $data[]= $e;   }
		foreach($D1 as $key=>$value) {  $D2=array(); $q2="SELECT revexptype.Name FROM revexptype WHERE RevExpcatId='".$D1[$key]['catId']."'";  try { $r2= mysqli_query ($conn, $q2); if (mysqli_num_rows($r2)>0) {  while($row=mysqli_fetch_array($r2)){  $D2[]= $row;  } } } catch(Exception $e) { $Data[]= $e;  }  $D3[]= array('catId' => $D1[$key]['catId'],  'category' => $D1[$key]['category'], 'value'=>$D2);  }  $Data[]=$D3;//$D3[$D1[$key]['category']]=$D2; }	$Data[]=$D3; //$data[]= array('expCertif' => expCertificates
		mysqli_close($conn);  header('Content-type: application/json');  
		echo json_encode($Data);	
}	
/*new 4.29.21 */ else if ($getName=='revexp') { $dbName=htmlspecialchars($_GET['dbName']); $asspK= htmlspecialchars($_GET['asspK']); $asspKV= htmlspecialchars($_GET['asspKV']);  $D1=array();   $D3=array();
		$conn= mysqli_connect ($servername, $username, $r_P, $dbName); $query="SELECT Receipt from docExpense WHERE docExpId='$asspKV'";
		try { $result= mysqli_query ($conn, $query);	if (mysqli_num_rows($result)>0) { while($row=mysqli_fetch_array($result)){  $Data[]= $row; }  } } catch(Exception $e) { $Data[]= $e;   }
		mysqli_close($conn);  header('Content-type: image/jpeg');  
		echo json_encode($Data);	
	}
function expCertificates($servername, $username, $r_P, $dbName, $licenseNo, $prevName,  $empId) {   $data=array(); 	
			try { $Curdate = new DateTime("now", new DateTimeZone('America/Phoenix')); $Curdate=$Curdate->format('Y-m-d');	$conn= mysqli_connect ($servername, $username, $r_P, $dbName); 
				if ($prevName==='Admin' || $prevName==='Operator') 
$query="SELECT  Certified.CertNo as Cert_No, Employee.EmpId as Staff_Id, Certified.CrsCode as Course_Code, MAX(Certified.CertExDate) as CertExDate,  IF (DATEDIFF(MAX(Certified.CertExDate), 
  '$Curdate')<0, CONCAT ('(', DATEDIFF(MAX(Certified.CertExDate), '$Curdate')*-1, ') Pass'), DATEDIFF(MAX(Certified.CertExDate), '$Curdate')) as DatesRemained  
  FROM Employee INNER JOIN Certified ON Certified.EmpId=Employee.EmpId INNER JOIN hasEmployee ON employee.empId=hasEmployee.empId 
  WHERE  hasEmployee.licenseNo='$licenseNo' AND Certified.CertExDate=(SELECT  MAX(CertExDate) from Certified C WHERE Certified.CertNo=C.CertNo AND  Employee.dis=0)
   GROUP BY Certified.EmpId, Certified.CrsCode  ORDER BY MAX(Certified.CertExDate)"; 
   
   else $query="SELECT  Employee.EmpId as Staff_Id, Certified.CrsCode as Course_Code,  MAX(Certified.CertExDate) as CertExDate, IF (DATEDIFF(MAX(Certified.CertExDate), '$Curdate')<0, 
   CONCAT ('(', DATEDIFF(MAX(Certified.CertExDate), '$Curdate')*-1, ') Pass'),  DATEDIFF(MAX(Certified.CertExDate), '$Curdate')) as DatesRemained FROM Employee
    INNER JOIN Certified ON Certified.EmpId=Employee.EmpId INNER JOIN hasEmployee ON employee.empId=hasEmployee.empId WHERE  Employee.empId= '$empId' 
	AND hasEmployee.licenseNo='$licenseNo' AND Certified.CertExDate=(SELECT  MAX(CertExDate) from Certified C WHERE Certified.CertNo=C.CertNo AND  Employee.dis=0) 
	GROUP BY Certified.EmpId, Certified.CrsCode  ORDER BY MAX(Certified.CertExDate)";  
				$result= mysqli_query($conn, $query); if(mysqli_num_rows($result)>0) { while($row=mysqli_fetch_array($result)){ $Data[]=  $row;} }
				mysqli_close($conn); foreach($Data as $key=>$value) { if ($Data[$key]['DatesRemained']<=90) $data []= $value;  } 	
				}  catch(Exception $e) { $Data[]='What is Going on here!'; } 
		return ($data); 
	}		
function getCurrentMed($servername, $username, $r_P, $dbName, $licenseNo, $prevName,  $empId) {$tData=array(); $data=array(); $D1=array(); $D2=array(); 
			try { $Curdate = new DateTime("now", new DateTimeZone('America/Phoenix')); $Curdate=$Curdate->format('Y-m-d');	  
				$conn= mysqli_connect ($servername, $username, $r_P, $dbName);  
				$query="SELECT drappointment.resId, medication.GenericName as GenName, Prescription.dis as dis, prescription.strength as strength, preDetail.location, preDetail.disp as disposed, preDetail.emp as emp, preDetail.medexpDate as expDate, preDetail.RxNo, 
				IF (DATEDIFF(MedExpDate, '$Curdate')<0, CONCAT ('(', DATEDIFF(MedExpDate, '$Curdate')*-1, ') Pass'),  DATEDIFF(MedExpDate, '$Curdate')) as DatesRemained  from rx  INNER JOIN preDetail ON preDetail.RxNo = rx.RxNo INNER JOIN Prescription ON Prescription.PreId = rx.PreId JOIN medication ON medication.MedId=Prescription.MedId JOIN drappointment ON drappointment.appId=prescription.appId  JOIN resident ON drappointment.resId=resident.resId JOIN licensed ON resident.fostId=licensed.fostId WHERE  licensed.licenseNo='".$licenseNo."' AND  (DATEDIFF(MedExpDate, '$Curdate') < 90 AND (preDetail.emp=0 AND preDetail.disp=0)) OR (Prescription.dis=1 AND (preDetail.emp=0 AND preDetail.disp=0)) ORDER BY MedExpDate";   //Prescription.dis=1)				
				$result= mysqli_query($conn, $query); if(mysqli_num_rows($result)>0) { while($row=mysqli_fetch_array($result)){ $Data[]=$row;} }
				}  catch(Exception $e) { $data[]='What is Going on here!'; }  mysqli_close($conn); 
		return ($Data);   
	}
function drapptRem ($servername, $username, $r_P, $dbName, $licenseNo, $prevName,  $empId) {	
			try { $Curdate = new DateTime("now", new DateTimeZone('America/Phoenix')); $Curdate=$Curdate->format('Y-m-d');	  
				$conn= mysqli_connect ($servername, $username, $r_P, $dbName); 
				$query="SELECT Resident.resId, Resident.ResFName as FName, Resident.ResLName as LName, drappointment.AppDate, drappointment.AppTime, 
				IF (DATEDIFF(AppDate, '$Curdate')<0, CONCAT ('(', DATEDIFF(AppDate, '$Curdate')*-1, ') Pass'),  DATEDIFF(AppDate, '$Curdate')) as DatesRemained
				from drappointment INNER JOIN Resident ON Resident.ResId = drappointment.ResId  INNER JOIN physician ON drappointment.phyId = Physician.phyId JOIN licensed ON licensed.FostId = resident.FostId 
				WHERE licensed.licenseNo ='$licenseNo' AND (DATEDIFF(Appdate, '$Curdate') <=30 ) AND drappointment.RideRes=0 AND drappointment.canceled=0 ORDER BY DatesRemained"; 
				$result= mysqli_query($conn, $query); if(mysqli_num_rows($result)>0) { while($row=mysqli_fetch_array($result)){ $Data[]=$row;} }
				mysqli_close($conn); 	
				}  catch(Exception $e) { $Data[]='What is Going on here!'; }
		return ($Data); 
}
function deligation($servername, $username, $r_P, $dbName, $licenseNo, $prevName,  $empId) {	$data=array(); 	
			try { $Curdate = new DateTime("now", new DateTimeZone('America/Phoenix')); $Curdate=$Curdate->format('Y-m-d');	   
				$conn= mysqli_connect ($servername, $username, $r_P, $dbName);  //CASE WHEN DATEDIFF(max(D.NextDelAptDate), '$Curdate') < 0 THEN (DATEDIFF(max(D.NextDelAptDate), '$Curdate')* -1) ELSE '+' END  AS DatesRemained

				if ($prevName==='Admin' || $prevName==='Operator') 
					$query="Select D.EmpId as Staff_Id, D.ResId as Resident_Id, D.DelTasId as Del_Id, max(D.DelAptDate) as lastDeligated,  max(D.NextDelAptDate) as maxDate, DATEDIFF(max(D.NextDelAptDate), '$Curdate')  AS RemD,
					IF (DATEDIFF(max(D.NextDelAptDate), '$Curdate')<0, CONCAT ('(', DATEDIFF(max(D.NextDelAptDate), '$Curdate')*-1, ') Pass'),  DATEDIFF(max(D.NextDelAptDate), '$Curdate')) as DatesRemained
					from 
					(SELECT  Delegation.EmpId, Delegation.ResId,  Delegation.DelSno, Delegation.DelApptNo,  Delegation.DelTasId, Delegation.TimeStamp, Delegation.NexDel, DelAppointment.DelAptDate, DATE_ADD(DelAppointment.DelAptDate, INTERVAL Delegation.NexDel DAY) as NextDelAptDate
					from  Delegation INNER JOIN  DelAppointment ON  Delegation.DelApptNo = DelAppointment.DelApptNo ORDER BY Delegation.EmpId, Delegation.DelTasId, DelAppointment.DelAptDate  DESC) as D 
					INNER JOIN Resident ON Resident.ResId = D.ResId  INNER JOIN Employee ON Employee.EmpId = D.EmpId INNER JOIN DeligatedTask ON DeligatedTask.DelTasId= D.DelTasId 
					JOIN hasEmployee ON (D.EmpId=hasEmployee.EmpId) WHERE Employee.dis=0 AND hasEmployee.licenseNo='$licenseNo' GROUP BY D.EmpId, D.DelTasId";  
					else $query="Select D.EmpId as Staff_Id, D.ResId as Resident_Id, D.DelTasId as Del_Id, max(D.DelAptDate) as lastDeligated, max(D.NextDelAptDate) as maxDate,  DATEDIFF(max(D.NextDelAptDate), '$Curdate') as DatesRemained from 
					(SELECT  Delegation.EmpId, Delegation.ResId,  Delegation.DelSno, Delegation.DelApptNo,  Delegation.DelTasId, Delegation.TimeStamp, Delegation.NexDel, DelAppointment.DelAptDate, DATE_ADD(DelAppointment.DelAptDate, INTERVAL Delegation.NexDel DAY) as NextDelAptDate
					from  Delegation INNER JOIN  DelAppointment ON  Delegation.DelApptNo = DelAppointment.DelApptNo ORDER BY Delegation.EmpId, Delegation.DelTasId, DelAppointment.DelAptDate  DESC) as D 
					INNER JOIN Resident ON Resident.ResId = D.ResId  INNER JOIN Employee ON Employee.EmpId = D.EmpId INNER JOIN DeligatedTask ON DeligatedTask.DelTasId= D.DelTasId 
					JOIN hasEmployee ON (D.EmpId=hasEmployee.EmpId) WHERE Employee.dis=0 AND hasEmployee.licenseNo='$licenseNo' AND Employee.EmpId= '$empId'  GROUP BY D.EmpId, D.DelTasId"; 
				$result= mysqli_query($conn, $query); if(mysqli_num_rows($result)>0) { while($row=mysqli_fetch_array($result)){ $Data[]=$row;} }
				mysqli_close($conn); 	foreach($Data as $key=>$value) { if ($Data[$key]['RemD']<=30) $data[]=$value;  }   
				}  catch(Exception $e) {  }
		return ($data); 
	}			
function fireDrill($servername, $username, $r_P, $dbName, $licenseNo, $prevName,  $empId) { //$typeSummary= htmlspecialchars($_GET['type']); 	 
			try { $Curdate = new DateTime("now", new DateTimeZone('America/Phoenix')); $Curdate=$Curdate->format('Y-m-d');	  
				$conn= mysqli_connect ($servername, $username, $r_P, $dbName); 
				if ($prevName==='Admin' || $prevName==='Operator')  $query="SELECT   EvacuationDrill.licenseNo, MAX(evacuationdrill.EvacDriDate) as maxDate, 90-DATEDIFF('$Curdate', MAX(evacuationdrill.EvacDriDate)) as DatesDiff  from licensed INNER JOIN evacuationdrill ON evacuationdrill.licenseNo=licensed.licenseNo WHERE  EvacuationDrill.licenseNo='$licenseNo'  AND EvacuationDrill.EvacDriDate=(SELECT  MAX(EvacDriDate) from EvacuationDrill E WHERE  EvacuationDrill.EvacDriDate=E.EvacDriDate)";  
				$result= mysqli_query($conn, $query); if(mysqli_num_rows($result)>0) { while($row=mysqli_fetch_array($result)){ $Data[]=$row;} }
				mysqli_close($conn); 	//if ($typeSummary==='summary') foreach($Data as $key=>$value) { if ($Data[$key]['licenseNo']===null) $Data='';  }   
			}  catch(Exception $e) { $Data[]='What is Going on here!'; }
		return ($Data); 
	}	
 ?>  