<?php
session_start();
        // MySQL username and password.
	$MySQLusername = "cs3715_tb6774"; 
	$MySQLpassword = "purplesilver7";

	// Create database connection using PHP Data Object (PDO).
	$db = new PDO("mysql:host=mysql.cs.mun.ca;dbname=cs3715_tb6774", $MySQLusername, $MySQLpassword);

$game = $_SESSION['roomID'];
$winnerInfo = $db->query('SELECT Username,CanvasString, MAX(votes) FROM '.$game);
$imgHeight = 200;
while($rows = $winnerInfo->fetch()) {
    echo 'Winner is '.$rows[0].'!<br>';

    $image = str_replace("+", "%2B", $rows['CanvasString']);
    $image = urldecode($image);
    $un = $rows['Username'];
    echo '<img height="'.$imgHeight.'" id="'.$un.'" src="'.$image.'"><br>';
    echo $rows[0].' won with '.$rows[2].' votes';
    

    if ($_SESSION['username'] == $rows[0]) {
        $addWin = 'UPDATE AccountInfo SET WINS=WINS+1 WHERE Username="'.$rows[0].'"';
        if ($db->query($addWin) == TRUE) {
            echo "<br>A win has been logged for $rows[0]<br>";
        } else {
            echo "<br>Help. Help.".$db->error;
        }
    }
}
$db = NULL;
echo '<meta http-equiv="refresh" content="10;url=http://localhost/my-site/index.php"/>';
unset($_SESSION['roomID']);
?>
