// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
function addPieData(dataArr){
	myPieChart.data.datasets.forEach((dataset) =>{
		dataset.data = dataArr;
	})
	myPieChart.update();
}
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Positive", "Negative"],
    datasets: [{
		data:[
	  	<?php
		$conn = mysqli_connect("localhost", "root", "123456", "maru", "3307");
		$query= mysqli_query($conn, "SELECT COUNT(CASE WHEN sentiment = 1 THEN 1 END) AS data1 FROM BLOG_comm;");
		while($row=mysqli_fetch_array($query)){
			echo $row[data1].', ';
		}
		$query= mysqli_query($conn, "SELECT COUNT(CASE WHEN sentiment = -1 THEN 1 END) AS data1 FROM BLOG_comm;");
		while($row=mysqli_fetch_array($query)){
			echo $row[data1];
		}
		?>
		],
      backgroundColor: ['#4e73df', '#c4163e', '#36b9cc'],
      hoverBackgroundColor: ['#2e59d9', '#a61738', '#2c9faf'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});
