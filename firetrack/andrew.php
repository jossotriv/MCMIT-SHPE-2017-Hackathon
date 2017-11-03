<!DOCTYPE HTML>
<html>
<head>  
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "Andrew"
	},
	axisY:{
		includeZero: false
	},
	data: [{        
		type: "line",       
		dataPoints: [
			{ y: 140, x:5},
			{ y: 145, x:10},
			{ y: 160, x:15, indexLabel: "highest",markerColor: "red", markerType: "triangle" },
			{ y: 135, x:20},
			{ y: 122, x:25},
			{ y: 140, x:30},
			{ y: 141, x:35},
			{ y: 155, x:40},
			{ y: 120, x:45, indexLabel: "lowest",markerColor: "DarkSlateGrey", markerType: "cross" },
			{ y: 129, x:50},
			{ y: 138, x:55},
			{ y: 146, x:60}
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