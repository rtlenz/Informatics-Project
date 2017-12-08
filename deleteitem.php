<?php

//Deletes a item
include_once('config.php');
include_once('dbutils.php');

$data = json_decode(file_get_contents('php://input'), true);
$itemid = $data['id'];

//variable to keep track if the form is complete
$isComplete = true;

//error message we'll give the users
$errorMessage = "";

$db = connectDB($DBHost, $DBUser, $DBPassword, $DBName);


if(!isset($itemid)){
	$errorMessage .= "No ID was set.";
	$isComplete = false;
} else{
	//check if ID is in table
	
	$query = "SELECT * FROM item WHERE id=$itemid";
	
	//run the query
	
	$result= queryDB($query,$db);
	
	if(nTuples($result) == 0){
		$errorMessage .= "The id provided doesn't match any in the table";
		$isComplete = false;
	}
	
}

if($isComplete){
	//lets delete the record
	$query = "DELETE FROM item WHERE id=$itemid";
	
	//run the delete statement
	$result =queryDB($query,$db);
	
	//send response back
	$response =array();
	$response['status'] = 'success';
	$response['id'] = $id; 
	header('Content-Type: application/json');
	echo(json_encode($response));
}else{
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