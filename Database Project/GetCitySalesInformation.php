<!DOCTYPE html>
<html>
<body>
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

$sql1 = "SELECT distinct(D.Cities) FROM districtsandcities D ";
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

mysqli_close($conn);
?>

</body>
</html>