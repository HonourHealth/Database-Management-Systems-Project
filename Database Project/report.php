<?php

	$row = 0;
	$filename = "SaleDeneme.csv";
	$i = -1;

	if(!file_exists($filename) || !is_readable($filename))
		return FALSE;
	
	$header = NULL;
	if (($handle = fopen($filename, 'r')) !== FALSE)
	{
		while (($row = fgetcsv($handle, 1000, ';')) !== FALSE)
		{
			if(!$header)
				$header = $row;
			else{
				$dataCSV[$i] = $row;
			}
			$i++;
		}
		fclose($handle);
	}

$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "onurcan";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} 


$sql = "SELECT M.market_name,COUNT(SALE.product_id) as Totalsaleproduct FROM sale SALE INNER JOIN products P ON SALE.product_id = P.product_id INNER JOIN markets M ON SALE.market_id = M.market_id ";
$sql .= "GROUP BY SALE.product_id";

$result = mysqli_query($conn,$sql) or die("Error in sql");
$j = -1;
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_array($result)) {
		echo "<tr>";
        //echo "<td>" . $row["Totalsaleproduct"]. "</td>";
		$dataCSV2[$j] = $row["Totalsaleproduct"];
		echo "</tr>";
		$j++;
    }
	echo "</table>";
} else {
    
}



?>




<!DOCTYPE html>
<html>
	<head>
		<title>CHART REPORT</title>
	</head>
	<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
	<body>
		<div id="chartContainer" style="height: 300px; width: 100%;"></div>
	</body>
	<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "Sales Divided Into Markets"
	},
	axisY:{
		includeZero: false
	},
	data: [{        
		
		type: "pie",       
		dataPoints: [
		<?for($i = 0; $i<10;$i++) {	
			if($i!=9) {
				echo "{label:'".$dataCSV[$i][12]."', y:".$dataCSV2[$i][0].'},';
			}else {
				echo "{label:'".$dataCSV[$i][12]."', y:".$dataCSV2[$i][0].'}'; 
			}
		}?>
		]
	}]
});
chart.render();

}
</script>


</html>
<??>
