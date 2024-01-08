<!DOCTYPE html>
<html><head><title>AngularJS File Upoad Example with $http and FormData</title><script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.4/angular.min.js"></script></head>
<body ng-app="fupApp">
<?php 
$dbh=new PDO("mysql:host=localhost; dbname=loveandrespectdb",  "root","123456789"); 
if (isset($_POST['btn'])){
	$name=$_FILES['myfile']['name']; $type=$_FILES['myfile']['type']; $data=file_get_contents($_FILES['myfile']['tmp_name']);
	$stmt=$dbh->prepare("insert into docexpense values ( '', ?, ?)"); //$stmt=bindParam(1,$name); $stmt=bindParam(2, $type); $stmt=bindParam(3, $data); $stmt->execute();
	$stmt=bindParam(2, 1); $stmt=bindParam(3, $data); $stmt->execute();
	//echo "<img src='data:image/jpeg; base64," . base64_encode($_FILES['myfile']['name']) ."' height='250px' width='250px'/>";
	mysqli_close($dbh); 
	}
?>
	<form method="post"  enctype="multipart/form-data"> <input type="file" name="myfile" /> <button name="btn">Upload</button> </form>  <p></p>
	<ol>
	<?php	
	
		$conn = new mysqli("localhost", "root", "123456789","loveandrespectdb");
		 $query="select * from docexpense";  
		 $result= mysqli_query($conn, $query); if(mysqli_num_rows($result)>0) 
		 { 
		 while($row=mysqli_fetch_array($result)){ //header("Content-type: image/jpeg");
			echo "<li><img src='data:image/jpeg; base64," . base64_encode($row['Receipt']) ."' height='250px' width='250px'/></li>"; 		
		 } 
	  }
	?>
	</ol>
    <div ng-controller="fupController">

        <input type="file" id="file1" name="file" multiple
            ng-files="getTheFiles($files)" />

        <input type="button" ng-click="uploadFiles()" value="Upload" />
    </div>
</body>
<script>
    angular.module('fupApp', [])
        .directive('ngFiles', ['$parse', function ($parse) {

            function fn_link(scope, element, attrs) {  
		      var onChange = $parse(attrs.ngFiles);  
			  element.on('change', function (event) { onChange(scope, { $files: event.target.files }); });};  
			    return { link: fn_link }
        } ])
        .controller('fupController', function ($scope, $http) {

            var formdata = new FormData();
            $scope.getTheFiles = function ($files) {
                angular.forEach($files, function (value, key) {
                    formdata.append(key, value);
                });
            };

            // NOW UPLOAD THE FILES.
            $scope.uploadFiles = function () {

                var request = { method: 'POST', url: '/fileupload', data: formdata, headers: { 'Content-Type': undefined }  };

                // SEND THE FILES.
                $http(request) .success(function (d) {  alert(d); }) .error(function () { });
            }
        });
</script>
</html>