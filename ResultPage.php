<?php
        // MySQL username and password.
	$MySQLusername = "cs3715_tb6774"; 
	$MySQLpassword = "purplesilver7";

	// Create database connection using PHP Data Object (PDO).
	// When in MUN, make it  $db = new PDO("mysql:host=mysql.cs.mun.ca;dbname=cs3715_tb6774", $MySQLusername, $MySQLpassword);
	$db = new PDO("mysql:host=mysql.cs.mun.ca;dbname=cs3715_tb6774", $MySQLusername, $MySQLpassword);

        $game = "Game_abc";
        $winnerInfo = $db->query('SELECT Username,CanvasString, MAX(votes) FROM '.$game);
        
        while($rows = $winnerInfo->fetch()) {
            echo 'Winner is '.$rows[0].'!!!!!<br>';
            
            $image = str_replace("+", "%2B", $rows['CanvasString']);
            $image = urldecode($image);
            $un = $rows['Username'];
            echo '<img height="'.$imgHeight.'" id="'.$un.'" src="'.$image.'"><br>';
            echo $rows[0].' won with '.$rows[2].' votes';
            
            if ($_SESSION['username'] == $rows[0]) {
                $addWin = 'UPDATE AccountInfo SET WINS=WINS+1 WHERE Username="'.$rows[0].'"';
                if ($db->query($addWin) == TRUE) {
                    echo "<br> Joining as Player1<br>";
                } else {
                    echo "<br> Can't Join as Player1 ".$db->error;
                }
            }
        }
        
        $gameTable = "SESSIONVariable";
        $dropTable = "DROP TABLE IF EXISTS ".$gameTable;
        
        // Creating the random table
        if ($db->query($dropTsable) == TRUE) {
            echo "Drop table successfully";
        } else {
            echo "Error dropping table: " . $db->error;
        }
        
        echo '<a href="./index1.php">Back to Main Page</a>';
?>
