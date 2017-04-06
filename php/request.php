<?php
// Set Variables
$name = $_POST['name'];
$email = $_POST['email'];
$text = $_POST['message'];

// Put message together in a variable 
$msg = "Hello! \n\n $name has submitted the following request: \n\n '$text' \n\n Reply to: $email ";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

//If the text feild is empty then send to fail.html
if(empty($text)){
  header('Location: /fail.html');
//If it's not then send to thank you page and send email
}else{
   mail("rudy.marks@gmail.com","New Feature Request!",$msg);
   header('Location: /thanks.html');
}


?>
