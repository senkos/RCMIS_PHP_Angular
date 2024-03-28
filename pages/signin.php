 <style type="text/css">
      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }
    </style>
<div ng-controller="loginCtrl" ng-init="getTableinfo()" class="">	
	<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
//echo "<div class='container'>";
//echo "<div class='row-fluid'>";
		echo "<span class='error' ng-show='loggedIn' style=' color: red; font-size:150%;'>Already LoggedIn! </span><br>";
	   	echo "<form name='signin' ng-show='checkSignIn' class='form-signin'>";
       		echo "<h2 class='form-signin-heading'>Please sign in </h2>";
       		echo "<input type='text' ng-show='sfChecker' class='input-block-level' name='userId' ng-model='userId' placeholder='Email address'>";
        	echo "<input type='password' ng-show='sfChecker' name='loginPass' ng-model='loginPass' class='input-block-level' placeholder='Password'>";
			echo "<input type='password' ng-show='rpChecker' name='rootPass' ng-model='rootPass' class='input-block-level' placeholder='root-password'>";
        	echo "<label class='checkbox'>";
          	echo "<input type='checkbox' value='remember-me'> Remember me </label>";
        	//echo "<input type='submit' class='btn btn-large btn-primary' ng-show='rpChecker' ng-click=signIn(userId, loginPass) name='btnOk' value='Ok'>";
        	echo "<a class='btn btn-large btn-primary' ng-show='sfChecker' ng-click='signIn(userId, loginPass)'> Sign_In</a>";
      	echo "</form>";
			echo "<form name='myForm' ng-show='checkConfigT'>"; 
			echo "<table class='table table-bordered'>";
			echo "<tr><td class='col-xs-2 col-sm-2 col-md-2 col-lg-2'>DataBase Name</td><td class='col-xs-2 col-sm-2 col-md-2 col-lg-2'>Table Name </td><td class='col-xs-2 col-sm-2 col-md-2 col-lg-2'>User Id </td><td class='col-xs-2 col-sm-2 col-md-2 col-lg-2'>Password</td><td class='col-xs-2 col-sm-2 col-md-2 col-lg-2'>Index File type</td><td class='col-xs-1 col-sm-1 col-md-1 col-lg-1'>Default Login</td><td class='col-xs-1 col-sm-1 col-md-1 col-lg-1'>Save</td></tr>";
			echo "<tr ng-repeat='f in rP'>";
			echo "<td class='col-xs-2 col-sm-2 col-md-2 col-lg-2'>{{f.dbName}}</td><td class='col-xs-2 col-sm-2 col-md-2 col-lg-2'><select class='dropdown-toggle' data-toggle='dropdown' ng-disabled='f.enadis' type='text' ng-change='ontblselChange(f.tblSelected)' ng-model='f.tblSelected' ng-value='' ng-options='dbrec as dbrec.Table_Name for dbrec in f.tName'></td><td class='col-xs-2 col-sm-2 col-md-2 col-lg-2'><select class='dropdown-toggle' data-toggle='dropdown' ng-disabled='f.enadis' type='text' ng-change='onuserselChange(f.userSelected, f.passSelected)' ng-model='f.userSelected' ng-value='' ng-options='usrec as usrec.tblLabel for usrec in f.userId'></td><td class='col-xs-2 col-sm-2 col-md-2 col-lg-2'><select class='dropdown-toggle' data-toggle='dropdown' ng-disabled='f.enadis' type='text' ng-change='onpasselChange(f.userSelected, f.passSelected)' ng-model='f.passSelected' ng-value='' ng-options='passrec as passrec.tblLabel for passrec in f.userpass'></td><td class='col-xs-2 col-sm-2 col-md-2 col-lg-2'>Style</td><td class='span1'><button class='btn btn-success btn-xs' ng-click='turnOnOffDefault(f.dbName)'><span class='glyphicon glyphicon-edit'></span>{{f.onoff}}</button></td>";
			echo "<td class='col-xs-1 col-sm-1 col-md-1 col-lg-1'><button class='btn btn-success btn-xs' ng-disabled='f.enadisOk' ng-click='saveConfig(f.dbName, f.tblSelected, f.userSelected, f.passSelected)'><span class='glyphicon glyphicon-edit'></span>{{f.save}}</button></td>";
			echo "</tr>"; 
			echo "</table></form>"; 
				//}
		echo "</table>";
		echo "<span ng-show='configTable'>Create Configuration Database/Tables!</span>";
	  	echo ""; // <!-- offset -->
//echo "</div>"; // <!-- /row -->
//echo "</div>"; // <!-- /container -->

$servername = "us-cluster-east-01.k8s.cleardb.net"; $dbName= "heroku_cdcc5d2c5ee9a30"; $username = "b91508f33657c6";  $r_P= "b90e8ecb"; $getName=htmlspecialchars($_GET['getName']);  $Data=array(); 
 
		 $conn = new mysqli($servername, $username, $r_P,$dbName); 
		$query="SELECT *  FROM Employee; 
	$result= mysqli_query ($conn, $query);	
  while($row=mysqli_fetch_array($result)){ echo $row['EmpFName']; }
	
?>
</div>
<script>
</script>
