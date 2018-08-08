<?php

session_start();
 
if (isset($_POST['submit'])) {
if (empty($_POST['username']) || empty($_POST['password'])) {
echo "Username or Password is invalid";
}
else
{

$username=$_POST['username'];
$password=md5($_POST['password']);
$connection = mysqli_connect('localhost', 'root', '','cl');


$query = mysqli_query($connection,"SELECT * from users where password='$password' AND name='$username' AND confirm = 1");
$rows = mysqli_num_rows($query);
$r  = mysqli_fetch_array($query);
if ($rows == 1) {

$_SESSION['id']= $r['id'];
echo "LOGIN SUCCESSFULL"; 
echo '<meta http-equiv="refresh" content="1; URL=page2.html" />';
} 

else {
echo "Username or Password is invalid ";
echo '<meta http-equiv="refresh" content="1; URL=login.html" />';
}
 
}
}
?>

