<?php
//php to process the login form
ini_set("session.save_path", "/home/unn_w20022261/sessionData");
session_start();
?>
<! doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login Process</title>
</head>
<body>
<?php
//save variables and remove white spaces
$username = filter_has_var(INPUT_POST,'username') ? $_POST['username']: null;
$username = trim($username);
$password = filter_has_var(INPUT_POST,'password') ? $_POST['password']: null;
$password = trim($password);

//check if the variables are empty
if (empty($username)||empty($password)) {
echo"<p>You need to provide a username and a password. Please try
<a href='toyLoginForm.php'>again</a>.</p>\n";
}
else {
try {
// Clear any session setting that might be left from a previous session
unset($_SESSION['username']);
unset($_SESSION['logged-in']);
require_once("functions.php");
$dbConn = getConnection();
$querySQL = "SELECT passwordHash FROM NTL_users WHERE username = :username";
$stmt = $dbConn->prepare($querySQL);
$stmt->execute(array(':username'=> $username));
$user=$stmt->fetchObject();
// If there is a record returned
if ($user) {
	$passwordHash = $user->passwordHash;
if (password_verify($password, $passwordHash)) {
echo
" <p>Logon success!</p>\n";
echo"<a href='chooseToy.php'>Choose Toy to Edit</a> \n" ;

/* Set a session variable called logged-in and give it the value true to
indicate a successful logon */
$_SESSION['logged-in'] = true;
/* Set a session variable called username and add the user's username
as its value*/
$_SESSION['username'] = $username;
} else {
echo"<p> password -- Username or Password wrong. Please try
<a href='toyLoginForm.php'>again</a>.</p>\n";
}
} else {
echo"<p>user -- Username or Password wrong. Please try
<a href='toyLoginForm.php'>again</a>.</p>\n";
}
} catch (Exception $e) {
echo"Record not found: " . $e->getMessage();
}
}
?>
</body>
</html>