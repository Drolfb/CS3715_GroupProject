<?php
session_start();
$cookieName = "QuickDrawLogin";
$cookieValue = $_COOKIE[$cookieName];
setcookie($cookieName,$cookieValue,time()-1);
session_destroy();
?>
