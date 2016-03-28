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
$playerCount = 1;
if ($value = $db->query('SELECT * FROM '.$gameTable)) {
    $playerCount = $value->rowCount();
}
//$playerCount = $gameTableInfo->fetch('SELECT COUNT(*) FROM '.$gameTable);
$imgHeight = 600/$playerCount;  //Shrink the canvas so all the players' drawings fit on screen

$count = 0;
$db = NULL; // Closing the database connection.
while($rows = $gameTableInfo->fetch()) {
    $image = str_replace("+", "%2B", $rows['CanvasString']);
    $image = urldecode($image);
    $un = $rows['Username'];
    echo '<img height="'.$imgHeight.'" id="'.$un.'" src="'.$image.'">';
    $count++;
}
?>
<html>
    <head>
        <script type="text/javascript">
            var imgs = document.getElementsByTagName('img');
            var vote = function(j) {
                console.log("Voted for: " + j);
                var voteScript = "./vote.php?uname="+j;
                if (window.XMLHttpRequest) {
                    xmlhttp = new XMLHttpRequest;
                } else {
                    xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
                }
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                        var resp = xmlhttp.responseText;
                        document.getElementById('btndiv').innerHTML = resp;
                    }
                };
                xmlhttp.open('GET', voteScript, true);
                xmlhttp.send();
                
            };
            function init() {
                var imgs = document.getElementsByTagName('img');
                for (var i = 0; i < imgs.length; i++) {
                    var id = imgs[i].getAttribute("id");
                    var voteString = "vote(\""+id+"\")";
                    imgs[i].setAttribute("onclick", voteString);
                }
            }
        </script>
        <title>Results</title>
    </head>
    <body onload=init()>
        <div id="btndiv"></div>
    </body>
        
</html>