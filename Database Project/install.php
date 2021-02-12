<!DOCTYPE html>
<html>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "mysql";


// Create connection
$conn = mysqli_connect($servername, $username, $password);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} 

    // output data of each row
	echo "<form action='mygetcsv.php' method='post'>";
	echo '</select>';
	echo '<input type="submit" value="installation">';
	echo "</form>";
	
mysqli_close($conn);
?>

</body>
</html>