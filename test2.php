<?php

$db = mysqli_connect('localhost', 'root', '', 'cl');

$query1 = "SELECT email FROM users WHERE address = ' Clement Town, Dehradun, Uttarakhand 248002, India' ";



foreach (mysqli_query($db,$query1) as $row) {


  echo $row[email];

}



?>