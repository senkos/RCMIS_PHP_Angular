<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
use PHPMailer\PHPMailer\PHPMailer;   require_once ('../PHPMailer/PHPMailer.php');   require_once "../PHPMailer/SMTP.php";   require_once "../PHPMailer/Exception.php";
	$data=array(); $data2= array(); $data3= array();  $bodyMsg=''; $Data=array();  $info =json_decode(file_get_contents("php://input")); 
	$subject="AfcSoftwareSystem"; $name="xxxxxxxx";
	$Curdate = new DateTime("now", new DateTimeZone('America/Phoenix')); $d=$Curdate->format('M-d-Y'); //$d=(today.getMonth()+1)+ '/'+(today.getDate())+'/'+today.getFullYear(); 
	$divTable="'display:table;  margin-left: auto;  margin-right: auto; table-layout: fixed; border-collapse: collapse; border:solid 3px #92a8d1; border-radius:5px; '"; $divCaption="'display: table-caption; width:100%;  margin-left: auto;  margin-right: auto; '";  $divRowH="'display: table-row; width:98%; background-color:cyan; border-bottom:solid 1px; border-left:solid 1px; border-right:solid 1px; border-radius:5px;'"; $divRow="'display: table-row; width:100%;  border-bottom:solid 1px; border-left:solid 1px; border-right:solid 1px;  border-radius:5px;'"; $divRow2="'display: table-row; width:100%;  background-color: crimson; border-bottom:solid 1px; border-left:solid 1px; border-right:solid 1px;  border-radius:5px;'";$divTd8="'display: table-cell; border-right:solid 1px; width:5%; overflow-x:scroll; overflow-y:hidden; white-space:nowrap;'"; $divTd12="'display: table-cell; width:12%; overflow-x:scroll; border-right:solid 1px; overflow-y:hidden; white-space:nowrap;'"; $divTd15="'display: table-cell; width:16%; overflow-x:scroll; border-right:solid 1px; overflow-y:hidden; white-space:nowrap;'"; $divTd20="'display: table-cell; width:18%; border-right:solid 1px; overflow-x:scroll; overflow-y:hidden; white-space:nowrap;'";	
	$bodyp=''; $temp=''; $tdata=''; $i=0; $ii=1;
	$bodyMsg ="<div style=".$divTable."><div style=".$divCaption."><h3>Summary <i>(Date :".$d."</i>) </h3><h4>Love and Respect Adult Foster Home</h4></div>"; 
	/*foreach($info as $key=>$value) { $data[]= $value;  }  
		if ($data[0]->{'postName'}=='oPSummary') foreach($data[1] as $key=>$value)  foreach ($value as $ke=>$val) { //$space="<div style=". $spacing. ">&nbsp;</div>";
			if ( $ke== 'getCurren' ) {   $i=0; $bodyp.= "<div style=".$divTable."><div style=".$divCaption."><i>Resident Medication Information: </i></div>";  
				$bodyp.= "<div style=".$divRowH."><div style=".$divTd8.">Sno.</div><div style=".$divTd20.">Resident Id </div><div style=".$divTd20.">Medication Name </div><div style=".$divTd15.">Days Rem. </div><div style=".$divTd15.">Strength </div><div style=".$divTd15.">Exp Date </div><div style=".$divTd20.">Rx No</div></div>";				
				foreach ($val as $k=>$v) {  if ($v->{'DatesRemained'}<10) $Row=$divRow2; $Row= $divRow;  			
				 $i=$k+1; $bodyp.= "<div style=".$Row."><div style=".$divTd8.">".$i. ")</div><div style=".$divTd20.">". $v->{'resId'}. "</div><div style=".$divTd20.">". $v->{'GenName'}. "</div><div style=".$divTd15.">". $v->{'DatesRemained'}. "</div><div style=".$divTd15.">".  $v->{'strength'} . "</div><div style=".$divTd15.">". date_format(date_create($v->{'expDate'}), 'M/d/Y') . "</div><div style=".$divTd20.">".  $v->{'RxNo'}. "</div></div>";  
				}  $bodyp.="</div>";
				}
			else if ( $ke== 'expCertif' ) { $i=0; $bodyp.=  "<div style=".$divTable."><div style=".$divCaption."><i>Staff Documentations: </i></div>";
				$bodyp.= "<div style=".$divRowH."><div style=".$divTd8.">Sno.</div><div style=".$divTd20.">Staff Id </div><div style=".$divTd20.">Course Code </div><div style=".$divTd15.">Dayes Rem.</div><div style=".$divTd15.">Certif.Exp </div></div>";				
				foreach ($val as $k=>$v) {  if ($v->{'DatesRemained'}<10) $Row=$divRow2; else $Row= $divRow;
				 $i=$k+1; $bodyp.= "<div style=".$Row."><div style=".$divTd8.">".$i. ")</div><div style=".$divTd20.">". $v->{'Staff_Id'}. "</div><div style=".$divTd20.">". $v->{'Course_Code'}. "</div><div style=".$divTd15.">". $v->{'DatesRemained'}. "</div><div style=".$divTd15.">".  date_format(date_create($v->{'CertExDate'}), 'M/d/Y')  . "</div></div>";  
				} $bodyp.="</div>";
				}
		 	else if ( $ke== 'drapptRem' ) { $i=0; $bodyp.="<div style=".$divTable."><div style=".$divCaption."><i>Doctor's/Other Resident Appointments: </i></div>";
				$bodyp.= "<div style=".$divRowH."><div style=".$divTd8.">Sno.</div><div style=".$divTd20.">Resident's Id </div><div style=".$divTd20.">Appt. Date </div><div style=".$divTd15.">Appt .Time</div><div style=".$divTd15.">Dates Remained </div></div>";				
				foreach ($val as $k=>$v) {  if ($v->{'DatesRemained'}<10) $Row=$divRow2; else $Row= $divRow;
				$i=$k+1; $bodyp.= "<div style=".$Row."><div style=".$divTd8.">".$i. ")</div><div style=".$divTd20.">". $v->{'resId'}. "</div><div style=".$divTd20.">". date_format(date_create($v->{'AppDate'}), 'M/d/Y') . "</div><div style=".$divTd15.">". $v->{'AppTime'}. "</div><div style=".$divTd15.">".  $v->{'DatesRemained'} . "</div></div>";  
				} $bodyp.="</div>";
				} 
			else if ( $ke== 'deligatio' ) {  $i=0; $bodyp.= "<div style=".$divTable."><div style=".$divCaption."><i> Deligation Expiration Check : record/s </i></div>"; 			                        	
			  	$bodyp.= "<div style=".$divRowH."><div style=".$divTd8."> Sno.</div><div style=".$divTd20."> Staff Name </div><div style=".$divTd20."> Resident Id </div><div style=".$divTd15.">Rem(D)</div><div style=".$divTd15.">  Deligation Task </div><div style=".$divTd15.">Last Deligated</div><div style=".$divTd15.">Next Deligation</div></div>";					
					foreach ($val as $k=>$v) { if ($v->{'DatesRemained'}<10) $Row=$divRow2; else $Row= $divRow;
					$i=$k+1; $bodyp.= "<div style=".$Row."><div style=".$divTd8.">".$i. ")</div><div style=".$divTd20.">". $v->{'Staff_Id'}. "</div> <div style=".$divTd20.">". $v->{'Resident_Id'}. "</div><div style=".$divTd15.">". $v->{'DatesRemained'}. "</div><div style=".$divTd20.">". $v->{'Del_Id'}. "</div><div style=".$divTd20.">". date_format(date_create($v->{'lastDeligated'}), 'M/d/Y') . "</div><div style=".$divTd20.">". date_format(date_create($v->{'maxDate'}), 'M/d/Y') . "</div></div>";              			
				}  $bodyp.="</div>";
				}
			else if ( $ke== 'fireDrill' ) { $i=0; $bodyp.= "<div style=".$divTable."><div style=".$divCaption."><i> Firedrill Expiration Info. </i></div>"; 
				$bodyp.= "<div style=".$divRowH."><div style=".$divTd8.">Sno.</div><div style=".$divTd20."> Operator Id </div><div style=".$divTd20."> Days Rem </div><div style=".$divTd15."> Last Fire-Drill </div></div>";				
				foreach ($val as $k=>$v) { if ($v->{'DatesDiff'}<10) $Row=$divRow2; else $Row= $divRow;
				$i=$k+1; $bodyp.= "<div style=".$Row."><div style=".$divTd8.">".$i. ")</div><div style=".$divTd20.">". $v->{'licenseNo'}. "</div><div style=".$divTd20.">". $v->{'DatesDiff'}. "</div><div style=".$divTd15.">". date_format(date_create($v->{'maxDate'}), 'M/d/Y') . "</div></div>";  			           	
				} $bodyp.="</div>";
				}
			}		*/	
		$bodyMsg.=$bodyp. "</div>";  
		sendEmail($bodyMsg, $subject, $name); 	
	 function sendEmail ($bodyMsg, $subject, $name) { 
			$email="tselise@yahoo.com";
			$body=$bodyMsg;
			require_once ('../PHPMailer/PHPMailer.php'); require_once "../PHPMailer/SMTP.php"; require_once "../PHPMailer/Exception.php";
	
			$mail = new PHPMailer();
			//SMTP Setting
			$mail->SMTPDebug = 1; $mail->CharSet = "UTF-8"; $mail->isSMTP(); $mail->Host = "smtp.gmail.com"; $mail->SMTPAuth = true; $mail->Username = "tselisami@gmail.com";
			$mail->Password = "utfmsakjgndtrjpc"; $mail->Port = 465;  $mail->SMTPSecure = "ssl"; //tls
			//Email setting
			$mail->isHTML (true); $mail->setFrom ($email, $name); $mail->addAddress ('senkos@yahoo.com'); $mail->addAddress ('tselise@yahoo.com'); $mail->Subject = $subject;
			$mail->Body = $body;
			if ($mail->send()) $success="Sucess";	 else $success="something is wrong: <br> <br>". $mail->ErrorInfo;  
		}
?>