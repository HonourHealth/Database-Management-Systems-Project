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

$sql = "CREATE DATABASE onurcan";
$result = mysqli_query($conn,$sql) or die("Error in sql");

mysqli_close($conn);

$dbname = "onurcan";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql1 = "CREATE TABLE districtsandcities(Cities VARCHAR(50),city_id INT,Districts VARCHAR(50),PRIMARY KEY(`city_id`))";
$sql2 = "CREATE TABLE markets(market_name VARCHAR(50),market_id INT,PRIMARY KEY(`market_id`))";
$sql3 = "CREATE TABLE salesman(salesman_id INT,salesman_name VARCHAR(50),market_name VARCHAR(50),PRIMARY KEY(`salesman_id`)
)";
$sql4 = "CREATE TABLE customers(customer_name VARCHAR(50),customer_id INT,PRIMARY KEY(`customer_id`))";
$sql5 = "CREATE TABLE products(product_name VARCHAR(50),product_id INT,PRIMARY KEY(`product_id`))";
$sql6 = "CREATE TABLE sale(product_name VARCHAR(50),product_id INT,customer_name VARCHAR(50),customer_id INT,salesman_id INT,salesman_name VARCHAR(50),city_id INT,market_id INT,sale_id INT NOT NULL AUTO_INCREMENT,PRIMARY KEY(`sale_id`),city_name VARCHAR(50),market_name VARCHAR(50),";
$sql6 .= "FOREIGN KEY (product_id) REFERENCES products (product_id),FOREIGN KEY (customer_id) REFERENCES customers (customer_id),FOREIGN KEY (salesman_id) REFERENCES salesman(salesman_id),FOREIGN KEY (city_id) REFERENCES districtsandcities(city_id),FOREIGN KEY (market_id) REFERENCES markets (market_id) )";


$result1 = mysqli_query($conn,$sql1) or die("Error in sql1");
$result2 = mysqli_query($conn,$sql2) or die("Error in sql2");
$result3 = mysqli_query($conn,$sql3) or die("Error in sql3");
$result4 = mysqli_query($conn,$sql4) or die("Error in sql4");
$result5 = mysqli_query($conn,$sql5) or die("Error in sql5");
$result6 = mysqli_query($conn,$sql6) or die("Error in sql6");


/* /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$sqldeneme = "INSERT INTO table_a (col1a, col2a, col3a, …) SELECT TOP (5) column_name FROM table_name ORDER BY RAND() LIMIT 1";

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */

	$row = 0;
	$filename = "TurkishFullNames1215.csv";
	$counter = 1;
	if(!file_exists($filename) || !is_readable($filename))
		return FALSE;
	
	if (($handle = fopen($filename, 'r')) !== FALSE)
	{
		
		while (($row = fgetcsv($handle, 1000, ';')) !== FALSE)
		{
			$sqlinsert = "INSERT INTO salesman (salesman_name,salesman_id) VALUES ('$row[0] $row[1]',$counter)";
			$counter = $counter + 1;
			$resultinsert = mysqli_query($conn,$sqlinsert) or die("Error in sqlinsert");
			
		}
		echo '</table>';
		fclose($handle);
	}
	
	$row = 0;
	$filename = "TurkishFullNames1620.csv";
	$counter = 1;
	if(!file_exists($filename) || !is_readable($filename))
		return FALSE;
	
	if (($handle = fopen($filename, 'r')) !== FALSE)
	{
		while (($row = fgetcsv($handle, 1000, ';')) !== FALSE)
		{
			$sqlinsert1 = "INSERT INTO customers (customer_name,customer_id) VALUES ('$row[0] $row[1]',$counter)";
			$counter = $counter + 1;
			$resultinsert1 = mysqli_query($conn,$sqlinsert1) or die("Error in sqlinsert1");
		}
		echo '</table>';
		fclose($handle);
	}

	$row = 0;
	$filename = "productlist.csv";
	$counter = 1;
	if(!file_exists($filename) || !is_readable($filename))
		return FALSE;
	
	if (($handle = fopen($filename, 'r')) !== FALSE)
	{
		while (($row = fgetcsv($handle, 1000, ';')) !== FALSE)
		{
			$sqlinsert2 = "INSERT INTO products (product_name,product_id) VALUES ('$row[0]',$counter)";
			$counter = $counter + 1;
			$resultinsert2 = mysqli_query($conn,$sqlinsert2) or die("Error in sqlinsert2");
		}
		echo '</table>';
		fclose($handle);
	}
	
	$row = 0;
	$filename = "marketnames.csv";
	$counter = 1;
	if(!file_exists($filename) || !is_readable($filename))
		return FALSE;
	
	if (($handle = fopen($filename, 'r')) !== FALSE)
	{
		while (($row = fgetcsv($handle, 1000, ';')) !== FALSE)
		{
			$sqlinsert3 = "INSERT INTO markets (market_name,market_id) VALUES ('$row[0]',$counter)";
			$counter = $counter + 1;
			$resultinsert3 = mysqli_query($conn,$sqlinsert3) or die("Error in sqlinsert3");
		}
		echo '</table>';
		fclose($handle);
	}
	
	$row = 0;
	$filename = "DistrictsAndCities.csv";
	if(!file_exists($filename) || !is_readable($filename))
		return FALSE;
	
	if (($handle = fopen($filename, 'r')) !== FALSE)
	{
		while (($row = fgetcsv($handle, 1000, ';')) !== FALSE)
		{
			
				$sqlinsert4 = "INSERT INTO districtsandcities (Cities,city_id,Districts) VALUES ('$row[0]','$row[1]','$row[2]')";
				$resultinsert4 = mysqli_query($conn,$sqlinsert4) or die("Error in sqlinsert4");
			
		}
		echo '</table>';
		fclose($handle);
	}

	$row = 0;
	$filename = "SaleDeneme.csv";
	if(!file_exists($filename) || !is_readable($filename))
		return FALSE;
	
	if (($handle = fopen($filename, 'r')) !== FALSE)
	{
		while (($row = fgetcsv($handle, 1000, ';')) !== FALSE)
		{
			
				$sqlinsert5 = "INSERT INTO sale (product_name,product_id,customer_name,customer_id,salesman_id,salesman_name,city_id,market_id,city_name,market_name) VALUES ('$row[0]','$row[1]','$row[2] $row[3]','$row[4]','$row[5]','$row[6] $row[7]','$row[8]','$row[9]','$row[11]','$row[12]')";
				$resultinsert5 = mysqli_query($conn,$sqlinsert5) or die("Error in sqlinsert5");
			
		}
		echo '</table>';
		fclose($handle);
	}


echo 'Installation Successfully Completed';
mysqli_close($conn);
?>