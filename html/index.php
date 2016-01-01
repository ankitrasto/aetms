<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv="Refresh" content=600>

    <title>SETFHT-AEFTMS</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
    body {
        padding-top: 70px;
        /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
    }
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">AETMS</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="about.php">About</a>
                    </li>
                    <li>
						<a href="rz_graphLog.php">Graphical Log</a>
                    </li>
                     <li>
                        <a href="mailto:ankit.rastogi@mail.utoronto.ca" style="color:rgb(255,255,0)">Feedback</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">	
        <div class="row">				
            <div class="col-lg-10 text-left">
                <h2><strong>South East Toronto Family Health Team</strong></h2>
                <h3>Automated Electronic Fridge Temperature Monitoring System</h3>
					
				<div class="panel panel-default">
				<div class="panel-heading"><strong>Red Zone Fridge</strong> (Probe: DS18B20, Serial:28-00000530d4e7)</div> 
				<div class="panel-body">
					<img src="syringe_REDZONE.jpg" alt="Responsive Image" class="img-responsive" width="30%" align="left">
					
					<div class="rz_tempContainer"> 
					<?php
					$linesRZ = file("rz_temp.txt");
					$RZTemp = floatval($linesRZ[0]);
					if($RZTemp >= 2.5 and $RZTemp <= 7.5){
						echo '<p class="bg-success">'.$RZTemp.' deg. C. </p>';	
					}elseif($RZTemp <= 2.0 or $RZTemp >= 8.0){
						echo '<h3 class="bg-danger">'.$RZTemp.' deg. C. <strong>CRITICAL</strong> </h3>';	
					}else{
						echo '<p class="bg-warning">'.$RZTemp.' deg. C. <strong>WARN</strong> </p>';
					}
					echo 'Last Updated: '.$linesRZ[1].'<br><br>';
					?>
					</div>
                
				</div>
				</div>
               
            <div class="panel panel-default">
			<div class="panel-heading"><strong>Green Zone Fridge</strong> (Probe: DS18B20, Serial: N/A)</div> 
			<div class="panel-body">
			<ul class="list-unstyled">	
				<img src="syringe_GREENZONE.jpg" alt="Responsive Image" class="img-responsive" width="30%" align="left"> <br><h3><strong>OFFLINE</strong></h3> 
			</div>
			</div>
            
            <div class="panel panel-default">
			<div class="panel-heading"><strong>Blue Zone Fridge</strong> (Probe: DS18B20, Serial: N/A)</div> 
			<div class="panel-body">
			<ul class="list-unstyled">	
				<img src="syringe_BLUEZONE_2.jpg" alt="Responsive Image" class="img-responsive" width="30%" align="left"> <br><h3><strong>OFFLINE</strong></h3> 
			</div>
			</div>
			
		<div class="panel panel-default">
		<div class="panel-heading">Temperature Ranges</div> 
		<div class="panel-body">
		<ul class="list-unstyled text-info">	
                   	<li class>Target Temperature Range: <strong>2–8 deg. C. </strong></li>
                    	<li>Warning Threshold: 2.0 – 2.5 or 7.5 – 8.0 deg. C. </li>
                    	<li>Critical Temperatures: <2.0 deg.C or >8.0 deg.C. </li>
                </ul></div>
		</div>
            </div>


	<div class="col-lg-2 text-right"></div>
            
        </div>
        <!-- /.row -->
	
    </div>
    <!-- /.container -->

    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    
</body>

</html>
