<!DOCTYPE html>
<html lang="en" ng-app="main">
  <head>   
   <meta charset="utf-8">
    <title>Bootstrap, from Twitter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <!-- <link href="assets/css/bootstrap.css" rel="stylesheet"> -->
    <style type="text/css">
      body {
        padding-top: 20px;
        padding-bottom: 60px;
      }

      /* Custom container */
      .container {
        margin: 0 auto;
        max-width: 1366px;
      }
      .container > hr {
        margin: 60px 0;
      }

      /* Main marketing message and sign up button */
      .jumbotron {
        margin: 80px 0;
        text-align: center;
      }
      .jumbotron h1 {
        font-size: 100px;
        line-height: 1;
      }
      .jumbotron .lead {
        font-size: 24px;
        line-height: 1.25;
      }
      .jumbotron .btn {
        font-size: 21px;
        padding: 14px 24px;
      }
      /* Supporting marketing content */
      .marketing {
        margin: 60px 0;
      }
      .marketing p + h4 {
        margin-top: 28px;
      }
      /* Customize the navbar links to be fill the entire space of the .navbar */
      .navbar .navbar-inner {
        padding: 0;
      }
      .navbar .nav {
        margin: 0;
        display:table;
        width: 100%;
      }
      .navbar .nav li {
        display:table-cell;
        width: 10%;
        float: none;
      }
      .navbar .nav li a {
        font-weight: bold;
        text-align: center;
        border-left: 1px solid rgba(255,255,255,.75);
        border-right: 1px solid rgba(0,0,0,.1);
      }
      .navbar .nav li:first-child a {
        border-left: 0;
        border-radius: 3px 0 0 3px;
      }
      .navbar .nav li:last-child a {
        border-right: 0;
        border-radius: 0 3px 3px 0;
      }
	  .has-error {
   		color: red;
   	   background-color: yellow;
		}
    </style>
   <link rel="stylesheet" href="css/bootstrap-responsive.css" media="all" type="text/css">
	<!-- <link rel="stylesheet" href="css/Love&RespectACFH_CSS.css" type="text/css"> -->
	<link rel="stylesheet" href="css/Bootstrap.min.css" media="all" type="text/css">  	
	<link rel="stylesheet" href="css/ui-bootstrap-2.5.0-csp.css" type="text/css"> 
	<link rel="stylesheet" href="css/PersonalCSS.css" type="text/css">  	 
	<link rel="stylesheet" href="css/PrintableNgview.css" type="text/css">		
	<link rel="stylesheet" href="css/Printable.css" type="text/css">		

	<!--<link rel="stylesheet" href="css/Bootstrap.css" type="text/css"> -->

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="ico/favicon.png">
  </head>
<body>
	<div class="container" style="border:solid 1px red; margin:0%; border-radius: 5px;">
		<div class="row" style="border:solid 1px blue; margin:0%; border-radius: 5px;">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	  			<div class=""> 
					<div style="border:solid 1px; margin:1%; border-radius: 5px;" class="row-fluid" id="myNav" ng-controller="loadDefault" ng-init="funcloadDef()"> </div>
					<span style="border:solid 1px; margin:1%; border-radius: 5px;" class="row-fluid" ng-show="isLodding" style="margin-left:20%; color:#FF0000; text-size:20;"><b>Loadding...Please wait! </b></span>
					<div style="border:solid 1px; margin:0%; border-radius: 5px;" class="row table table-responsive" ng-view></div>  
				</div>	
			</div>		
	<!--		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				 <div class="rightside"></div> -->
			</div>				
		</div> 		
	<div class="row" style="">
 		 <hr>  
		 <div class="footer" style="position: fixed; left: 0; bottom: 0; width: 100%; background-color: gray; color: white; text-align: center;"> <p>Copy right &copy; 2018-2021 This web application Has been Developed by Enkosa S. </p></div>
	</div>
</div>		

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->	
	<script type="text/javascript" src="js/Jquery.min.js"></script> 
	 <script type="text/javascript" src="js/BootStrap.min.js"></script>	
	<script type="text/javascript" src="js/angular.min.js"></script>
	<script type="text/javascript" src="js/angular-route.min.js"> </script>	
	<script type="text/javascript" src="js/ui-bootstrap-tpls-2.5.0.min.js"></script>		
	<script type="text/javascript" src="js/angular-sanitize.min.js"></script>	
	<script type="text/javascript" src="js/JsFiles.js"> </script>	
	<script type="text/javascript" src="js/angular-cookies.min.js"></script>
	<script type="text/javascript" src="js/angular-animate.min.js"></script>	
    <!-- <script type="text/javascript" src="js/bootstrap-transition.js"></script>
    <script type="text/javascript" src="js/bootstrap-alert.js"></script>
    <script type="text/javascript" src="js/bootstrap-modal.js"></script>
    <script type="text/javascript" src="js/bootstrap-dropdown.js"></script>
    <script type="text/javascript" src="js/bootstrap-scrollspy.js"></script>
    <script type="text/javascript" src="js/bootstrap-tab.js"></script>
    <script type="text/javascript" src="js/bootstrap-tooltip.js"></script>
    <script type="text/javascript" src="js/bootstrap-popover.js"></script>
    <script type="text/javascript" src="js/bootstrap-button.js"></script>
    <script type="text/javascript" src="js/bootstrap-collapse.js"></script>
    <script type="text/javascript" src="js/bootstrap-carousel.js"></script>
    <script type="text/javascript" src="js/bootstrap-typeahead.js"></script>   -->
  </body>
</html>
<script>
function checkCookies() {
	//var x=document.getElementById("login");  x.href ="#/login"; x.innerHTML="login"; 
}
</script>