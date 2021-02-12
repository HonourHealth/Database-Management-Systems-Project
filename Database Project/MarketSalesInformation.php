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



$sql1 = "SELECT M.market_name FROM markets M "; //FOR CHOOSING MARKET (products)
$result1 = mysqli_query($conn,$sql1) or die("Error in sql1");

$sql2 = "SELECT P.product_name FROM products P "; //FOR PRODUCT BUTTON
$result2 = mysqli_query($conn,$sql2) or die("Error in sql2");

$sql3 = "SELECT S.salesman_name FROM sale SALE INNER JOIN salesman S ON SALE.salesman_id = S.salesman_id WHERE SALE.market_name = '" . $_POST['market_info'] . "' "; //FOR SALESMAN BUTTON
$result3 = mysqli_query($conn,$sql3) or die("Error in sql3");

$sql4 = "SELECT S.salesman_name FROM salesman S "; //FOR CHOOSE SALESMAN 
$result4 = mysqli_query($conn,$sql4) or die("Error in sql4");

$sql5 = "SELECT C.customer_name FROM sale SALE INNER JOIN customers C ON SALE.customer_id = C.customer_id WHERE SALE.market_name = '" . $_POST['market_info'] . "' "; //FOR CHOOSE CUSTOMER (INVOICE) 
$result5 = mysqli_query($conn,$sql5) or die("Error in sql5");

$sql7 = "SELECT C.customer_name FROM sale SALE INNER JOIN customers C ON SALE.customer_id = C.customer_id WHERE SALE.market_name = '" . $_POST['firstmarket_info'] . "' "; //FOR CHOOSE CUSTOMER (INVOICE) 
$result7 = mysqli_query($conn,$sql7) or die("Error in sql7");

$sql6 = "SELECT M.market_name FROM markets M "; //FOR CHOOSING MARKET (salesman)
$result6 = mysqli_query($conn,$sql6) or die("Error in sql6"); 

$sql8 = "SELECT S.salesman_name FROM sale SALE INNER JOIN salesman S ON SALE.salesman_id = S.salesman_id WHERE SALE.market_name = '" . $_POST['firstmarket_info'] . "' "; //FOR SALESMAN BUTTON
$result8 = mysqli_query($conn,$sql8) or die("Error in sql8");

///////////////////////////////////////////////////////////////////////////////////////// FOR SALESMAN AND MARKET

if (mysqli_num_rows($result6) > 0) {
    // output data of each row ShowCitySalesInformation.php
	// FOR CHOOSING MARKET OUR STARTING POINT
	echo "<form action='MarketSalesInformation.php' method='post'>";
	echo '<select name="firstmarket_info">';
    while($row = mysqli_fetch_array($result6)) {
		echo "<option value='" . $row["market_name"] . "'>";
        echo $row["market_name"];
		echo "</option>";
    }
			echo '<input type="submit" value="salesman">';
			
			
			echo "<form action='MarketSalesInformation.php' method='post'>";
			echo '<select name="salesman_info">';
			while($row = mysqli_fetch_array($result8)) {
				echo "<option value='" . $row["salesman_name"] . "'>";
				echo $row["salesman_name"];
				echo "</option>";
			}
			//FOR SALESMAN BUTTON WHICH SALESMAN HAS SOLD HOW MANY PRODUCTS
			echo "</form>";
			echo "<form action='MarketSalesInformation.php' method='post'>";
			echo '<input type="submit" value="choose salesman">';
			echo '</select>';
			echo "</form>";
	
	
	echo '</select>';
	
	echo "</form>";
	
	
	//FOR INVOICE--------------------------------------------------------
		
		// output data of each row ShowCitySalesInformation.php
		echo "<form action='MarketSalesInformation.php' method='post'>";
		echo '<select name="firstinvoice_info">';
		while($row = mysqli_fetch_array($result7)) {
			echo "<option value='" . $row["customer_name"] . "'>";
			echo $row["customer_name"]; 
			echo "</option>";
		}
		echo '</select>';
		echo '<input type="submit" value="invoice">';
		echo "</form>";
		
	//FOR INVOICE----------------------------------------------------------
	
} else {
    echo "0 results";
}



///////////////////////////////////////////////////////////////////////////////////////// FOR PRODUCT AND MARKET
if (mysqli_num_rows($result1) > 0) {
    // output data of each row ShowCitySalesInformation.php
	// FOR CHOOSING MARKET OUR STARTING POINT
	echo "<form action='MarketSalesInformation.php' method='post'>";
	//echo '<input type="submit" value="Select Market">';
	echo '<select name="market_info">';
    while($row = mysqli_fetch_array($result1)) {
		echo "<option value='" . $row["market_name"] . "'>";
        echo $row["market_name"];
		echo "</option>";
    }
			//FOR PRODUCT BUTTON WHICH PRODUCT HAS BEEN SOLD HOW MANY TIMES AND FOR SALESMAN BUTTON WHICH SALESMAN HAS SOLD HOW MANY PRODUCTS
			echo "<form action='MarketSalesInformation.php' method='post'>";
			echo '<input type="submit" value="product">';
			echo "</form>";
			// FOR CHOOSE SALESMAN ALL THE SALE INFORMATION OF THAT SALESMAN
			echo "<form action='MarketSalesInformation.php' method='post'>";
			echo '<select name="salesman_info">';
			while($row = mysqli_fetch_array($result3)) {
				echo "<option value='" . $row["salesman_name"] . "'>";
				echo $row["salesman_name"];
				echo "</option>";
			}
			//FOR SALESMAN BUTTON WHICH SALESMAN HAS SOLD HOW MANY PRODUCTS
			echo "</form>";
			echo "<form action='MarketSalesInformation.php' method='post'>";
			echo '<input type="submit" value="choose salesman">';
			echo '</select>';
			echo "</form>";
			
	echo '</select>';
	//echo '<input type="submit" value="Submit">';
	echo "</form>";
	//FOR INVOICE--------------------------------------------------------
		
		// output data of each row ShowCitySalesInformation.php
		echo "<form action='MarketSalesInformation.php' method='post'>";
		echo '<select name="invoice_info">';
		while($row = mysqli_fetch_array($result5)) {
			echo "<option value='" . $row["customer_name"] . "'>";
			echo $row["customer_name"]; 
			echo "</option>";
		}
		echo '</select>';
		echo '<input type="submit" value="invoice">';
		echo "</form>";
		
	//FOR INVOICE----------------------------------------------------------
} else {
    echo "0 results";
}



$sql66 = "SELECT S.salesman_name,COUNT(SALE.product_id) as Totalsale FROM sale SALE INNER JOIN salesman S ON SALE.salesman_id = S.salesman_id "; 
$sql66 .= "WHERE SALE.market_name = '" . $_POST['firstmarket_info'] . "' GROUP BY SALE.product_id"; 


$sql22 = "SELECT P.product_name,COUNT(SALE.product_id) as Totalsaleproduct FROM sale SALE INNER JOIN products P ON SALE.product_id = P.product_id ";
$sql22 .= "WHERE SALE.market_name = '" . $_POST['market_info'] . "' GROUP BY SALE.product_id";


$sql33 = "SELECT S.salesman_name,COUNT(SALE.product_id) AS Totalsalesbysalesman,S.salesman_id,P.product_name,P.product_id,C.customer_name,C.customer_id,CITY.city_id,M.market_name,M.market_id,SALE.sale_id,CITY.Cities FROM sale SALE INNER JOIN salesman S ON SALE.salesman_id = S.salesman_id INNER JOIN products P ON SALE.product_id = P.product_id INNER JOIN customers C ON SALE.customer_id = C.customer_id INNER JOIN markets M ON SALE.market_id = M.market_id INNER JOIN districtsandcities CITY ON SALE.city_id = CITY.city_id ";
$sql33 .= "WHERE SALE.salesman_name = '" . $_POST['salesman_info'] . "' GROUP BY SALE.product_id";


$sql55 = "SELECT C.customer_name,P.product_name FROM sale SALE INNER JOIN customers C ON SALE.customer_id = C.customer_id INNER JOIN products P ON SALE.product_id = P.product_id ";
$sql55 .= "WHERE SALE.customer_name = '" . $_POST['invoice_info'] . "' ";


$sql77 = "SELECT C.customer_name,P.product_name FROM sale SALE INNER JOIN customers C ON SALE.customer_id = C.customer_id INNER JOIN products P ON SALE.product_id = P.product_id ";
$sql77 .= "WHERE SALE.customer_name = '" . $_POST['firstinvoice_info'] . "' ";




$result55 = mysqli_query($conn,$sql55) or die("Error in sql55");

if (mysqli_num_rows($result55) > 0) {
    // output data of each row
	echo "<table border='1'>";
	echo "<tr><td>Customer Name</td><td>Product Name</td></tr>";
    while($row = mysqli_fetch_array($result55)) {
		echo "<tr>";
        echo "<td>" . $row["customer_name"]. "</td><td>" . $row["product_name"]. "</td>";
		echo "</tr>";
    }
	echo "</table>";
} else {
    
}

$result77 = mysqli_query($conn,$sql77) or die("Error in sql77");

if (mysqli_num_rows($result77) > 0) {
    // output data of each row
	echo "<table border='1'>";
	echo "<tr><td>Customer Name</td><td>Product Name</td></tr>";
    while($row = mysqli_fetch_array($result77)) {
		echo "<tr>";
        echo "<td>" . $row["customer_name"]. "</td><td>" . $row["product_name"]. "</td>";
		echo "</tr>";
    }
	echo "</table>";
} else {
    
}


$result66 = mysqli_query($conn,$sql66) or die("Error in sql66");

if (mysqli_num_rows($result66) > 0) {
    // output data of each row
	echo "<table border='1'>";
	echo "<tr><td>Salesman Name</td><td>Total Sale</td></tr>";
    while($row = mysqli_fetch_array($result66)) {
		echo "<tr>";
        echo "<td>" . $row["salesman_name"]. "</td><td>" . $row["Totalsale"]. "</td>";
		echo "</tr>";
    }
	echo "</table>";
} else {
    
}

$result22 = mysqli_query($conn,$sql22) or die("Error in sql22");

if (mysqli_num_rows($result22) > 0) {
    // output data of each row
	echo "<table border='1'>";
	echo "<tr><td>Product Name</td><td>Total Sale Product</td></tr>";
    while($row = mysqli_fetch_array($result22)) {
		echo "<tr>";
        echo "<td>" . $row["product_name"]. "</td><td>" . $row["Totalsaleproduct"]. "</td>";
		echo "</tr>";
    }
	echo "</table>";
} else {
    
}

$result33 = mysqli_query($conn,$sql33) or die("Error in sql33");

if (mysqli_num_rows($result33) > 0) {
    // output data of each row
	echo "<table border='1'>";
	echo "<tr><td>Salesman Name</td><td>Salesman ID</td><td>Total Sale By Salesman</td><td>Product Name</td><td>Product ID</td><td>Customer Name</td><td>Customer ID</td><td>City ID</td><td>Market ID</td><td>Sale ID</td><td>City Name</td><td>Market Name</td></tr>";
    while($row = mysqli_fetch_array($result33)) {
		echo "<tr>";
        echo "<td>" . $row["salesman_name"]. "</td><td>" . $row["salesman_id"]. "</td><td>" . $row["Totalsalesbysalesman"]. "</td><td>" . $row["product_name"]. "</td><td>" . $row["product_id"]. "</td><td>" . $row["customer_name"]. "</td><td>" . $row["customer_id"]. "</td><td>" . $row["city_id"]. "</td><td>" . $row["market_id"]. "</td><td>" . $row["sale_id"]. "</td><td>" . $row["Cities"]. "</td><td>" . $row["market_name"]. "</td><td>";
		echo "</tr>";
    }
	echo "</table>";
} else {
    
}

mysqli_close($conn);
?>


<!-- Add here progress bar if you can -->
</body>
</html>