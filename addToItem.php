<?php
	include_once('config.php');
	include_once('dbutils.php');


	$data =json_decode(file_get_contents('php://input'), true);
	$name = $data['name'];
	
	
	
	//connect to database
	$db = connectDB($DBHost, $DBUser,$DBPassword,$DBName);
		
	// variable that keeps track of whether the form was complete
	$isComplete = true;
	
	//error message
	$errorMessage = "";
	
	
	
	
	if ($isComplete){
		//everything works
		
		
		
	
		session_start();
		$listid = $_SESSION['listid'];
		
		
		
		
		//make insert statement	
		$query = "INSERT INTO item(name,list_id,ordernumber) VALUES ('$name',$listid,0)";
		
		//run insert statement
		$result = queryDB($query,$db);
		
		
		//get id for item just entered add this to a $session variable with the list id
		$_SESSION['item_id'] = mysqli_insert_id($db);
		
		
		$item_id = $_SESSION['item_id'];
	
		
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
