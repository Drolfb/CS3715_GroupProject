<?php
        session_start();
    
        // MySQL username and password.
        $MySQLusername = "cs3715_tb6774";
        $MySQLpassword = "purplesilver7";
        
        $randomSentence = "";
        
        // Create database connection using PHP Data Object (PDO).
        // When in MUN, make it  $db = new PDO("mysql:host=mysql.cs.mun.ca;dbname=cs3715_tb6774", $MySQLusername, $MySQLpassword);
        $db = new PDO("mysql:host=mysql.cs.mun.ca;dbname=cs3715_tb6774", $MySQLusername, $MySQLpassword);
        
        // Name of the table we are using for the database.
        $MySQLtable = 'WordBank';

        // Grabbing everything from the table
        $randomWord1 = $db->query('SELECT Words from '.$MySQLtable. ' ORDER BY RAND() LIMIT 1');
        $randomWord2 = $db->query('SELECT Words from '.$MySQLtable. ' ORDER BY RAND() LIMIT 1');
        
        
        // Closing the database connection.
        $db = NULL;
            
        // Run through the MySQL table  and compare it with the user's input data. 
        while($rows = $randomWord1->fetch()) {
//            echo "$rows[0] ";
            $randomSentence = $rows[0] . " ";
        }
        
        while($rows = $randomWord2->fetch()) {
//            echo " $rows[0] <br>";
            $randomSentence = $randomSentence . $rows[0];
            
        }
        
        echo "$randomSentence";
?>
