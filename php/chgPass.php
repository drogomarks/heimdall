<?php

$customerID = $_POST['id'];
$domain = $_POST['domain'];
$user = $_POST['user'];
$mailboxType = $_POST['mailboxType'];
$pwd = $_POST['pwd'];


//Pull in functions file
include 'functions.php';
//Require API Client file to pull functions 
header('Content-Type:  text/plain');
require_once 'apiClient.php';

// Create a Connection to API
$client = new  ApiClient();

//Send GET Request to API and store response in $response
$fields= Array(
    'password' => "$pwd");

$response = $client->put(
    "/customers/$customerID/domains/$domain/$mailboxType/mailboxes/$user",
    $fields,
    'application/x-www-form-urlencoded');

if (empty($response)){
    echo "Password for '$user' changed!";
}else{

//Pretty print the XML response
$response->preserveWhiteSpace = false;
$response->formatOutput = true;

//Print out the JSON response
echo $response;
}

?>

