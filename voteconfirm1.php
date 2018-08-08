<?php

session_start();
    
    function redirect() {
        header('Location: page2.html');
        exit();
    }



    if(!isset($_GET['token'])) {
        redirect();
    }

    else
    {
        $db = mysqli_connect('localhost', 'root', '', 'cl');

         $lat = $_GET['lat'];
         $long = $_GET['lng'];
         $desc = $_GET['cdesc'];

        


        $sql = "UPDATE maps SET countern = countern + 1 where lat = '$lat' AND lng = '$long' AND cdesc = '$desc' ";
         if(mysqli_query($db,$sql))
         {

        echo "YOUR VOTE HAS BEEN SUBMITTED";
        echo '<meta http-equiv="refresh" content="3; URL=page2.html" />';
    }

    else
    {
        echo "try again";
        

    }}


    ?>
    




