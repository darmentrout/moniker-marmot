<?php 
	// Hello!
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>MM0</title>
	<style>
		body {
			font-family: sans-serif;
			font-size: 1em;
			margin: 50px;
			background: #222;
			color: #fff;
		}
		code {
			display: block;
			font-family: monospace;
			color: lime;
			margin: 15px 0px;
			padding: 1px;
		}
		form {
			margin: 20px 0px;
			padding: 1px;
		}
		form * {
			display: block;
			margin: 10px 0px;
		}
		#result {
			margin: 2em;
		}
	</style>
</head>
<body>



<?php


try {

$db = new PDO("sqlite:".__DIR__."/marmot-monikers.db");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
echo "<code>Connected to database successfully.</code><br>";
}
catch(Exception $e) {
	echo "<b>Something went wrong!</b>";
	echo $e->getMessage();
	//die();
	exit;
}

$get = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

if( isset($get['animal']) ){

	try {

		$query = "SELECT epithet, animal 
				  FROM names 
				  WHERE animal LIKE '%' || ? || '%' ";
		$things = $db->prepare( $query );
		$things->bindParam( 1, $get['animal'] );
		$things->execute();
		$results = $things->fetchAll(PDO::FETCH_ASSOC);
		$i = 0;
		if( !empty($results) ){
			foreach( $results as $result ){
				echo "<div id='result'><i>" . $results[$i]['epithet'] . "</i> ";
				echo "<span>" . $results[$i]['animal'] . "</span></div>";
				$i++;
			}
		}
		else {
			echo "<p>No matches.</p>";
		}
	}
	catch(Exception $e) {
		echo "<b>No good:</b>";
		echo $e;
		exit;
	}

}

if( isset($get['find_match']) ){

	try {

		$places = intval( $_GET['find_match_places'] );
		$fmatch = substr( $get['find_match'], 0, $places );

		$query = "SELECT animal 
		  FROM names 
		  WHERE animal LIKE ? || '%' ";
		$things = $db->prepare( $query );
		$things->bindParam( 1, $fmatch );
		$things->execute();
		$results = $things->fetchAll(PDO::FETCH_ASSOC);
		$i = 0;
		if( !empty($results) ){
			foreach( $results as $result ){
				echo "<div id='result'><i>" . $get['find_match'] . "</i> ";
				echo "<b>" . $results[$i]['animal'] . "</b></div>";
				$i++;
			}
		}
		else {
			echo "<p>No matches.</p>";
		}
	}
	catch(Exception $e) {
		echo "<b>No good:</b>";
		echo $e;
		exit;
	}

}

else { 
?>

<h1>Search</h1>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
	<label for="animal">See Animals:</label>
	<input id="animal" name="animal" type="text">
	<input id="submit" type="submit">
</form>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
	<label for="find_match">Find Matching Animal for:</label>
	<input id="find_match" name="find_match" type="text" value="fe">
	<label for="find_match_places">Places from Start:</label>
	<select id="find_match_places" name="find_match_places">
		<option value="1" selected>One/option>
		<option value="2">Two</option>
		<option value="3">Three</option>
	</select>
	<input id="submit" type="submit">
</form>


<?php
}
?>


</body>
</html>