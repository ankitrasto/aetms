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
                <a class="navbar-brand" href="rz_graphLog.php">AETMS - Graphical Log</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="about.php">About</a>
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
		<h3 style="text-info">Graphical Log and Statistics</h3>
			
		<p>This page displays a graphical and interactive representation of the temperature logs which dates back for up to 365 days. Interval statistics for a given time period are also displayed. It is updated at a regular interval.</p>
		
			<div class="panel panel-default">
			<div class="panel-heading"><strong>Select Time Interval</strong></div> 
			<div class="panel-body">
				
				<form role="form" method="POST">
				<div class="form-group">
					<label for="intervalSelect">Select Time Interval:</label>
					
					<select class="form-control" name="dbSelect">
						<option value="/home/ankit/Dropbox/PGY1_Dropbox/QI_Project/tempLog/tempLogDB.db" <?php if ($_POST['dbSelect'] == "tempLogDB.db") echo 'selected="selected" '; ?>>REDZONE Probe (DS18B20)</option>
						<option disabled="disabled" value="greenzoneOFFLINE.db" <?php if ($_POST['dbSelect'] == "greenzoneOFFLINE.db") echo 'selected="selected" '; ?>> GREENZONE Probe</option>
						<option disabled="disabled" value="bluezoneOFFLINE.db" <?php if ($_POST['dbSelect'] == "bluezoneOFFLINE.db") echo 'selected="selected" '; ?>>BLUEZONE Probe</option>
					</select> <br>
					
					<select class="form-control" name="deltaSelect">
						<option value=6 <?php if ($_POST['deltaSelect'] == 6) echo 'selected="selected" '; ?>>last 6 hours</option>
						<option value=12 <?php if ($_POST['deltaSelect'] == 12) echo 'selected="selected" '; ?>> last 12 hours</option>
						<option value=24 <?php if ($_POST['deltaSelect'] == 24) echo 'selected="selected" '; ?>>last 24 hours</option>
						<option value=720 <?php if ($_POST['deltaSelect'] == 720) echo 'selected="selected" '; ?>>last 30 days</option>
						<option value=8640 <?php if ($_POST['deltaSelect'] == 8640) echo 'selected="selected" '; ?>>last 12 months</option>
					</select> <br>
					<input type="submit" class="btn btn-primary" value="Graph Interval">	
				</div>
				</form>
				
					
			</div>
			</div>
			
			
			<div class="panel panel-default">
			<div class="panel-heading"><strong>Graph Results</strong></div> 
			<div class="panel-body" style="height:700px">	
					
				<div id="chart_div" style="width: 100%; height: 100%;"></div>
				
			</div>
			</div>
			
			<button class="btn btn-info" data-toggle="collapse" data-target="#showIntStats">Show Interval Statistics</button>
			
			<div id="showIntStats" class="collapse">
			
			<div class="panel panel-default">
			<div class="panel-heading"><strong>Interval Statistics</strong></div> 
			<div class="panel-body">
				<p class="bg-info"><strong>Range Statistics:</strong></p>	
				<p class="text-info">
				<?php
					$rzDB = new SQLite3($_POST['dbSelect']);
					$hoursBack = $_POST['deltaSelect'];
					
					$DBObject = $rzDB->query("SELECT timestamp,min(temp) FROM tempsTable WHERE timestamp>datetime('now','-".$hoursBack." hour')");
					
					while($row = $DBObject->fetchArray()){
						echo "Minimum Temperature: ".$row[1]." deg.C. on ".$row[0];
					}

					$DBObject = $rzDB->query("SELECT timestamp,max(temp) FROM tempsTable WHERE timestamp>datetime('now','-".$hoursBack." hour')");
					
					while($row = $DBObject->fetchArray()){
						echo "<br> Maximum Temperature: ".$row[1]." deg.C. on ".$row[0];
					}
				?>
				</p>
				
				
				<p class="bg-info"><strong>Critical Events</strong></p>
				
				<?php
					$rzDB = new SQLite3($_POST['dbSelect']);
					$hoursBack = $_POST['deltaSelect'];
					
					$DBObject = $rzDB->query("SELECT * FROM tempsTable WHERE timestamp>datetime('now','-".$hoursBack." hour')");
					
					while($row = $DBObject->fetchArray()){
						if($row[1] <= 2.0 or $row[1] >= 8.0){
							echo '<p class="bg-danger">'.$row[1].' deg. C. on '.$row[0].'</p>';	
						}
					}

					$DBObject = $rzDB->query("SELECT timestamp,max(temp) FROM tempsTable WHERE timestamp>datetime('now','-".$hoursBack." hour')");
					
					while($row = $DBObject->fetchArray()){
						echo "<br> Maximum Temperature: ".$row[1]." deg.C. on ".$row[0];
					}
				?>
				
				
			</div>
			</div>
		
			</div> <!--collapsible-->
		
			<br><br>
			
			<div class="panel panel-default">
			<div class="panel-heading">Safety Thresholds</div> 
			<div class="panel-body">
			<ul class="list-unstyled text-info">	
						<li class>Target Temperature Range: <strong>2–8 deg. C. </strong></li>
							<li>Warning Threshold: 2.0 – 2.5 or 7.5 – 8.0 deg. C. </li>
							<li>Critical Temperatures: <2.0 deg.C or >8.0 deg.C. </li>
					</ul></div>
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
    
    <script>
		google.load("visualization", "1", {packages:["corechart"]});
		google.setOnLoadCallback(drawChart);
		function drawChart() {
			var data = google.visualization.arrayToDataTable([
			<?php
			$rzDB = new SQLite3($_POST['dbSelect']);
			$hoursBack = $_POST['deltaSelect'];
			
			$DBObject = $rzDB->query("SELECT * FROM tempsTable WHERE timestamp>datetime('now','-".$hoursBack." hour')");
			
			
			$ChartData = "['Time', 'Temperature'],\n";
			
			while($row = $DBObject->fetchArray()){
				$ChartData .= "['".$row[0]."', ".$row[1]."],\n";
			}
			
			echo $ChartData."\n";
			
			?>
			]);
			
			var options = {
				hAxis: {title: 'Date/Time', textStyle:{fontSize: 11}, slantedTextAngle: 45},
				vAxis: {title: 'Temperature (deg. C.)', format: '0.00 C'},
				legend: {position: 'none'},
				chartArea: {'width': '80%', 'height': '70%'}
			};
			
			var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
			chart.draw(data, options);
		}					
		</script>
    
</body>

</html>
