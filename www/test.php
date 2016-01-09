<!DOCTYPE html>
<html>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">

<head>
<style>
table, th, td {
     border: 1px solid black;
}
</style>

</head>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "zNwk";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
	 echo "connect fail";
}

$sql = "SELECT Id, LQI, Temp, time FROM rTab GROUP BY Id DESC LIMIT 10";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
     echo "<table><tr><th>ID</th><th>LQI</th><th>Tempepature</th><th>time</th></tr>";
     // output data of each row
     while($row = $result->fetch_assoc()) {
         echo "<tr><td>" . $row["Id"]. "</td><td>" . $row["LQI"] . "</td><td>" . $row["Temp"] . "</td><td>" . $row["time"] . "</td></tr>";
     }
     echo "</table>";
} else {
     echo "0 results";
}

$conn->close();
?>  

</body>
</html>