<?php
// get the q parameter from URL
$q = $_REQUEST["q"];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "zNwk";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT Temp FROM rTab WHERE Id = $q";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
     
     // output data of each row
	 $phpstring = "w3-btn w3-disabled w3-red";
	 $phparray = array();
     while($row = $result->fetch_assoc()) {
		 $ti = $row["Id"];
         echo $row["Temp"];
     }
     
} else {
     echo "0 results";
}
$conn->close();


?> 