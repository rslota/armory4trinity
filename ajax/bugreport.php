<?php
@session_start();
if($_SESSION['lastSend']+(60) > time()) die('-1');

$to      = 'roxeon@gmail.com';
$subject = '[BugReport] Blizzlike Armory';


$message = 'Location: '.$_POST['location']."\r\n".
           'UserAgent: '.$_POST['userAgent']."\r\n".
           'Date: '.date("d-m-Y H:i")."\r\n".
           'IP adress: '.$_SERVER['REMOTE_ADDR']."\r\n".
           'User Description: '.$_POST['userInput']."\r\n";

$headers = 'From: armory@bugreport.com' . "\r\n".
    'X-Mailer: PHP/' . phpversion();
if(@mail($to, $subject, $message, $headers)){
	 $_SESSION['lastSend'] = time();
	 die('1');
}
else die('0');
?>