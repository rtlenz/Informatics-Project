<?php
    include_once('config.php');
    include_once('dbutils.php');
    
    // connect to the database
    $db = connectDB($DBHost, $DBUser, $DBPassword, $DBName);
	
	$accountusername = $account['username']; 
    
    // set up a query to get the list of lists
    $query = "SELECT * FROM list WHERE account_username='$accountusername'"; 
    
    // run the query
    $result = queryDB($query, $db);
    
    // assign results to array
    $lists = array();
    $i = 0;
	$isloggedin = false;
    $username = "not logged in";
    
    session_start();
    if (isset($_SESSION['username'])) {
        $isloggedin = true;
        $username = isset($_SESSION['username']);
    
	
		while ($list = nextTuple($result)) {
			$lists[$i] = $list;
			
			$listid = $list['id'];
			
			// now get the items under the current list
			$query = "SELECT * FROM item WHERE list_id = $listid ORDER BY ordernumber";
			
			// run the query
			$result_item = queryDB($query, $db);
			$items = array();
			$j = 0;
			while ($item = nextTuple($result_item)) {
				$items[$j] = $item;
				
				$itemid = $item['id'];
				
				// now get the attributes for this item
				$query = "SELECT * FROM attribute WHERE item_id = $itemid ORDER BY ordernumber";
				
				//run the query
				$result_attribute = queryDB($query, $db);
				$attributes = array();
				$k = 0;
				while ($attribute = nextTuple($result_attribute)) {
					$attributes[$k] = $attribute;
					$k++;
				}
				
				$items[$j]['attributes'] = $attributes;
				$j++;
			}
			
			$lists[$i]['items'] = $items;
			
			$i++;
		}
	}else{
    // put together JSON object to send back
    // send response back
    $response = array();
    $response['status'] = 'success';
    $response['value'] = $lists;
    header('Content-Type: application/json');
    echo(json_encode($response));
	}
?>