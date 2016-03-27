<?php
        // MySQL username and password.
	$MySQLusername = "root"; 
	$MySQLpassword = "root";
        $dataURL = "";
        
	// Create database connection using PHP Data Object (PDO).
	// When in MUN, make it  $db = new PDO("mysql:host=mysql.cs.mun.ca;dbname=cs3715_tb6774", $MySQLusername, $MySQLpassword);
	$db = new PDO("mysql:host=localhost;dbname=QuickDraw_Test", $MySQLusername, $MySQLpassword);

	// Name of the table we are using for the database.
	$accountTable = 'AccountInfo'; // testUserInfo
        $votingTable = 'VotingTest';

	// Grabbing everything from the table
	$accounts = $db->query('SELECT * from '.$accountTable);
        $votingInfo = $db->query('SELECT * FROM '.$votingTable);
        
        // Closing the database connection.
        $db = NULL;
        
        while($rows = $votingInfo->fetch()) {
            $image = str_replace("+", "%2B", $rows['CanvasString']);
            $image = urldecode($image);
            echo '<img height="400" src= "'.$image.'">';
        }
?>
<html>
    <head>
        <script type="text/javascript">
        </script>
        <title>Results</title>
    </head>
    <body>
    
    </body>
        
</html>