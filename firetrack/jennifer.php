<!DOCTYPE HTML>
<html>
<head>  
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "Jennifer"
	},
	axisY:{
		includeZero: false
	},
	data: [{        
		type: "line",       
		dataPoints: [
			{ y: 122, x: 5 },
			{ y: 138, x: 10},
			{ y: 135 , x:15},
			{ y: 180, x:20, indexLabel: "WARNING VITAL - TOO HIGH",markerColor: "red", markerType: "triangle" },
			{ y: 122, x:25},
			{ y: 170, x:30},
			{ y: 174, x:40},
			{ y: 188, x:45, indexLabel: "WARNING VITAL - TOO HIGH 2nd OCCURANCE",markerColor: "red", markerType: "triangle" },
			{ y: 160, x:50},
			{ y: 166, x:55},
			{ y: 164, x:60},
			{ y: 154, x:65}
		]
	}]
});
chart.render();

}
</script>
</head>
<?php
include 'css/style.php';
?>
<body class=" w3-content" style="max-width:1600px">

<!-- Sidebar/menu -->
<?php
include 'css/navbars.php';
?>

<!-- Top menu on small screens -->
<header class="w3-container w3-top w3-hide-large w3-white w3-xlarge w3-padding-16">
  <span class="w3-left w3-padding">LOGO</span>
  <a href="javascript:void(0)" class="w3-right w3-button w3-white" onclick="w3_open()">☰</a>
</header>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px; background-color: #990000; color: white">

  <!-- Push down content on small screens --> 
  <div class="w3-hide-large" style="margin-top:83px"></div>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
<!-- Footer -->
  <footer class="w3-container w3-padding-32" style="background-color: #990000; color: white">  
    <div class="w3-row-padding">
        <h3><b>Manage your teams vitals</b></h3>
        <h6>Click their box to see their stats for this mission.
        <br><br>
        <a href="team1.php"><button>Go Back</button></a>     
    
     </h6>
    </div>
  </footer>
</html>