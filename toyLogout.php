<?php
//php when user logs out
ini_set("session.save_path", "/home/unn_w20022261/sessionData");
session_start();

$_SESSION = array(); 		

session_destroy(); 
?>

<! doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Logged Out</title>
</head>
<body>

<p>You are Logged Out</p>
<p><a href='homePage.php'>Home Page</a></p>



</body>
</html>