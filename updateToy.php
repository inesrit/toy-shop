
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
  	<title>Update Toy</title>
</head>
<body>

<?php
//form to update changes from for into database
// Retrieve variables
$toyID = filter_has_var(INPUT_GET, 'toyID') ? $_GET['toyID'] : null;
$toyName = filter_has_var(INPUT_GET, 'toyName') ? $_GET['toyName'] : null;
$catID = filter_has_var(INPUT_GET, 'catID') ? $_GET['catID'] : null;
$manID = filter_has_var(INPUT_GET, 'manID') ? $_GET['manID'] : null;
$description = filter_has_var(INPUT_GET, 'description') ? $_GET['description'] : null;
$toyPrice = filter_has_var(INPUT_GET, 'toyPrice') ? $_GET['toyPrice'] : null;

//remove whitespaces
$toyName =trim($toyName);
$catID=trim($catID);
$manID =trim($manID);
$description =trim($description);
$errors = false;

//check if variables are empty
if (empty($toyID)) {
	echo "<p>You need to have selected a toy.</p>\n";
	$errors = true;
}

if (empty($toyName)) {
	echo "<p>You need to write a Name.</p>\n";
	$errors = true;
}

if (empty($catID)) {
	echo "<p>You need to choose a category.</p>\n";
	$errors = true;
}
if (empty($manID)) {
	echo "<p>You need to choose a manufacturer.</p>\n";
	$errors = true;
}
if (empty($toyPrice)) {
	echo "<p>You need to write a price.</p>\n";
	$errors = true;
} 
//check that price is a number
else if (!filter_var($toyPrice, FILTER_VALIDATE_FLOAT)){
	echo"<p>The toy price should eb a number</p>\n";
	$errors=true;
}
if ($errors === true) {
	echo "<p>Please try <a href='chooseToy.php'>again</a>.</p>\n";
}
else {
	try {
		//connect to database to update and insert new variables in
		require_once("functions.php");
		$dbConn = getConnection();
		$toyName = $dbConn->quote($toyName);
		$manID = $dbConn->quote($manID);
		$catID = $dbConn->quote($catID);
		$description = $dbConn->quote($description);
		$toyPrice = $dbConn->quote($toyPrice);
		

		$updateSQL = "UPDATE NTL_toys SET toyName=$toyName, catID=$catID, manID = $manID, description =$description, toyPrice = $toyPrice WHERE toyID = $toyID";
		$dbConn->exec($updateSQL);
		echo "<p>Toy updated</p>\n";
		echo"<p> <a href='chooseToy.php'>Go Back</a></p>";
		echo"<p> <a href='homePage.php'>Homepage</a></p>";
		echo"<p> <a href='toyLogout.php'>Logout</a></p>";
	} catch (Exception $e) {
		 echo "<p>Toy not updated: " . $e->getMessage() . "</p>\n";
	}
}

?>
</body>
</html>