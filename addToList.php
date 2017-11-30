<?php
	include_once('config.php');
	include_once('dbutils.php');


	$data =json_decode(file_get_contents('php://input'), true);
	$label = $data['label'];
	$type = $data['type'];
	$value = $data['value'];
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
		$query ="SELECT * FROM item WHERE name='$name'";
		
		//$mysqli = new mysqli("accountid");
		
		//run the select statement
		$result = queryDB($query, $db);	
		
		if(nTuples($result) > 0){
			//there is a duplicate
			$isComplete = false;
			$errorMessage .= "An item with name: $name is already in the database";
		}
	}
	
	if ($isComplete){
		//everything works
		
		//make video safe for sql
		$video = makeStringSafe($db,$video);
		 
		session_start();
		$listid = $_SESSION['listid'];
		//make insert statement	
		$query = "INSERT INTO item(name,list_id,ordernumber) VALUES ('$name',$listid,0)";
		
		//run insert statement
		$result = queryDB($query,$db);
		
		
		//get id for players just entered Add this to a $session variable with the list id
		$_SESSION['item_id'] = mysqli_insert_id($db);
		$item_id = $_SESSION['item_id'];
		
		
		$query = "INSERT INTO attribute(label,type,value,item_id) VALUES ('$label','$type','$value',$item_id)";
		
		
		
		
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
