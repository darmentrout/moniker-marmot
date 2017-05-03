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
			margin: 0px;
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

else { 
?>


<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
	<label for="title">Animal:</label>
	<input id="title" name="animal" type="text">
	<input id="submit" type="submit">
</form>


<?php
}
?>


</body>
</html>