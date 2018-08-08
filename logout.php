<?php
if(!empty($_POST["logout"])) {
	$_SESSION["ID"] = "";
	session_destroy();
}
	header('location:page1.html');

?>