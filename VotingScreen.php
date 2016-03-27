<?php
        // MySQL username and password.
	$MySQLusername = "cs3715_tb6774";  
	$MySQLpassword = "purplesilver7";
        
	// Create database connection using PHP Data Object (PDO).
	// When in MUN, make it  $db = new PDO("mysql:host=mysql.cs.mun.ca;dbname=cs3715_tb6774", $MySQLusername, $MySQLpassword);
	$db = new PDO("mysql:host=mysql.cs.mun.ca;dbname=cs3715_tb6774", $MySQLusername, $MySQLpassword);

	// Name of the table we are using for the database.
        $gameTable = 'Game_abc';

	// Grabbing everything from the table
        $gameTableInfo = $db->query('SELECT * FROM '.$gameTable);
        
        // Closing the database connection.
        $db = NULL;
        
        while($rows = $gameTableInfo->fetch()) {
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
