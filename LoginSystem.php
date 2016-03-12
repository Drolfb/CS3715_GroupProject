<!DOCTYPE html>
<!-- Group Project, This is an super basic login/password system that will later
     be updated with MySQL support. -->
<html>
    <?php 
        // A test array with username/password combinations
        $usernamePassword = array (
            "Fred" => "123456",
            "Brian" => "654321"
        );
        
        // Grabbing the information the user types in the username and password
        // forms.
        $inputUsername = $_GET["username"];
        $inputPassword = $_GET["password"];
         
        echo "<p> Username=$inputUsername <br> Password=$inputPassword</p>";

        // Run through the $usernamePassword array and compare it with the user's
        // input data. 
        while (list($username, $value) = each($usernamePassword)) {
            if ($username == $inputUsername) {
                if ($value == $inputPassword) {
                    echo "Login Successful!";
                }
            }
        }
    ?>
    <head>
        <title>Project Login System</title>
    </head>
    <body>
        <!-- Using Get for now, will use post in final version. -->
        <form action="LoginSystem.php" method="get">
            <label>Username: </label><br>
            <input type="text" name="username"><br> 
            <label>Password: </label><br>
            <input type="text" name="password"><br> 
            <input type="submit" value="Log In">
        </form>
    </body>
</html>
