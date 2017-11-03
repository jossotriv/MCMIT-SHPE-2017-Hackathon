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
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>