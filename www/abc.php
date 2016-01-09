<?php
session_start();
include_once 'dbconnect.php';

if(!isset($_SESSION['user']))
{
 header("Location: index.php");
}
$res=mysql_query("SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$userRow=mysql_fetch_array($res);
?>


<?php
$page = $_SERVER['PHP_SELF'];
$sec = "60";
?>

<!DOCTYPE html>
<html>
<title>W3.CSS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
<link rel="stylesheet" href="/w3.css">
<!--body class="w3-container"-->
<body>
<script>
function displayCell(Id){
	window.alert(Id);
}

function getSQLRow(Id){
	var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                //document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
                //window.alert(xmlhttp.responseText);
				document.getElementById('id01').style.display='block';
			}
        };
        xmlhttp.open("GET", "getSQL.php?q=" + Id, true);
        xmlhttp.send();
}
</script>
<header class="w3-container w3-red">
<h1 class="w3-animate-opacity w3-jumbo">LiOA Electrics</h1>
</header>
<hr>
<div class="w3-row"> <!-- start ROW -->
<div class="w3-col l4"> <!-- start Column -->
<div class="w3-row"> <!-- start sub ROW -->
<div class="w3-containner w3-padding">
<table class="w3-table w3-striped w3-card-8 w3-bordered w3-border">
<tr><th>Name</th><th>Age</th></tr>
<tr><td>Toan</td><td>22</td></tr>
<tr><td>Kae</td><td>21</td></tr>
</table>
</div>


</div> <!-- end of sub row -->
<div class="w3-containner w3-padding">
<div class="w3-image w3-card-12">
<div class="w3-row">
<img src="ngoc.jpg">
</div>
</div> <!-- end of second sub row -->
</div> <!-- end of second sub containner -->
</div><!-- end of first column -->
<div class="w3-col l8"> <!-- start of second column -->
<div class="w3-containner w3-padding">
<table class="w3-table w3-striped w3-card-8 w3-bordered w3-border">
<tr><th>Id</th><th>LQI</th><th>Temperature</th><th>Time</th><th><button onclick="document.getElementById('id01').style.display='block'" class="w3-btn w3-red">+</button></th></tr>

<!-- PHP table -->
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
}

$sql = "SELECT Id, LQI, Temp, time FROM rTab GROUP BY Id DESC LIMIT 11";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
     
     // output data of each row
	 $phpstring = "w3-btn w3-disabled w3-red";
	 $phparray = array();
     while($row = $result->fetch_assoc()) {
		 $ti = $row["Id"];
         echo "<tr><td>" . $row["Id"]. "</td><td>" . $row["LQI"]. "</td><td>" . $row["Temp"]. 
		 "</td><td>" .$row["time"] . "</td><td><button onclick= \"getSQLRow($ti)\" name='$id'>Bao tri</button></td></tr>";
     }
     
} else {
     echo "0 results";
}
$conn->close();
?>  
<!-- End of PHP table -->
</table>
</div>
</div> <!-- end of second column -->
</div> <!--end row -->

<!-- Modal -->
<div id="id01" class="w3-modal">
  <div class="w3-modal-content">
    <header class="w3-container w3-teal"> 
      <span onclick="document.getElementById('id01').style.display='none'" 
      class="w3-closebtn">-</span>
      <h2>Modal Header</h2>
    </header>
    <div class="w3-container">
      <div class="w3-input-group">
        <label class="w3-label">User Name</label>
        <input class="w3-input w3-border" type="text">
      </div>
      <div class="w3-input-group">
        <label class="w3-label">Password</label>
        <input class="w3-input w3-border" type="password">
      </div>
    </div>
    <footer class="w3-container w3-teal">
      <p>Modal Footer</p>
    </footer>
  </div>
</div>
<!-- end of Modal -->


<footer class="w3-container w3-red w3-margin-top">
  <h5>Footer</h5>
  <p>Footer information goes here</p>
</footer>


</body>
</html> 