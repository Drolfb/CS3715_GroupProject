<?php
session_start();	
	// Grabbing the information the user types in the username and password
$inputUsername = $_POST["username"];
$inputPassword = $_POST["password"];
$cookieName = "QuickDrawLogin";
//if (preg_match("^[0-9A-Za-z_]+$", $inputUsername) == 0) {
//    echo "<p>Usernames are limited to numbers, letters, and underscores ( _ ).</p>";
//}

// MySQL username and password.
$MySQLusername = "cs3715_tb6774"; 
$MySQLpassword = "purplesilver7";

// Create database connection using PHP Data Object (PDO).
// When in MUN, make it  $db = new PDO("mysql:host=mysql.cs.mun.ca;dbname=cs3715_tb6774", $MySQLusername, $MySQLpassword);
$db = new PDO("mysql:host=mysql.cs.mun.ca;dbname=cs3715_tb6774", $MySQLusername, $MySQLpassword);

// Name of the table we are using for the database.
$MySQLtable = 'AccountInfo'; // testUserInfo

// Grabbing everything from the table

$userInfoTable = $db->query('SELECT * from '.$MySQLtable);

// Closing the database connection.
$db = NULL;

// Run through the MySQL table  and compare it with the user's input data. 
while($rows = $userInfoTable->fetch()) {
    // echo "rows[0]=" . $rows[0] . " rows[1]=" . $rows[1] . " rows[2]=" . $rows[2] . "<br>";
    //if (($rows[1] == $inputUsername) && ($rows[2] == $inputPassword)) {
    if (($rows[1] == $inputUsername) && ($rows[2] == $inputPassword)) {
        echo "You are logged in!<br>";

        // setcookie("QuickDrawLogin", $inputUsername, time()+1800, "/"); //Expires in half an hour
        //echo "Cooker is: ".$_COOKIE["QuickDrawLogin"];
        setcookie($cookieName,$inputUsername,time()+3600);
        $_SESSION['username'] = $inputUsername;  //Passing this stuff to session values now, so no header change
        break;									 //... which means we now have to manually halt the loop  - Brian
    }
// header("Location:LoginSystem.php");
}
if (!isset($_SESSION['username'])) { //Necessary because AJAX means we can't just navigate away from this page  - Brian
    echo "Wrong username or password. Please try again.";
}	//This last if statement is never reached. We need a way to terminate the while loop when the table is exhausted.
?>
