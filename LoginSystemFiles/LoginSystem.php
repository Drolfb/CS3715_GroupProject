<!DOCTYPE html>
<!-- Group Project, This is a super basic login/password system that is with 
     MySQL support. -->
    <?php 
        // session_start();
        
        // Grabbing the information the user types in the username and password
        // forms.
        $inputUsername = $_POST["username"];
        $inputPassword = $_POST["password"];
        global $actionLocation;
    
        
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
        
        // Closing the database connection.
        $db = NULL;
        
        
            // Run through the MySQL table  and compare it with the user's input data. 
            while($rows = $userInfoTable->fetch()) {
            // echo "rows[0]=" . $rows[0] . " rows[1]=" . $rows[1] . " rows[2]=" . $rows[2] . "<br>";
                if (($rows[1] == $inputUsername) && ($rows[2] == $inputPassword)) {
                        // header("Location:ExamplePage.html");
                        $actionLocation = 'action="ExamplePage.html"';
                        echo "$actionLocation";
                        break;
                }
                else {
                        // header("Location:LoginSystem.php");
                        $actionLocation = 'action="LoginSystem.php"';
                        echo "$actionLocation";
                }
            }
    
echo '<html>';
echo    '<head>';
echo        '<title>Project Login System</title>';
echo    '</head>';
echo    '<body>';
            //Using POST to get user information in a secure matter.
echo        '<form '.  $actionLocation. ' method="post">';
echo            '<label>Username: </label><br>';
echo            '<input type="text" name="username"><br>'; 
echo            '<label>Password: </label><br>';
echo            '<input type="text" name="password"><br>'; 
echo            '<input type="submit" value="Log In">';
echo        '</form>';
echo     '</body>';
echo '</html>';
?>
