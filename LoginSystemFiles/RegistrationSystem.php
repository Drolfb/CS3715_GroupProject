<?php
        session_start();
        // Grabbing the information the user types in the username and password
        $inputUsername = $_POST["username"];
        $inputPassword = $_POST["password"];
        $duplicateUsername = false;
        $insertionCode ="";
    
        // MySQL username and password.
        $MySQLusername = root; // cs3715_tb6774
        $MySQLpassword = root; //purplesilver7
        
        // Create database connection using PHP Data Object (PDO).
        // When in MUN, make it  $db = new PDO("mysql:host=mysql.cs.mun.ca;dbname=cs3715_tb6774", $MySQLusername, $MySQLpassword);
        $db = new PDO("mysql:host=localhost;dbname=QuickDraw_Test", $MySQLusername, $MySQLpassword);
        
        // Name of the table we are using for the database.
        $MySQLtable = 'UserInfo'; // testUserInfo

        // Grabbing everything from the table
        $userInfoTable = $db->query('SELECT * from '.$MySQLtable); 
        
            
        // Run through the MySQL table  and compare it with the user's input data
        // to check for username duplicates.
        while($rows = $userInfoTable->fetch()) {
            // echo "rows[0]=" . $rows[0] . " rows[1]=" . $rows[1] . " rows[2]=" . $rows[2] . "<br>";
            if (($rows[1] == $inputUsername)) {
                // header("Location:ExamplePage.html");
                $duplicateUsername = true; 
                break;
            }
        }
        
        if (!$duplicateUsername) {
            echo "Not duplicate<br>";
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
        
        // Closing the database connection.
        $db = NULL;
echo '<html>';
echo    '<head>';
echo       '<title>Project Login System</title>';
echo    '</head>';
echo    '<body>';
            // Using POST to get user information in a secure matter
echo        '<form action="RegistrationSystem.php" method="post">';
echo            '<label>Choose an username: </label><br>';
echo            '<input type="text" name="username"><br>';
echo            '<label>Create a password: </label><br>';
echo            '<input type="text" name="password"><br>';
echo            '<input type="submit" value="Log In">';
echo        '</form>';
echo    '</body>';
echo '</html>';    
?>