<!DOCTYPE html>
<!-- Group Project, This is a super basic login/password system that is with 
     MySQL support. -->
<html>
    <?php 
        // Grabbing the information the user types in the username and password
        // forms.
        $inputUsername = $_POST["username"];
        $inputPassword = $_POST["password"];
    
        // MySQL username and password.
        $MySQLusername = root;
        $MySQLpassword = root;
        
        // Create database connection using PHP Data Object (PDO).
        $db = new PDO("mysql:host=localhost;dbname=QuickDraw_Test", $MySQLusername, $MySQLpassword);
        
        // Name of the table we are using for the database.
        $MySQLtable = 'UserInfo';

        // Grabbing everything from the table
        $userInfoTable = $db->query('SELECT * from '.$MySQLtable);
        
        // Closing the database connection.
        $db = NULL;

        // Run through the MySQL table  and compare it with the user's input data. 
        while($rows = $userInfoTable->fetch()) {
            if ($rows['Username'] == $inputUsername) {
                if ($rows['Password'] == $inputPassword) {
                    echo "Login Success!";
                }
            }
        }
    ?>
    <head>
        <title>Project Login System</title>
    </head>
    <body>
        <!-- Using POST to get user information in a secure matter. -->
        <form action="LoginSystem.php" method="post">
            <label>Username: </label><br>
            <input type="text" name="username"><br> 
            <label>Password: </label><br>
            <input type="text" name="password"><br> 
            <input type="submit" value="Log In">
        </form>
    </body>
</html>
<?php
/**
 * Database Info
 * mysql> DESCRIBE UserInfo;
+----------+----------+------+-----+---------+-------+
| Field    | Type     | Null | Key | Default | Extra |
+----------+----------+------+-----+---------+-------+
| ID       | int(11)  | NO   | PRI | NULL    |       |
| Username | tinytext | NO   | UNI | NULL    |       |
| Password | tinytext | NO   |     | NULL    |       |
+----------+----------+------+-----+---------+-------+

mysql> SELECT * FROM UserInfo;
+----+----------+----------+
| ID | Username | Password |
+----+----------+----------+
|  0 | Fred     | 123456   |
|  1 | Brian    | 654321   |
+----+----------+----------+
 */
?>
