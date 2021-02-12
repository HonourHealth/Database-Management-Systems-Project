
<?php
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



$sql1 = "SELECT D.Cities FROM districtsandcities D ";
$result1 = mysqli_query($conn,$sql1) or die("Error in sql1");

if (mysqli_num_rows($result1) > 0) {
    // output data of each row ShowCitySalesInformation.php
	echo "<form action='ShowCitySalesInformation.php' method='post'>";
	echo '<select name="city_info">';
    while($row = mysqli_fetch_array($result1)) {
		echo "<option value='" . $row["Cities"] . "'>";
        echo $row["Cities"];
		echo "</option>";
    }
	echo '</select>';
	echo '<input type="submit" value="Submit">';
	echo "</form>";
} else {
    echo "0 results";
}


$sql = "SELECT distinct (M.market_name),COUNT(S.product_id) as Totalsale FROM sale S INNER JOIN markets M ON S.market_id = M.market_id INNER JOIN districtsandcities D ON D.city_id = S.city_id "; 
$sql .= "WHERE S.city_name = '" . $_POST['city_info'] . "' GROUP BY M.market_id"; 

$result = mysqli_query($conn,$sql) or die("Error in sql");

if (mysqli_num_rows($result) > 0) {
    // output data of each row
	echo "<table border='1'>";
	echo "<tr><td>Market Name</td><td>Total Sale</td></tr>";
    while($row = mysqli_fetch_array($result)) {
		echo "<tr>";
        echo "<td>" . $row["market_name"]. "</td><td>" . $row["Totalsale"]. "</td>";
		echo "</tr>";
    }
	echo "</table>";
} else {
    
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<!-- Add here progress bar if you can -->

</html>