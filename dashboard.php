  <html>
  <head>
  	
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart','controls']});
      google.charts.setOnLoadCallback(drawDashboard);

      function drawDashboard() {
      	var jsonData = $.ajax({
			url: 'line_chart.php',
    		dataType:"json",
    		async: false
			 }).responseText;
		alert (jsonData);
		var data = new google.visualization.DataTable(jsonData);	
 

		// Create a dashboard.
        var dashboard = new google.visualization.Dashboard(
            document.getElementById('dashboard_div'));

 		// Create a range slider, passing some options
        var donutRangeSlider = new google.visualization.ControlWrapper({
          'controlType': 'NumberRangeFilter',
          'containerId': 'filter_div',
          'options': {
            'filterColumnLabel': 'PostWeek',
			'minValue': 1,
     		'maxValue': 52
        	}
        });
		
		// Create a pie chart, passing some options
        var lineChart = new google.visualization.ChartWrapper({
          'chartType': 'LineChart',
          'containerId': 'chart_div',
          'options': {
            'width': 800,
            'height': 600
          }
        });
		
		// Establish dependencies, declaring that 'filter' drives 'pieChart',
        // so that the pie chart will only display entries that are let through
        // given the chosen slider range.
     
      dashboard.bind(donutRangeSlider, lineChart);

	  //  var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        dashboard.draw(data);	  		
		}
		 </script>
  </head>
  <body>
  <div id="dashboard_div">
    <div id="chart_div"></div>
	<div id="filter_div"></div>
  </div>
  </body>
</html>