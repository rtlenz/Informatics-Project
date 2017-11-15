<?php
	include_once('config.php');
	include_once('dbutils.php');
	
	
	//get data from form
	
	$data =json_decode(file_get_contents('php://input'), true);
	$label = $data['label'];
	$type = $data['type'];
	$value = $data['value'];
	$listName = $data['listName'];
	
	
	//connect to database
	$db = connectDB($DBHost, $DBUser,$DBPassword,$DBName);
		
	// variable that keeps track of whether the form was complete
	$isComplete = true;
	
	//error message
	$errorMessage = "";
	
	////check for name
	//if(!isset($title) || (strlen($title) == 0)) {
	//	$errorMessage .= "Please enter a name.\n";
	//	$isComplete = false;
	//}
	//
	////check for artist
	//if(!isset($artist) || (strlen($artist) == 0)) {
	//	$errorMessage .= "Please enter an artist.\n";
	//	$isComplete = false;
	//}
	//
	////check for release date
	//if(!isset($releaseDate)) {
	//	$errorMessage .= "Please enter a release date. \n";
	//	$isComplete = false;
	//}
	//
	//if(!isset($video) || (strlen($video) == 0)) {
	//	$errorMessage .= "Please enter the code to embed a video.\n";
	//	$isComplete = false;
	//}
	
	//Check for duplicates in database
	if($isComplete){
		//This selects from table anything entered by user
		$query ="SELECT * FROM list WHERE listName='$listName'";
		
		$mysqli = new mysqli("accountid");
		
		//run the select statement
		$result = queryDB($query, $db);	
		
		if(nTuples($result) > 0){
			//there is a duplicate
			$isComplete = false;
			$errorMessage .= "A list with name: $listName is already in the database";
		}
	}
	
	
	
	// proceed depending on whether the data is ready or not
	
	if ($isComplete){
		//everything works
		
		
		
		//make video safe for sql
		$video = makeStringSafe($db,$video);
		
		//make insert statement
		$query = "INSERT INTO templateAttribute(listName,label,type,value) VALUES ('$listName','$label','$type','$value')";
		
		//run insert statement
		$result = queryDB($query,$db);
		
		//get id for players just entered
		$id = mysqli_insert_id($db);
		
		//send a response back to the called of this php file
		$response =array();
		$response['status'] = 'success';
		$response['id'] = $id;
		header('Content-Type: application/json');
		echo(json_encode($response));
		
	} else{
		//generates an error message to send back to caller
		ob_start();
		var_dump($data);
		$postdump = ob_get_clean();
		
		$response = array();
		$response['status'] = 'error';
		$response['message'] = $errorMessage . $postdump;
		header('Content-Type: application/json');
		echo(json_encode($response));
	}
	
	

?>