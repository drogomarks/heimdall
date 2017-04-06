<?php

$customerID = $_POST['id'];
$domain = $_POST['domain'];
$user = $_POST['user'];
$mailboxType = $_POST['mailboxType'];

//$customer = 1213514;
//$domain =  "raxrse.com";



//Pull in functions file
include 'functions.php';
//Require API Client file to pull functions 
header('Content-Type:  text/plain');
require_once 'apiClient.php';

// Create a Connection to API
$client = new  ApiClient();

//Send GET Request to API and store response in $response
$response = $client->get(
    "/customers/$customerID/domains/$domain/$mailboxType/mailboxes/$user",
    "application/json");
//Pretty print the JSON response
$response = prettyPrint($response);

//Print out the JSON response
echo $response;

//Convert JSON response to an Array
$json_array = json_decode($response, true);


?>

