<?php
// MySQL username and password.
$MySQLusername = "cs3715_tb6774";  
$MySQLpassword = "purplesilver7";

// Create database connection using PHP Data Object (PDO).
// When in MUN, make it  $db = new PDO("mysql:host=mysql.cs.mun.ca;dbname=cs3715_tb6774", $MySQLusername, $MySQLpassword);
$db = new PDO("mysql:host=mysql.cs.mun.ca;dbname=cs3715_tb6774", $MySQLusername, $MySQLpassword);

// Name of the table we are using for the database.
$gameTable = 'Game_abc';
$uname = $_GET['uname'];

$addVote = 'UPDATE '.$gameTable.' SET Votes=Votes + 1 WHERE Username="'.$uname.'"';
if ($db->query($addVote) == TRUE) {
    echo "Updated count for $uname";
} else {
    echo "Not poop oh noe".$db->error;
}
?>