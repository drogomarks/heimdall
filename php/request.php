<?php
// Set Variables
$name = $_POST['name'];
$email = $_POST['email'];
$text = $_POST['message'];

$msg = "Hello! \n\n $name has submitted the following request: \n\n '$text' \n\n Reply to: $email ";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
mail("rudy.marks@gmail.com","New Feature Request!",$msg);

if(empty($text)){
  header('Location: /fail.html');
}else{
   header('Location: /thanks.html');

}


?>
