<?php
	include_once('config.php');
	include_once('dbutils.php');
	
	
	//get data from form
	
	$data =json_decode(file_get_contents('php://input'), true);
	$label = $data['label'];
	$type = $data['type'];
	$value = $data['value'];
	$listName = $data['listName'];
	$name = $data['name'];
	
	
	//connect to database
	$db = connectDB($DBHost, $DBUser,$DBPassword,$DBName);
		
	// variable that keeps track of whether the form was complete
	$isComplete = true;
	
	//error message
	$errorMessage = "";
	
	
	
	//Check for duplicates in database
	if($isComplete){
		//This selects from table anything entered by user
		$query ="SELECT * FROM list WHERE listName='$listName'";
		
		//$mysqli = new mysqli("accountid");
		
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
		$query = "INSERT INTO list(listName) VALUES ('$listName')";
		$query = "INSERT INTO attribute(label,type,value) VALUES ('$label','$type','$value')";
		
		$query = "INSERT INTO item(name) VALUES ('$name')";
		
		
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