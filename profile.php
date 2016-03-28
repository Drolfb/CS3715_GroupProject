<?php
session_start();
if (!isset($_SESSION['username'])) {
	echo "You are not logged in!<br/>";
	echo '<a href="./index.php">Return to Main Page</a>';
	die();
}
?>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="style.css">
	<script type="text/javascript">
		var uname = "<?php echo $_SESSION['username'] ?>";
		function getProfile() {
			var uw = 0;
			var ul = 1;
			var ratio = 0;
			var rank;
			if (ul === 0 && uw === 0) {
				ratio = 0;
			} else if (uw > 0 && ul === 0) {
				ratio = 100;
			} else {
				ratio = Math.round(uw/ul);
			}
			
			if (ratio < 20) {
				rank = "Bronze";
			} else if (ratio < 40) {
				rank = "Silver";
			} else if (ratio < 60) {
				rank = "Gold";
			} else if (ratio < 80) {
				rank = "Platinum";
			} else {
				rank = "Diamond";
			}

			document.getElementsByTagName('title').innerHTML = uname +"'s Profile - QuickDraw";
			document.getElementById("name").innerHTML = uname + "'s Stats";
			document.getElementById("tablew").innerHTML = "No wins";
			document.getElementById("tablel").innerHTML = "No losses";
			document.getElementById("tablep").innerHTML = ratio;
			document.getElementById("tabler").innerHTML = rank;
		}
	</script>
</head>
<body onload="getProfile();">
	<div id="btndiv">
		<h1 id="name"></h1>
		<table>
			<tr>
				<th>Wins</th>
				<th>Losses</th>
				<th>W/L Ratio</th>
				<th>Rank</th>
			</tr>
			<tr>
				<td id="tablew" class="stats"></td>
				<td id="tablel" class="stats"></td>
				<td id="tablep" class="stats"></td>
				<td id="tabler" class="stats"></td>
			</tr>
		</table><br/>
		<a href="./index.php">Back to main page</a>
	</div>
</body>
</html>