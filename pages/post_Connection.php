<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
function  encrypt ($k, $v, $t_Name) { 
		if ($t_Name=='employee') { if ($k=='EmpFName' || $k=='EmpMName' || $k=='EmpLName' || $k=='EmpBD' || $k=='EmpPhone' || $k=='EmpEaddress' || $k=='EmpUserId' || $k=='EmpStreetAdd' || $k=='EmpPassword' ) $v= encryption($v); }
		else if ($t_Name=='resident') { if ($k=='ResDB' || $k=='ResFName' || $k=='ResMName' || $k=='ResLName' || $k=='ResSSN') $v= encryption($v); }
		else if ($t_Name=='progressnote') { if ($k=='ProDoc') $v= encryption($v); }
		return $v;
		}		
function  encryption ($plaintext) {  $key="STEJ!asla@merp#uloh%eoie^lth&";  $cipher = "AES-128-CTR";  $ciphertext = openssl_encrypt($plaintext, $cipher, $key, $options=0, $iv='1212121212121212'); 
			return $ciphertext;
}
	$data=array(); $data2= array(); $data3= array();  $Data=array(); $info =json_decode(file_get_contents("php://input"));  

	foreach($info as $key=>$value) { $data[]= $value;  }  $t_Name=  $data[0]->{'t_Name'}; //$data[1]= encrypt ($data[1], $t_Name);    
	$field_string = ''; $value_string = ''; 
	$servername = "localhost"; $username = "root"; $postName=$data[0]->{'postName'}; $r_P=$data[0]->{'root_P'};   
		if ($postName=='saveEdit') { 
			$dbName= $data[0]->{'dbName'};  $t_Name=  $data[0]->{'t_Name'};  $pK=  $data[0]->{'pK'};  $pKV=  $data[0]->{'pKV'};  	
			$conn= mysqli_connect($servername , $username, $r_P, $dbName);  //else if (substr($v[1], 0, 10)=='tinyint(1)') $query = $query. "'". ($v[0]?1:0) . "', "; ($v[0]?1:0)
			$query = "UPDATE ".$t_Name. " SET "; 
				foreach ($data[1] as $k=>$v) {  $val= encrypt ($k, $v[0], $t_Name);  if (substr($v[1], 0, 3)=='var' || substr($v[1], 0, 4)=='text') $query = $query. " ". $k."='".  mysqli_real_escape_string($conn, $val). "', "; else if (substr($v[1], 0, 10)=='tinyint(1)') { if ($val==true) $tv=1; else $tv=0;  $query = $query. " ". $k."='".  $tv . "', "; }  else if (substr($v[1], 0, 3)=='int'|| substr($v[1], 0, 7)=='smallint' || substr($v[1], 0, 8)=='MEDIUMINT' || substr($v[1], 0, 6)=='bigint'  ) $query = $query. " ". $k."='". (int) $val . "', "; else if (substr($v[1], 0, 7)=='decimal'|| substr($v[1], 0, 5)=='float' || substr($v[1], 0, 6)=='double' || substr($v[1], 0, 4)=='real')  $query = $query. " ". $k."='".  floatval($val)  . "', "; else if (substr($v[1], 0, 8)=='datetime') {  } else if (substr($v[1], 0, 4)=='date') { $dateCon= date('Y-m-d', strtotime($val)); $query = $query. $k."='". $dateCon . "', "; } else if (substr($v[1], 0, 4)=='time') { $dateCon= time('HH:MM:SS', strtotime($val)); $query = $query. "'". $dateCon. "', "; } }										
					$query= substr($query, 0,-2); $query= $query . " WHERE ". $pK. "='".$pKV."'";
					if (mysqli_query($conn, $query)) { echo "Data updated Successfully..."; } else { echo "Failed update" . mysqli_error($conn); } mysqli_close($conn); 
		}
		else if ($postName=='insert') {  $dbName= $data[0]->{'dbName'};  $t_Name=  $data[0]->{'t_Name'};  //$pK=  $data[0]->{'pK'};  $pKV=  $data[0]->{'pKV'}; 		
			$conn= mysqli_connect($servername , $username, $r_P, $dbName); $field_string = ''; $value_string = ''; 
			foreach($data[1] as $k=>$v) {   if (!($v[0]==null)) { $field_string = $field_string. $k.","; }	 }  $query = "INSERT INTO ".$t_Name;   
			$field_string= substr($field_string, 0,-1); $query = $query. "(". $field_string. ") VALUES (";    //query  
			foreach($data[1] as $k=>$v) { $val= encrypt ($k, $v[0], $t_Name); if (!($v[0]==null)) { if (substr($v[1], 0, 3)=='var' || substr($v[1], 0, 4)=='text') { $query = $query. "'".  mysqli_real_escape_string($conn, $val). "', "; }  else if (substr($v[1], 0, 10)=='tinyint(1)') {if ($val==true) $tv=1; else $tv=0;  $query = $query. " ". $k."='".  $tv . "', ";  }  else if (substr($v[1], 0, 3)=='int'|| substr($v[1], 0, 7)=='smallint' || substr($v[1], 0, 8)=='MEDIUMINT' || substr($v[1], 0, 6)=='bigint') $query = $query. "'". (int) $val . "', "; else if (substr($v[1], 0, 7)=='decimal'|| substr($v[1], 0, 5)=='float' || substr($v[1], 0, 6)=='double' || substr($v[1], 0, 4)=='real') $query = $query. "'". floatval($val) . "', ";  else if (substr($v[1], 0, 8)=='datetime') { $dateCon= date('Y-m-d H:i:s', strtotime($val)); $query = $query. "'". $dateCon. "', "; } else if (substr($v[1], 0, 4)=='date') { $dateCon= date('Y-m-d', strtotime($val)); $query = $query. "'". $dateCon. "', "; } else if (substr($v[1], 0, 4)=='time') { $dateCon= time('HH:MM:SS', strtotime($val)); $query = $query. "'". $dateCon. "', "; }	 }	}
		$field_string = substr($field_string, 0,-1); $query= substr($query, 0,-2); $query= $query . ")";
		if (mysqli_query($conn, $query)) { echo "Data inserted Successfully..."; } else { echo "Failed Insert". mysqli_error($conn);  }	 mysqli_close($conn);	 								
	  }
	else if ($postName=='delete') { $dbName= $data[0]->{'dbName'};  $t_Name=  $data[0]->{'t_Name'}; $pK=  $data[0]->{'pK'};  $pKV=  $data[0]->{'pKV'};  //$lastDate=$data[0]->{'lastDate'};
	$conn= mysqli_connect($servername , $username, $r_P, $dbName); $query = "DELETE FROM ". $t_Name. " WHERE " .$pK. "='".$pKV."'";
	//$dateCon1= date('Y-m-d', strtotime('1970/00/00')); 	$dateCon2= date('Y-m-d', strtotime('2023/07/31'));  // Multiple Delete
	 //$conn= mysqli_connect($servername , $username, $r_P, $dbName); $query = "DELETE FROM ". $t_Name. " WHERE MenuDate>'".$dateCon1."' AND MenuDate<'".$dateCon2."'";  
		if (mysqli_query($conn, $query)) { echo "Deleted Successfully...";  }  else {  echo "Failed Delete". mysqli_error($conn); }
	}		 
		else if ($postName=='InsertMonthlyMenu') { $dbName= $data[0]->{'dbName'};  $t_Name= $data[0]->{'t_Name'}; $pK= $data[0]->{'pK'}; $pKV= $data[0]->{'pKV'}; $pKV= $data[0]->{'pKV'}; $lastDate= $data[0]->{'lastDate'};  /*"2020-12-31";*/ $BreakFast= $data[0]->{'Meal BreakFast'}; $Lunch= $data[0]->{'Meal Lunch'}; $Dinner= $data[0]->{'Meal Dinner'};  $data=array(); $D1=array(); $D2=array(); $D3=array(); $D4=array(); $D5=array(); $D6=array(); $D7=array();
		try { $Curdate = new DateTime("now", new DateTimeZone('America/Phoenix')); $Curdate=$Curdate->format('Y-m-d'); $month= date('m', strtotime($lastDate))+1; $year=$month>12?(date('Y', strtotime($lastDate))+1):(date('Y', strtotime($lastDate))); $month=$month>12? 1 :$month; $MonthSize= date('t', strtotime($month.'/'.$year)); $conn= mysqli_connect ($servername, $username, $r_P, $dbName);  $query="SELECT Meal.MealSno from Meal INNER JOIN MealCategory ON Meal.MealCat=MealCategory.MealCat WHERE MealCategory.MealCat='Meal BreakFast'";  $result= mysqli_query($conn, $query); if(mysqli_num_rows($result)>0) { while($row=mysqli_fetch_array($result)){ $D1[]=$row['MealSno'];  } } 	} catch(Exception $e) { $Data[]='What is Going on here!'; } 
		try { $query="SELECT Meal.MealSno from Meal INNER JOIN MealCategory ON Meal.MealCat=MealCategory.MealCat WHERE MealCategory.MealCat='Meal Lunch'";  $result= mysqli_query($conn, $query); if(mysqli_num_rows($result)>0) { while($row=mysqli_fetch_array($result)){ $D2[]=$row['MealSno'];  } } 	} catch(Exception $e) { $Data[]='What is Going on here!'; }  		
		try { $query="SELECT Meal.MealSno from Meal INNER JOIN MealCategory ON Meal.MealCat=MealCategory.MealCat WHERE MealCategory.MealCat='Meal Dinner'";  $result= mysqli_query($conn, $query); if(mysqli_num_rows($result)>0) { while($row=mysqli_fetch_array($result)){ $D3[]=$row['MealSno'];  } } 	} catch(Exception $e) { $Data[]='What is Going on here!'; }  		
		try { $query="SELECT Meal.MealSno from Meal INNER JOIN MealCategory ON Meal.MealCat=MealCategory.MealCat WHERE MealCategory.MealCat='Veggies/Fruits'";  $result= mysqli_query($conn, $query); if(mysqli_num_rows($result)>0) { while($row=mysqli_fetch_array($result)){ $D4[]=$row['MealSno'];  } } 	} catch(Exception $e) { $Data[]='What is Going on here!'; }  		
		try { $query="SELECT Meal.MealSno from Meal INNER JOIN MealCategory ON Meal.MealCat=MealCategory.MealCat WHERE MealCategory.MealCat='Drinks/Beverages'";  $result= mysqli_query($conn, $query); if(mysqli_num_rows($result)>0) { while($row=mysqli_fetch_array($result)){ $D5[]=$row['MealSno'];  } } 	} catch(Exception $e) { $Data[]='What is Going on here!'; }  				
		$i=1;  $VI=0; $DRI=0; $BL= count($D1); $LL=count($D2); $DL=count($D3); $VL=count($D4); $DRL= count($D5); $BI= array_search($BreakFast, $D1)+1; $LI= array_search($Lunch, $D2)+1; $DI=array_search($Dinner, $D3)+1;  $sql="";
		while ($i<=$MonthSize) {  $dateCon= date('Y-m-d', strtotime($year.'/'.$month. '/'.$i)); 
				$sql =$sql. " INSERT INTO Menu (MealSno, FostId, MenuDate) VALUES ('".$D1[$BI]."', '$pKV', '$dateCon'); "; $sql =$sql. " INSERT INTO Menu (MealSno, FostId, MenuDate) VALUES ('".$D2[$LI]."', '$pKV', '$dateCon'); "; $sql =$sql. " INSERT INTO Menu (MealSno, FostId, MenuDate) VALUES ('".$D3[$DI]."', '$pKV', '$dateCon'); "; $sql =$sql. " INSERT INTO Menu (MealSno, FostId, MenuDate) VALUES ('".$D4[$VI]."', '$pKV', '$dateCon'); "; $VI++;  $VI=$VI==$VL?0:$VI; $sql =$sql. " INSERT INTO Menu (MealSno, FostId, MenuDate) VALUES ('".$D4[$VI]."', '$pKV', '$dateCon'); "; $VI++;  $VI=$VI==$VL?0:$VI; $sql =$sql. " INSERT INTO Menu (MealSno, FostId, MenuDate) VALUES ('".$D4[$VI]."', '$pKV', '$dateCon'); "; $VI++;  $VI=$VI==$VL?0:$VI;  $sql =$sql.  " INSERT INTO Menu (MealSno, FostId, MenuDate) VALUES ('".$D5[$DRI]."', '$pKV', '$dateCon'); ";
				//echo ('('. $BI.'/'. $BL.', '.$LI. '/'. $LL. '. '. $DI. '/'. $DL. ','. $VI.'/'.$VL.','. $DRI. '/'. $DRL.')');   //echo '('.i.')Break fast '.$BI.' Lunch '.$LI. ' Dinner '. $DI. ' Veggies'. $VI. ' Drink'. $DRI. ')';
				 $BI++; $LI++; $DI++;  $DRI++; $BI=$BI==$BL?0:$BI;  $LI=$LI==$LL?0:$LI; $DI=$DI==$DL?0:$DI;  $DRI=$DRI==$DRL?0:$DRI;  $i++; 
		} try { if (mysqli_multi_query($conn, $sql)) { echo "New records created successfully"; } else { echo "Error: " . $sql . "<br>" . mysqli_error($conn); }	 } catch(Exception $e) { $Data[]='What is Going on here!'; }	 
	}
	else if ($postName=='settingMenu') { $count=0;  $dbName= $data[0]->{'dbName'};  $t_Name=  $data[0]->{'t_Name'};  $pK=  $data[0]->{'pK'};   $D1=array(); $D2=array(); $D3=array(); $D4=array(); $D5=array();	 
	 	foreach($data[1] as $k=>$v)  {  $duplicate=false;
	 		try {  $conn= mysqli_connect ($servername, $username, $r_P, $dbName);   $val=mysqli_real_escape_string($conn, $v); $query="SELECT  * from dropdownmenu WHERE mainTable='".$t_Name. "' AND relTable='". $val ."'";   $result= mysqli_query($conn, $query); if(mysqli_num_rows($result)>0) {$count++; $duplicate=true; } }  catch(Exception $e) {  echo "Failed Delete". $e;  } 
			if ($duplicate==false) { $sql ="INSERT INTO dropdownmenu (mainTable, relTable) VALUES ('$t_Name', '$val')";
			try { if (mysqli_multi_query($conn, $sql)) { echo "New records created successfully"; } else { echo "Error: " . $sql . "<br>" . mysqli_error($conn); }	 } catch(Exception $e) { $Data[]='What is Going on here!'; } }  mysqli_close($conn); 
		} 
	} 				  			  		  			  
 ?>