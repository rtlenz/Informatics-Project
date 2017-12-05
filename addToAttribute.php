<?php
	include_once('config.php');
	include_once('dbutils.php');


	$data =json_decode(file_get_contents('php://input'), true);
	$label = $data['label'];
	$type = $data['type'];
	$value = $data['value'];
	$ordernumber = $data['ordernumber'];
	
	
	
	
	
	//connect to database
	$db = connectDB($DBHost, $DBUser,$DBPassword,$DBName);
		
	// variable that keeps track of whether the form was complete
	$isComplete = true;
	
	//error message
	$errorMessage = "";
	
	//Check for duplicates in database
	
	if ($isComplete){
		//everything works
		
		
		 
		session_start();
		$item_id = $_SESSION['item_id'];
		
		
		$query = "INSERT INTO attribute(label,type,value,item_id,ordernumber) VALUES ('$label','$type','$value',$item_id,0)";
		
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
