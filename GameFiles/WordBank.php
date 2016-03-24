<?php
        session_start();
    
        // MySQL username and password.
        $MySQLusername = root; // cs3715_tb6774
        $MySQLpassword = root; //purplesilver7
        
        // Create database connection using PHP Data Object (PDO).
        // When in MUN, make it  $db = new PDO("mysql:host=mysql.cs.mun.ca;dbname=cs3715_tb6774", $MySQLusername, $MySQLpassword);
        $db = new PDO("mysql:host=localhost;dbname=QuickDraw_Test", $MySQLusername, $MySQLpassword);
        
        // Name of the table we are using for the database.
        $MySQLtable = 'WordBank'; // testUserInfo

        // Grabbing everything from the table
        $WordBank = $db->query('SELECT * from '.$MySQLtable. ' order by RAND() LIMIT 1');
        
        
        // Closing the database connection.
        $db = NULL;
            
        // Run through the MySQL table  and compare it with the user's input data. 
        while($rows = $WordBank->fetch()) {
            echo "rows[0]=" . $rows[0] . " rows[1]=" . $rows[1] . " rows[2]=" . $rows[2] . "<br>";
            
        }
echo '<html>';
echo    '<head>';
echo       '<title>Project Login System</title>';
echo    '</head>';
echo    '<body>';
echo    '</body>';
echo '</html>';    
?>
