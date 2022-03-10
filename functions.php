<?php

// php to connect to database

function getConnection() {
try {
$connection = new PDO("mysql:host=localhost;dbname=unn_w20022261",
  "unn_w20022261", "Mariposa123");
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $connection;
} catch (Exception $e) {
throw new Exception("Connection error ". $e->getMessage(), 0, $e);
}
}





function makePageStart($title,$cssFile) {
	$pageStartContent = <<<PAGESTART
	<!doctype html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>$title</title> 
		<link href=$cssFile rel="stylesheet" type="text/css">
	</head>
	<body>
<div id="gridContainer">
PAGESTART;
	$pageStartContent .="\n";
	return $pageStartContent;
}

function makeHeader($header){
	$headContent = <<<HEAD
		<header>
			<h1>$header</h1>
		</header>
HEAD;
	$headContent .="\n";
	return $headContent;
}

function makeNavMenu($navMenuHeader, array $links) {
	//$navMenuContent = <<<NAVMENU
		$navMenuContent="<nav>\n";
			$navMenuContent .="<h2>$navMenuHeader</h2>\n";
			$navMenuContent .="<ul>\n";
				foreach ($links as $key=>$value) {
					$navMenuContent .= "<li><a href=$key>$value</a></li>\n";
					}
			$navMenuContent .="</ul>\n";
		$navMenuContent .="</nav>\n";
//NAVMENU;
	$navMenuContent .= "\n";
	return $navMenuContent;
}
function startMain() {
			return "<main>\n";
		}

function endMain() {
			return "</main>\n";
		}


function makeFooter($footer) {
$footContent = <<<FOOT
<footer>
<p>$footer</p>
</footer>
FOOT;
	$footContent .="\n";
return $footContent;
}

function makePageEnd() {
return "</div>\n</body>\n</html>";
}


?>