@extends('admin.template.main')

@section('title','Inicio')

@section('content')

<h1>Hola Mundo!</h1>
<div style="width: 40%; height: 40%;">
	<canvas id="myChart" style="width: 100%; height: auto;"></canvas>
	<div id="js-legend" class="chart-legend"></div>
</div>

<div>
	<canvas id="lineChart" width="800" height="250"></canvas>
	<div id="line-legend" class="chart-legend"></div>
</div>

<div>
	<canvas id="radarChart" width="400" height="650"></canvas>
	<div id="radar-legend" class="chart-legend"></div>
</div>



<script type="text/javascript">

// Donuts Chart

	var data1 = <?php echo json_encode($chart['chart1']); ?>;
	var data = [];

	for (var i = 0; data1.length > i; i++) {
		data.push({
		    value: data1[i][0],
		    color: data1[i][1],
		    label: data1[i][2]
			});
	}

	var options = {
	    segmentShowStroke: false,
	    animateRotate: true,
	    animateScale: false,
	    percentageInnerCutout: 50,
	    tooltipTemplate: "<%= value %>%"
	}

	var ctx = document.getElementById("myChart").getContext("2d");
	var myChart = new Chart(ctx).Doughnut(data, options);
	document.getElementById('js-legend').innerHTML = myChart.generateLegend();

// Line Chart

//line chart data
	var data2 = <?php echo json_encode($chart['chart2']); ?>;
	var datasets_asset = [];

	for (var i = 0; data2.length > i; i++) {
		datasets_asset.push({
		    label: data2[i][0],
	        fillColor: "rgba(255,255,255,0)",
	        strokeColor: data2[i][1],
	        pointColor: data2[i][1],
	        pointStrokeColor: "#fff",
	        data: data2[i][2]
			});
	}

var lineData = {
    labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
    datasets: datasets_asset
}

var lineOptions = {
    animation: true,
    pointDot: true,
    scaleOverride : true,
    scaleShowGridLines : false,
    scaleShowLabels : true,
    scaleSteps : 4,
	scaleStepWidth : 25,
	scaleStartValue : 25,
};

//Create Line chart
var ctx2 = document.getElementById("lineChart").getContext("2d");
var myNewChart = new Chart(ctx2).Line(lineData, lineOptions);
document.getElementById('line-legend').innerHTML = myNewChart.generateLegend();


//Create Radar chart
var ctx2 = document.getElementById("radarChart").getContext("2d");
var myNewChart = new Chart(ctx2).Radar(lineData);

</script>

@endsection
