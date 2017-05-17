<?php 


try {

$db = new PDO("sqlite:".__DIR__."/marmot-monikers.db");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e) {
	echo "Something went wrong! ";
	echo $e->getMessage();
	//die();
	exit;
}

$get = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

if( isset($get['animal']) ){

	try {

		$query = "SELECT epithet, animal 
				  FROM names 
				  WHERE animal 
				  LIKE '%' || ? || '%' 
				  ORDER BY animal";
		$things = $db->prepare( $query );
		$things->bindParam( 1, $get['animal'] );
		$things->execute();
		$results = $things->fetchAll(PDO::FETCH_ASSOC);
		$i = 0;
		if( !empty($results) ){
			echo json_encode( $results );
		}
		else {
			echo '[{"animal":"No Matches."}]';
		}
	}
	catch(Exception $e) {
		echo "No good: ";
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
		  		  WHERE animal 
		  		  LIKE ? || '%' 
		  		  ORDER BY animal";
		$things = $db->prepare( $query );
		$things->bindParam( 1, $fmatch );
		$things->execute();
		$results = $things->fetchAll(PDO::FETCH_ASSOC);
		$i = 0;
		if( !empty($results) ){
			echo json_encode( $results );
		}
		else {
			echo '[{"animal":"No Matches."}]';
		}
	}
	catch(Exception $e) {
		echo "No good: ";
		echo $e;
		exit;
	}

}


?>