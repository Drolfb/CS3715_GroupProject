<?php
session_start();
// Grabbing the information the user types in the username and password
$inputUsername = $_POST["username"];
$inputPassword = $_POST["password"];
$isSafe = false;
if (!preg_match('/[^A-Za-z0-9.#\\-$]/', $inputUsername) || !preg_match('/[^A-Za-z0-9.#\\-$]/', $inputPassword)) {
    echo "<p>Input is limited to numbers, letters, and underscores ( _ ).</p>";
} else {
    $isSafe = true;
}
$duplicateUsername = false;
$insertionCode ="";

// MySQL username and password.
$MySQLusername = "cs3715_tb6774"; 
$MySQLpassword = "purplesilver7";

// Create database connection using PHP Data Object (PDO).
// When in MUN, make it  $db = new PDO("mysql:host=mysql.cs.mun.ca;dbname=cs3715_tb6774", $MySQLusername, $MySQLpassword);
$db = new PDO("mysql:host=mysql.cs.mun.ca;dbname=cs3715_tb6774", $MySQLusername, $MySQLpassword);
        
// Name of the table we are using for the database.
$MySQLtable = 'testUserInfo';

// Grabbing everything from the table
$userInfoTable = $db->query('SELECT * from '.$MySQLtable); 


// Run through the MySQL table  and compare it with the user's input data
// to check for username duplicates.
while($rows = $userInfoTable->fetch()) {
    // echo "rows[0]=" . $rows[0] . " rows[1]=" . $rows[1] . " rows[2]=" . $rows[2] . "<br>";
    if (($rows[1] == $inputUsername)) {
        $duplicateUsername = true; 
        break;
    }
}
        
if (!$duplicateUsername) {
    $insertionCode = "INSERT INTO UserInfo VALUES(NULL, '". $inputUsername . "', '" . $inputPassword . "')";
    if ($db->query($insertionCode) == TRUE) {
        echo "New Record created Successfully";
    }
    else {
        echo "Error in creating record<br>";
    }
}
else {
    echo "Username taken";
}
        
$db = NULL; // Closing the database connection.
?>