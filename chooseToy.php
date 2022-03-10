<?php
//php to display list of toys to choose from
ini_set("session.save_path", "/home/unn_w20022261/sessionData");
session_start();
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
  	<title>Choose a Toy to Edit</title>
</head>
<body>
<h1>All Toys</h1>
<?php

//check if user is logged in
if ($_SESSION['logged-in'] == true){
	echo"<p><a href='toyLogout.php'>Logout</a>.</p>\n";
try {
	//connect to database to retrieve information
	require_once("functions.php");
	$dbConn = getConnection();

	$sqlQuery = "SELECT toyID, toyName, description, catDesc, toyPrice
				 FROM NTL_toys
				 INNER JOIN NTL_category
				 ON NTL_category.catID = NTL_toys.catID
				 ORDER BY toyName";
	$queryResult = $dbConn->query($sqlQuery);

     //display information
	while ($rowObj = $queryResult->fetchObject()) {
		echo "<div class='toy'>\n
				   <span class='toyName'><a href='editToy.php?toyID={$rowObj->toyID}'>{$rowObj->toyName}</a></span>\n
				   <span class='description'>{$rowObj->description}</span>\n
				   <span class='catDesc'>{$rowObj->catDesc}</span>\n
				   <span class='toyPrice'>{$rowObj->toyPrice}</span>\n
			  </div>\n";
	}
}
catch (Exception $e){
	echo "<p>Query failed: ".$e->getMessage()."</p>\n";
}
}else {
echo"<p>You need to be logged in to access this page. Please try
<a href='toyLoginForm.php'>again</a>.</p>\n";	
}
?>

</body>
</html>