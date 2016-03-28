<?php
	session_start();
        
        if (!isset($_SESSION['username'])) {
            echo "<script>alert(\"You are not logged in!\"); window.location('./index.php')</script>";
            die();
        }

        if (!isset($_GET['username'])) {
            echo "Malformed request. Please return to the <a href=\"./index.php\">home page</a> and try again.";
        }

	// MySQL username and password.
	$MySQLusername = "cs3715_tb6774"; 
	$MySQLpassword = "purplesilver7";

	// Create database connection using PHP Data Object (PDO).
	// When in MUN, make it  $db = new PDO("mysql:host=mysql.cs.mun.ca;dbname=cs3715_tb6774", $MySQLusername, $MySQLpassword);
	$db = new PDO("mysql:host=mysql.cs.mun.ca;dbname=cs3715_tb6774", $MySQLusername, $MySQLpassword);

        $rooms = "Rooms";
        
        $roomList = $db->query('SELECT * from '.$rooms);
        
        
        
        $roomsFull = true;
        $joinQuery = "";
        while($rows = $roomList->fetch()) {
            if (($rows[1] == NULL) || ($rows[2] == NULL) || ($rows[3] == NULL)) {
                $roomsFull = false;
                if ($rows[1] == NULL) {
                    $joinQuery = 'UPDATE '.$rooms.' SET Player1="'.$_SESSION['username'].'" WHERE Room_ID="'.$rows[0].'"';
                    if (rows[1] == $_SESSION['username']) { 
                        echo "Duplicate Name"; break; 
                    }
                    if ($db->query($joinQuery) == TRUE) {
                        echo "<br> Joining as Player1 with the following Room ID: <span id=\"roomIDspan\">".$rows[0]."</span><br>";
                    } else {
                        echo "<br> Can't Join as Player1 ".$db->error;
                    }
                } else if ($rows[2] == NULL) {
                    if ($rows[1] === $_SESSION['username']) { 
                        echo "<br>Duplicate Name<br>"; 
                    } else {
                        $joinQuery = 'UPDATE '.$rooms.' SET Player2="'.$_SESSION['username'].'" WHERE Room_ID="'.$rows[0].'"';
                        if ($db->query($joinQuery) == TRUE) {
                            echo "<br> Joining as Player2 with the following Room ID: <span id=\"roomIDspan\">".$rows[0]."</span><br>";
                        } else {
                            echo "<br> Can't Join as Player2 ".$db->error;
                        }
                    }
                } else if ($rows[3] == NULL) {
                    if ($rows[2] === $_SESSION['username']) { 
                        echo "Duplicate Name"; 
                    } else {
                        $joinQuery = 'UPDATE '.$rooms.' SET Player3="'.$_SESSION['username'].'" WHERE Room_ID="'.$rows[0].'"';
                    
                        if ($db->query($joinQuery) == TRUE) {
                            echo "<br> Joining as Player3 with the following Room ID: <span id=\"roomIDspan\">".$rows[0]."</span><br>";
                        } else {
                            echo "<br> Can't Join as Player3 ".$db->error;
                        }
                    }
                }
                break;
            }
            else
            {
                $roomsFull = true;
                echo "<br>All Games Full<br>";
            }
        }
        
        if ($roomsFull) {
            $user = "User";
            $randomTableName = substr(uniqid('', true), -8); // Creating the room name.
            echo "The following is an unique ID <br><span id=\"roomIDspan\">";
            echo "$randomTableName" + "</span>";
            $joinQuery = 'INSERT INTO '.$rooms.' Values("Game_'.$randomTableName.'","'.$_SESSION['username'].'", NULL, NULL)';
            if ($db->query($joinQuery) == TRUE) {
                echo "<br> Making a new game!!! <br>";
            } else {
                echo "<br> Can't Make a New Game ".$db->error;
            }
        }
        
        // Closing the database connection.
	$db = NULL;
?>
