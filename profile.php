<?php
session_start();
if (!isset($_SESSION['username'])) {
	echo "You are not logged in!<br/>";
	echo '<a href="./index.php">Return to Main Page</a>';
	die();
}
// MySQL username and password.
$MySQLusername = "cs3715_tb6774"; 
$MySQLpassword = "purplesilver7";

// Create database connection using PHP Data Object (PDO).
// When in MUN, make it  $db = new PDO("mysql:host=mysql.cs.mun.ca;dbname=cs3715_tb6774", $MySQLusername, $MySQLpassword);
$db = new PDO("mysql:host=mysql.cs.mun.ca;dbname=cs3715_tb6774", $MySQLusername, $MySQLpassword);

// Name of the table we are using for the database.
$MySQLtable = 'AccountInfo'; // testUserInfo

// Grabbing everything from the table

$userInfoTable = $db->query('SELECT * from '.$MySQLtable.' WHERE Username="'.$_SESSION['username'].'"');
$username = "Error retrieving username";
$password = "lolwut";
$pwins = "Error retrieving wins";
while($rows = $userInfoTable->fetch()) {
    $username = $rows[1];
    $pwins = $rows[3];
}
?>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="style.css">
	<script type="text/javascript">
		  var uname = "<?php echo $username ?>";
    var pword = "<?php echo $password ?>";
    var pwins = "<?php echo $pwins ?>";
    var prank = "Bronze";
		function getProfile() {
      if (pwins > 29) {
          prank = "Platinum";
      } else if (pwins > 19) {
          prank = "Gold";
      } else if (pwins > 9) {
          prank = "Silver";
      }
      document.getElementsByTagName('title')[0].innerHTML = uname +"'s Profile - QuickDraw";
      document.getElementById("name").innerHTML = uname + "'s Stats";
      document.getElementById("tablew").innerHTML = pwins;
      document.getElementById("tabler").innerHTML = prank;
		}
	</script>
</head>
<body onload="getProfile();">
	<div id="btndiv">
		<h1 id="name"></h1>
		<table>
			<tr>
				<th>Wins</th>
				<th>Rank</th>
			</tr>
			<tr>
				<td id="tablew" class="stats"></td>
				<td id="tabler" class="stats"></td>
			</tr>
		</table><br/>
		<a href="./index.php">Back to main page</a>
	</div>
</body>
</html>
