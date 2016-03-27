<?php
	session_start();

	// MySQL username and password.
	$MySQLusername = "root"; 
	$MySQLpassword = "root";

	// Create database connection using PHP Data Object (PDO).
	// When in MUN, make it  $db = new PDO("mysql:host=mysql.cs.mun.ca;dbname=cs3715_tb6774", $MySQLusername, $MySQLpassword);
	$db = new PDO("mysql:host=localhost;dbname=QuickDraw_Test", $MySQLusername, $MySQLpassword);

        $randomTableName = substr(uniqid('', true), -8); // Creating the room name.
        echo "The following is an unique ID <br><span id=\"roomIDspan\">";
        echo "$randomTableName" + "</span>";
        
        // MySQL code to create the unique string table.
        $createRandomTable = "CREATE TABLE Game_$randomTableName (Game_"
        .$randomTableName."_ID INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, "
                . "Username VARCHAR(10) NOT NULL UNIQUE, "
                . " FOREIGN KEY (Username) REFERENCES AccountInfo(Username))";
        // MySQL code to drop the table.
        $dropRandomTable = "DROP TABLE IF EXISTS Game_".$randomTableName;
        
        echo "<br>".$createRandomTable."<br>";
        
        // Creating the random table
        if ($db->query($createRandomTable) == TRUE) {
            echo "Random Table was created successfully";
        } else {
            echo "Error creating table: " . $db->error;
        }
        
        // Dropping the table
        if ($db->query($dropRandomTable) == TRUE) {
            echo "Random Table was dropped successfully";
        } else {
            echo "Error dropping table: " . $db->error;
        }
        
        // Closing the database connection.
	$db = NULL;
?>