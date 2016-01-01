<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

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
                <a class="navbar-brand" href="about.php">AETMS - About</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Home</a>
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
		<h3 style="text-info">About AETMS</h3>
			
			<div class="panel panel-default">
			<div class="panel-heading">AETMS</div> 
			<div class="panel-body">
			<p>AETMS (Automated Electronic Temperature Monitoring System) is a hardware, software and webserver based solution which allows the user to interact with different temperature values that are polled on a regular basis. Features include: </p> 
			<ul class="list">	
				<li>Realtime continuous temperature monitoring</li>
				<li>Web-based, interactive graphing and logging functionality across various hour/day/month intervals</li>
				<li>Email and Twitter-based alerting system with text-messaging functionality to notify users of out-of-range temperatures</li>
				<li>Email-based database backup <strong>(planned)</strong></li>
				<li>At-a-glance monitoring for multiple sensors</li>
				<li>Support for multiple temperature sensors</li>
			
			</ul>
			<br>
			In this specific implementation, this solution has been implemented as part of a Quality Improvement Project at the South East Toronto Family Health Team in order to closely monitor the temperatures of vaccine-containing fridges in the Red, Green and Blue "Zones" of the clinic.
			
			</div>
			</div>
			
			<div class="panel panel-default">
			<div class="panel-heading">How To</div> 
			<div class="panel-body">
			<ul class="list-unstyled">	
				A 2-Part complete guide is available that details parts used, software components and a outlines steps followed to configure and use the hardware and software. This can be found at <a href="https://ankitrasto.wordpress.com/2015/12/28/part-12-vaccine-temperature-monitoring-with-the-raspberry-pi/">ankitrasto.wordpress.com</a>, with the source code hosted on github at <a href="https://github.com/ankitrasto">github.com/ankitrasto</a>   
			</div>
			</div>
								
			<div class="panel panel-default">
			<div class="panel-heading">Technical Information</div> 
			<div class="panel-body">
			
			The AETMS hardware consists of:
							
			<ul class="list">	
				<li>A raspberry pi 2 running the Raspbian Linux Distribution (kernel 4.1.10-v7+)</li>
				<li>A DS18B20 temperature sensor with a 4.7K resistor pullup. A full datasheet, performance curve and quality control information can be found <a href="http://cdn.sparkfun.com/datasheets/Sensors/Temp/DS18B20.pdf">here,</a> which fully meets and exceeds standards/recommendations by Ontario Public Health</li>
				<li>The sensor/resistor are assembled via a 3 pin terminal and wired directly to the raspberry pi's GPIO ports</li>
			</ul>
			
			The AETMS software performs the following:
			
			<ul class="list">
				<li>Python code polls temperature information from the DS18B20 temperature sensor via a 1-wire GPIO interface. This information along with the local date and time, is written to an sqlite database.</li>
				<li>An apache/PHP webserver is used as an accessible interface to this database. It displays the most recent readings, as well as a graphable interface using the Google Charts API. The graphical interface allows the user to view historical temperature data dating back up to 12 months.</li>
				<li>Python code is used to implement the notification system as a separate program, which uses the Twitter API and send-mail/mailx tool to send out twitter direct-messages and email notifications. The user can easily receive text messages by enabling SMS-notifications for direct messages via their Twitter account.</li>
			</ul>
			<br>
			
			
			
			<br><strong>Licensing</strong><br>
			
			<div class="text-center">
				<img src="gplv3-127x51.png" alt="GNU GPL v3" align="center">
			</div>
			
			All original parts of the AETMS software, including PHP and python code are licensed under the <a href="http://www.gnu.org/licenses/gpl-3.0.en.html">GNU GPL v3 license</a>. The following other libraries have been used with their respective licenses:
			
			<ul class="list">
			<li>Bootstrap (front-end web framework): <a href="https://opensource.org/licenses/MIT">MIT License</a> </li>
			<li>Google Charts API (graphing interface) <a href="https://developers.google.com/terms/">Google API Terms of Service</a></li>
			</ul>
			
			The AETMS project software page can be found at <a href="https://github.com/ankitrasto">github.com/ankitrasto</a>
			
			</div>
			</div>
		
		</div>
		
		
		<div class="col-lg-2 text-right">
		
		</div>
     
     
     
     </div>
     <!---row--->
    </div>
    <!-- /.container -->

    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>
    
    <!-- google charts online JSAPI reference-->
    <script src="https://www.google.com/jsapi"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    
</body>

</html>
