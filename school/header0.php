<?php
	if (!isset($pgnm)) {
		$pgnm="education is key";
	}
?>

<!DOCTYPE html>
<!--[if gt IE 8]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
    <head>
    	<!-- meta charec set -->
        <meta charset="utf-8">
		<!-- Always force latest IE rendering engine or request Chrome Frame -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<!-- Page Title -->
        <title>School Management System: <?php echo "$pgnm";?></title>		
		<!-- Meta Description -->
        <meta name="description" content="Smart Greenhouse project, Kimathi University">
        <meta name="keywords" content="Greenhouse, Greenhouse system, Dedan Kimathi University">
        <meta name="author" content="">
		<!-- Mobile Specific Meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
		
		<!-- Google Font -->
		<link rel="icon" href="" type="image/x-icon">
		
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>

		<!-- CSS
		================================================== -->
        <!-- W3 css -->
        <link rel="stylesheet" href="css/w3.css">
		<!-- Fontawesome Icon font -->
        <link rel="stylesheet" href="css/font-awesome.min.css">
		<!-- Twitter Bootstrap css -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
		<!-- jquery.fancybox  -->
        <link rel="stylesheet" href="css/jquery.fancybox.css">
		<!-- animate -->
        <link rel="stylesheet" href="css/animate.css">
		<!-- Main Stylesheet -->
        <link rel="stylesheet" href="css/main.css">
		<!-- media-queries -->
        <link rel="stylesheet" href="css/media-queries.css">

        <style type="text/css">
              @font-face{
                            font-family:Allages;
                            src: url('./fonts/AllagesDEMO_BOLD.tff'); 
                          }
        </style>

		<!-- Modernizer Script for old Browsers -->
        <script src="js/modernizr-2.6.2.min.js"></script>

    </head>
	
    <body id="body" onload="showTempGraph();">

   
	
		<!-- preloader -->
		<div id="preloader">
			<img src="img/preloader.gif" alt="Preloader">
		</div>
		<!-- end preloader -->

        <!-- 
        Fixed Navigation
        ==================================== -->
        <header id="navigation" class="navbar-fixed-top navbar">
            <div class="container">
                <div class="navbar-header">
                    <!-- responsive nav button -->
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <i class="fa fa-bars fa-2x"></i>
                    </button>
					<!-- /responsive nav button -->
					
					<!-- logo -->
                    <a class="navbar-brand" href="#body">
						<h1 id="logo">
                            <div>
                            <!-- I do some painting baby --> 
                             <div class="w3-tag w3-black allages">S</div>
                            <div class="w3-tag w3-white" style="">M</div>
                            <div class="w3-tag w3-yellow">S</div>
                            </div>
                            
							<img src="img/logo.png" class="img-responsive logo-main collapse" alt="SGP Logo">
						</h1> <h4><div class="w3-white">School Management System</div></h4>
					</a>
					<!-- /logo -->
                </div>

				<!-- main nav -->
                            <nav class="collapse navbar-collapse navbar-right" role="navigation">
                    <ul id="nav" class="nav navbar-nav">
                        <li class="current"><a href="./index.php"> Home </a> </li>

                    </ul>
                </nav>
				
            </div>
        </header>
        <div id="wrapper">
