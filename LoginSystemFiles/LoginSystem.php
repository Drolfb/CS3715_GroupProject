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
        $MySQLusername = cs3715_tb6774;
        $MySQLpassword = purplesilver7;
        
        // Create database connection using PHP Data Object (PDO).
        $db = new PDO("mysql:host=mysql.cs.mun.ca;dbname=cs3715_tb6774", $MySQLusername, $MySQLpassword);
        
        // Name of the table we are using for the database.
        $MySQLtable = 'testUserInfo';

        // Grabbing everything from the table
        $userInfoTable = $db->query('SELECT * from '.$MySQLtable);
        
        // Closing the database connection.
        $db = NULL;

        // Run through the MySQL table  and compare it with the user's input data. 
        while($rows = $userInfoTable->fetch()) {
            // echo "rows[0]=" . $rows[0] . " rows[1]=" . $rows[1] . " rows[2]=" . $rows[2] . "<br>";
            if ($rows[1] == $inputUsername) {
                if ($rows[2] == $inputPassword) {
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
mysql> DESCRIBE testUserInfo;
+----------+------------------+------+-----+---------+----------------+
| Field    | Type             | Null | Key | Default | Extra          |
+----------+------------------+------+-----+---------+----------------+
| ID       | int(10) unsigned | NO   | PRI | NULL    | auto_increment |
| username | varchar(30)      | NO   | UNI | NULL    |                |
| password | varchar(12)      | NO   |     | NULL    |                |
+----------+------------------+------+-----+---------+----------------+

mysql> SELECT * FROM testUserInfo;
+----+----------+----------+
| ID | username | password |
+----+----------+----------+
|  1 | Fred     | 123456   |
|  2 | Brian    | 654321   |
|  3 | Tyler    | password |
+----+----------+----------+
 */
?>
