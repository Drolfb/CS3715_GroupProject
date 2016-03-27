<?php 
session_start();


if (!isset($_SESSION['username'])) {
	echo "<script>alert(\"You are not logged in!\"); window.location('./index.php')</script>";
	die();
}

?>
<html>
<script type="text/javascript">
var canvas, ctx, flag = false,
    prevX = 0,
    currX = 0,
    prevY = 0,
    currY = 0,
    dot_flag = false;
var x = "black",
    y = 2;

var convertImage = "./ConvertImage.php";
    
function init() {   //creates the canvas
    canvas = document.getElementById('can');
    ctx = canvas.getContext("2d");
    w = canvas.width;
    h = canvas.height;
    canvas.addEventListener("mousemove", function (e) {
        findxy('move', e)
    }, false);
    canvas.addEventListener("mousedown", function (e) {
        findxy('down', e)
    }, false);
    canvas.addEventListener("mouseup", function (e) {
        findxy('up', e)
    }, false);
    canvas.addEventListener("mouseout", function (e) {
        findxy('out', e)
    }, false);
}
function color(obj) {   //makes the drawing tool black in color
    switch (obj.id) {
        case "black":
            x = "black";
            break;
    }
}
function draw() {  //drawing tool
    ctx.beginPath();
    ctx.moveTo(prevX, prevY);
    ctx.lineTo(currX, currY);
    ctx.strokeStyle = x;
    ctx.lineWidth = y;
    ctx.stroke();
    ctx.closePath();
}
function erase() { //Clears Entire Image from Canvas
    
    ctx.clearRect(0, 0, w, h);
    document.getElementById("canvasimg").style.display = "none";
    
}
function eraseRound() { //Clears Entire Image from Canvas after round is done
        var timeLeft = 31,
        cinterval;
    var timeDec = function (){
        timeLeft--;
        document.getElementById('countdown').innerHTML = timeLeft;
        if(timeLeft === 0){
            clearInterval(cinterval);
            ctx.clearRect(0, 0, w, h);
        document.getElementById("canvasimg").style.display = "none"; 
        }
    };
    cinterval = setInterval(timeDec, 1000);
}
function save() {   //saves image
    document.getElementById("canvasimg").style.border = "3px solid";
    var dataURL = canvas.toDataURL(); // .toDataURL("image/png");
    // var x64 = btoa(dataURL);
    var vars = "canvas="+dataURL;
    
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
            }
        }
	xmlhttp.open('POST', convertImage, true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send(vars);
    
    
    document.getElementById("canvasimg").src = dataURL;
    document.getElementById("canvasimg").style.display = "inline";
    
}
function findxy(res, e) {   //finds positioning
    if (res == 'down') {
        prevX = currX;
        prevY = currY;
        currX = e.clientX - canvas.offsetLeft;
        currY = e.clientY - canvas.offsetTop;
        flag = true;
        dot_flag = true;
        if (dot_flag) {
            ctx.beginPath();
            ctx.fillStyle = x;
            ctx.fillRect(currX, currY, 2, 2);
            ctx.closePath();
            dot_flag = false;
        }
    }
    if (res == 'up' || res == "out") {
        flag = false;
    }
    if (res == 'move') {
        if (flag) {
            prevX = currX;
            prevY = currY;
            currX = e.clientX - canvas.offsetLeft;
            currY = e.clientY - canvas.offsetTop;
            draw();
        }
    }
}



(function () {
    var timeLeft = 30,
        cinterval;

    var timeDec = function (){
        timeLeft--;
        document.getElementById('countdown').innerHTML = timeLeft;
        if(timeLeft === 0){
            clearInterval(cinterval);
        }
    };
    cinterval = setInterval(timeDec, 1000);
})();


</script>

Time Left: <span id="countdown">30</span>.

<?php
	if ($logged == false) {
		echo "<script>alert('You are not logged in!');</script>";
		echo "<script>window.location(\"./index.php\")</script>";
	}
echo "<meta http-equiv=\"refresh\" content=\"10;url=http://localhost/CS3715_GroupProject_Canvas/ResultScreen.php\"/>";
?>

<body onload="init()">
    <canvas id="can" width="600" height="600" style="position:absolute;top:10%;left:10%;border:3px solid;"></canvas>
    <img id="canvasimg" style="position:absolute;top:10%;left:52%;" style="display:none;">
    
    
    <form method="POST">
        <input type="button" value="save" id="savebtn" size="30" onclick="save()" style="position:absolute;top:7%;left:10%;">
    </form>
    <input type="button" value="clear" id="clr" size="23" onclick="erase()" style="position:absolute;top:7%;left:13%;">
</body>
</html>
