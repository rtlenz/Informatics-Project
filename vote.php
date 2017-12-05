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
	
	session_start();
	$list_id = $_SESSION['listid'];
	$accountid = $_SESSION['accountid'];
	
	//Checks if user already voted on the list
	if($isComplete){
		//This selects from table anything entered by user
		$query ="SELECT * FROM vote WHERE list_id=$list_id AND accountid=$accountid";
		
		//$mysqli = new mysqli("accountid");
		
		//run the select statement
		$result = queryDB($query, $db);	
		
		if(nTuples($result) > 0){
			//there is a duplicate
			$isComplete = false;
			$errorMessage .= "You already voted on this list";
		}
	}
	
	if ($isComplete){
		//everything works
		
		
		
        
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


		
		
