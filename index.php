<html><head>
    <title>QuickDraw - a lightweight drawing contest</title>
	   <link rel="stylesheet" href="style.css">
	   <script type="text/javascript">
		      var loginSystem = "./LoginSystem.php";
        var regSystem = "./RegistrationSystem.php";
        var cookieName = "QuickDrawLogin";
        var logoutPage = "./logout.php";
        var matchPage = "./match.php";
        var playersQueue = "./PlayersQueue.php";
        var canvasPage = "./BasicCanvas.php";
        var loginLink; var loginWindow; var regLink; var regWindow; var profilebtn; var logoutbtn;
        function load() {
            //Login/register buttons
            loginLink = document.getElementById('log');
            regLink = document.getElementById('reg');

            //Hide forms
            loginWindow = document.getElementById('loginWindow');
            loginWindow.className = "hidden";
            regWindow = document.getElementById('regWindow');
            regWindow.className = "hidden";

            loginLink.onclick = function() {
                regWindow.className = "hidden";
                loginWindow.className = "shown";
            };
            regLink.onclick = function() {
                loginWindow.className = "hidden";
                regWindow.className = "shown";
            };
			
            //Profile/logout buttons
            profilebtn = document.getElementById('profilebtn');
            logoutbtn = document.getElementById('logoutbtn');

            var ck = document.cookie;	//Should consist of PHPSESSID and our own cookie
            //console.log(ck);
            //Choose which buttons to show

            if (ck.indexOf("QuickDraw") !== -1) { //User is logged in
                regLink.className = "hidden";
                loginLink.className = "hidden";
            } else {							  //User is not logged in
                profilebtn.className = "hidden";
                logoutbtn.className = "hidden";
                document.getElementsByTagName('span').innerHTML = "<br/>"; //Button alignment black magic
            }

        };
		      function login() {
            var un = document.getElementById('uname').value;
			         var pw = document.getElementById('pword').value;
			         var vars = "username="+un+"&password="+pw;
			         //console.log(vars);
			         if (window.XMLHttpRequest) {
				            xmlhttp = new XMLHttpRequest();
			         } else {
				            xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
			         }
			         xmlhttp.onreadystatechange = function() {
				            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
					               var resp = xmlhttp.responseText;
					               loginWindow.className = "newPop";
					               loginWindow.innerHTML = resp;
                    setTimeout("location.reload(true);", 2000);
				            }
			         }
			         xmlhttp.open('POST', loginSystem, true);
			         xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			         xmlhttp.send(vars);
		      };
		      function register() {
			         var un = document.getElementById('runame').value;
			         var pw = document.getElementById('rpword').value;
			         var vars = "username="+un+"&password="+pw;
			         console.log(vars);
			         if (window.XMLHttpRequest) {
				            xmlhttp = new XMLHttpRequest();
			         } else {
				            xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
			         }
			         xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                    var resp = xmlhttp.responseText;
                    regWindow.className = "newPop";
                    regWindow.innerHTML = "<h1>"+resp+"</h1>";
                }
            }
            xmlhttp.open('POST', regSystem, true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send(vars);
            //setTimeout("location.reload(true);", 2);
        };
        function profile() {
            window.location.href = "./profile.php";
        }

        function logout() {

            if (window.XMLHttpRequest) {xmlhttp = new XMLHttpRequest();} 
            else {xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');}
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                    console.log(xmlhttp.responseText);
                    location.reload(true);
                }
            }
            xmlhttp.open('GET', logoutPage, true); 			//calls session_destroy();
            xmlhttp.send();
            //echo "<meta http-equiv=\"refresh\" content=\"1;url=./index.php\"/>";
            //setTimeout("location.reload(true)",1);		//refresh cookie-less page
        }
        function playNow() {
            var queueDiv = document.getElementById('queue');
            queueDiv.className = "shown";
            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
            } else {
                xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
            }
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                    var resp = xmlhttp.responseText;
                    queueDiv.innerHTML = resp;
                    if (resp.indexOf("following") > -1 || resp.indexOf("Joining") > -1) { //no errors
                        var roomID = document.getElementById('roomIDspan');
                        setTimeout(connectToRoom(roomID), 5000); //Give the user a chance to read the message, also
                                                                 //PHP script waits 5 seconds between polls
                    }
                }
            }
            xmlhttp.open('GET', playersQueue, true);
            xmlhttp.send();
        }

        function connectToRoom(roomID) {
            var matchRoom = matchPage + "?roomID=" + roomID;
            var canvasRoom = canvasPage + "?roomID=" + roomID;
            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
            } else {
                xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
            }
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                    var resp = xmlhttp.responseText;
                    if (resp === roomID) {
                        window.location(canvasRoom);
                    } else {
                        document.getElementById('queue').innerHTML = "<h1>" + resp +"</h1>";
                    }
                }
            }
            xmlhttp.open('GET', matchRoom, true);
            xmlhttp.send();
        }
        
	</script>
</head>
<body onload="load();">
    <div id="logo">
		  <img src=""/> <!-- logo goes here -->
	   </div>
	   <div id="btndiv">
		  <!-- everything in this div will be centered on the screen -->
		      <button class="btn" onclick="playNow();">Play Now!</button><br/>
		      <div id="queue" class="hidden"></div>
		      <button class="btn lilbtn" id="log">Log in</button>
		      <button class="btn lilbtn" id="reg">Register</button><span></span>
		      <button class="btn lilbtn" id="profilebtn" onclick="profile();">Profile</button>
		      <button class="btn lilbtn" id="logoutbtn" onclick="logout();">Logout</button><br/>
		      <div id="loginWindow" class="hidden">
			         <form method="post">
                <label>Username: </label><br>
                <input type="text" id="uname" onkeydown="if (event.keyCode == 13) document.getElementById('logbtn').click()"><br>
                <label>Password: </label><br>
                <input type="text" id="pword" onkeydown="if (event.keyCode == 13) document.getElementById('logbtn').click()"><br>
                <input type="button" onclick="login();" id="logbtn" value="Log In">
			         </form>
		      </div>
		      <div id="regWindow" class="hidden">
			         <form method="post">
                <label>Choose a username: </label><br>
                <input type="text" id="runame" onkeydown="if (event.keyCode == 13) document.getElementById('regbtn').click()"><br>
                <label>Create a password: </label><br>
                <input type="text" id="rpword" onkeydown="if (event.keyCode == 13) document.getElementById('regbtn').click()"><br>
                <input type="button" onclick="register();" id="regbtn" value="Log In">
            </form>
		      </div>
	   </div>
</body>
</html>
