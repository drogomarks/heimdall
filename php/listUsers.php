<?php

$customerID = $_POST['id'];
$domain = $_POST['domain'];
$mailboxType = $_POST['mailboxType'];


//Pull in functions file
include 'functions.php';
//Require API Client file to pull functions 
header('Content-Type:  text/plain');
require_once 'apiClient.php';

// Create a Connection to API
$client = new  ApiClient();

//Send GET Request to API and store response in $response
$response = $client->get(
    "/customers/$customerID/domains/$domain/$mailboxType/mailboxes?size=500",
    "application/json");
//Pretty print the JSON response
$response = prettyPrint($response);

//Print out the JSON response
echo $response;

//Convert JSON response to an Array
$json_array = json_decode($response, true);


//Create an empty Array to make a list of Mailbox Users
$users = array();

//Loop through the 'rsMailboxes' Array and pull out each 'name' value 
//then push that to the empty $users array. 

if ($mailboxType == 'ex'){
    $type = 'mailboxes';
}else{
    $type = 'rsMailboxes';
}


foreach($json_array["$type"] as $item) {
      $name = $item['name'];
      array_push($users, $name);
}


?>
