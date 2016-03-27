<?php
session_start();

if (!isset($_SESSION['username'])) {
	echo "<script>alert(\"You are not logged in!\"); window.location('./index.php')</script>";
	die();
}

if (!isset($_GET[0])) {
	echo "Malformed request. Please return to the <a href=\"./index.php\">home page</a> and try again.";
}

$roomID = $_GET[0];

// MySQL username and password.
$MySQLusername = "root"; 
$MySQLpassword = "root";

// Create database connection using PHP Data Object (PDO).
// When in MUN, make it  $db = new PDO("mysql:host=mysql.cs.mun.ca;dbname=cs3715_tb6774", $MySQLusername, $MySQLpassword);
$db = new PDO("mysql:host=localhost;dbname=QuickDraw_Test", $MySQLusername, $MySQLpassword);

// Name of the table we are using for the database.
$MySQLtable = 'Rooms'; // testUserInfo

// Grabbing everything from the table

$room = $db->query('SELECT * from '.$MySQLtable' WHERE RoomID = '.$roomID);

// Closing the database connection.
$db = NULL;
while (true) {
	if ($room[1] != NULL && $room[2] != NULL && $room[3] != NULL) {
		//header("Location:BasicCanvas.php?roomID=".$roomID);	//GET request
		echo $roomID;
	}
	else if (connection_aborted()) {
		error_log ("Script was aborted by the user.");
		die();		//Breakpoint in case user closed the connection
	}
	else {
		sleep(5);	//Wait 5 seconds and check again for as long as they're willing to wait
	}
}
?>