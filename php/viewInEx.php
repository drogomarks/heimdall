<?php

$customerID = $_POST['id'];
$domain = $_POST['domain'];
$value = $_POST['value'];

//Pull in functions file
include 'functions.php';
//Require API Client file to pull functions 
header('Content-Type:  text/plain');
require_once 'apiClient.php';

// Create a Connection to API
$client = new  ApiClient();

//Send GET Request to API and store response in $response
$GET = $client->get(
    "/customers/$customerID/domains/$domain/rs/mailboxes",
    "application/json");
//Pretty print the JSON response
$GET = prettyPrint($GET);

//Convert JSON response to an Array
$json_array = json_decode($GET, true);


//Create an empty Array to make a list of Mailbox Users
$users = array();

//Loop through the 'rsMailboxes' Array and pull out each 'name' value 
//then push that to the empty $users array. 

foreach($json_array["rsMailboxes"] as $item) {
      $name = $item['name'];
      array_push($users, $name);
}

//Create Array of key and value to change
$fields= Array(
    'visibleInExchangeGAL' => "$value");

//Loop through $users array and run PUT call against each

foreach($users as $user){
   
    echo "\nUpdating visibleInExchangeGAL to true for $user...\n";
  
    $response = $client->put(
        "/customers/$customerID/domains/$domain/rs/mailboxes/$user",
    $fields,
    'application/x-www-form-urlencoded');

    $response = prettyPrint($response);
    echo $response;
    echo "Done!\n";
}




?>
