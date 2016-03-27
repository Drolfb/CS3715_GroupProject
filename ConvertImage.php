<?php
	session_start();

	// MySQL username and password.
	$MySQLusername = "root"; 
	$MySQLpassword = "root";
        
	// Create database connection using PHP Data Object (PDO).
	// When in MUN, make it  $db = new PDO("mysql:host=mysql.cs.mun.ca;dbname=cs3715_tb6774", $MySQLusername, $MySQLpassword);
	$db = new PDO("mysql:host=localhost;dbname=QuickDraw_Test", $MySQLusername, $MySQLpassword);

	// Name of the table we are using for the database.
	$MySQLtable = 'VotingTest'; // testUserInfo

	// Grabbing everything from the table
	// $votingTestTable = $db->query('SELECT * from '.$MySQLtable);
        
        $canvasString = urlencode($_POST['canvas']);
        echo "<script>console.log(".$canvasString.")</script>";
        $addCanvasString = "UPDATE ".$MySQLtable." SET CanvasString = '"
            .$canvasString."' WHERE USERNAME = 'Fred'";
       
        if ($db->query($addCanvasString) == TRUE) {
            echo "Canvas String was added successfully<br>";
        } else {
            echo "Error adding string: <br>" . $db->error;
        }
        
        // Closing the database connection.
	$db = NULL;
?>