<?php
//php to display toy selected and allow editing
ini_set("session.save_path", "/home/unn_w20022261/sessionData");
session_start();
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
  	<title>Edit Details of Toy</title>
</head>
<body>
<?php
//check if user is logged in
if ($_SESSION['logged-in'] == true){
	echo"<p> <a href='toyLogout.php'>Logout</a></p>";
	
	//store toyID variable
$toyID = filter_has_var(INPUT_GET, 'toyID') ? $_GET['toyID'] : null;

   //
if (empty($toyID)) {
	echo "<p>Please <a href='chooseToy.php'>choose</a> a toy.</p>\n";
}
else {
	try {
		//connect to database to retrieve information
		require_once("functions.php");
		$dbConn = getConnection();

		$sqlQuery = "SELECT toyID, toyName, description,NTL_toys.manID, manName,NTL_toys.catID, catDesc, toyPrice
				 FROM NTL_toys
				 INNER JOIN NTL_category
				 ON NTL_category.catID = NTL_toys.catID
				 INNER JOIN NTL_manufacturer
				 ON NTL_manufacturer.manID = NTL_toys.manID
				 WHERE toyID = $toyID";
		$queryResult = $dbConn->query($sqlQuery);

		$rowObj = $queryResult->fetchObject();
		
		
		//form with details of toy
		echo "
		<h1>Update </h1>
		<h2>{$rowObj->toyName}</h2>
		<form id='UpdateToy' action='updateToy.php' method='get'>
			<p>Toy ID <input type='text' name='toyID' value='$toyID' readonly ></p>
			<p>	Toy <input type='text' name='toyName' value='{$rowObj->toyName}' ></p>
			
			";
			
			//cant do pre-selected option but did dynamic list
			
			// generate category list
			$sqlCat = "SELECT catID, catDesc from NTL_category ORDER BY catDesc";
				$rsCat = $dbConn->query($sqlCat);
			
			echo"Category: <select name='catID'>";
		while($catRecord = $rsCat->fetchObject()){
			
			if ($rowObj->catID == $rsCat->catID) {
					 $selected = 'selected';
				} 
                  else {
		           $selected = '';
		        }
			
			
			echo"<option value='{$catRecord->catID}'$selected>{$catRecord->catDesc}</option>";
		}
				
		echo"</select><br><br>";
		
		
		//generate director list
		$sqlDir = "SELECT manID, manName from NTL_manufacturer ORDER BY manName";
				$rsDir = $dbConn->query($sqlDir);
		echo"Manufacturer: <select name='manID'>";
		while($dirRecord = $rsDir->fetchObject()){
			
			
			if ($rowObj->manID == $rsDir->manID) {
					 $selected = 'selected';
				} 
                  else {
		           $selected = '';
		        }
			
			echo"<option value='{$dirRecord->manID}'$selected>{$dirRecord->manName}</option>";
		}
		echo"</select><br><br>";






			echo"<br><bt>
			Notes: <br>
			<textarea name='description'>{$rowObj->description}</textarea>
			<br><br>
			Toy Price: <input type='text' name ='toyPrice' value='{$rowObj->toyPrice}'><br><br>
			
			<p><input type='submit' name='submit' value='Update Toy'></p>
		</form>
		";
	}
	catch (Exception $e){
		echo "<p>Toy details not found: ".$e->getMessage()."</p>\n";
	}
}
}else {
echo"<p>You need to be logged in to access this page. Please try
<a href='toyLoginForm.php'>again</a>.</p>\n";	
}

?>
</body>
</html>

