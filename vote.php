<?php
	include_once('config.php');
	include_once('dbutils.php');
		

	$data =json_decode(file_get_contents('php://input'), true);
	//$count = $data['voteCount'];
	
	
	//connect to database
	$db = connectDB($DBHost, $DBUser,$DBPassword,$DBName);
		
	// variable that keeps track of whether the form was complete
	$isComplete = true;
	
	//error message
	$errorMessage = "";
	
	//Check for duplicates in database
	//Select statement here checking if account id is in db and then do if statements. Make one vote.php
	
	if ($isComplete){
		//everything works
		
		session_start();
		$list_id = $_SESSION['listid'];
		$accountid = $_SESSION['accountid'];
		
        
		//make insert statement	
		$query = "INSERT INTO vote(list_id,voteCount,accountid) VALUES ($list_id,1,$accountid)";
		
			
		//run insert statement
		$result = queryDB($query,$db);
		
		// update the list table with new count
		$query = "UPDATE list SET voteCount = voteCount + 1 WHERE id=$list_id";

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


		
		
