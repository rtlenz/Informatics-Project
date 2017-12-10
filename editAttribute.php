<?php
	include_once('config.php');
	include_once('dbutils.php');
	
	
	//get data from form
	
	$data =json_decode(file_get_contents('php://input'), true);
	$label = $data['label'];
	//$type = $data['type'];
	$value =$data['value'];
	
	//connect to database
	$db = connectDB($DBHost, $DBUser,$DBPassword,$DBName);
		
	// variable that keeps track of whether the form was complete
	$isComplete = true;
	
	//error message
	$errorMessage = "";
	
	
	
	// proceed depending on whether the data is ready or not
	
	if ($isComplete){
		//everything works
	
		
		//make insert statement
		$query = "UPDATE attribute SET label='$label' AND value='$value'  WHERE id=$id";
		
		//run insert statement
		$result = queryDB($query,$db);
		
		
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
