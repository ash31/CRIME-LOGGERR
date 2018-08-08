<?php 
  
  $mail= " ";
  
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  require 'PHPMailer/src/Exception.php';
  require 'PHPMailer/src/PHPMailer.php';
  require 'PHPMailer/src/SMTP.php';


session_start();


	$db = mysqli_connect('localhost', 'root', '', 'cl');
  

  if (isset($_POST['submit'])) {

  	if(isset($_POST['sel'])){

  	


  	$address = $_POST['address'];
  	$latitude = $_POST['lat'];
  	$longitude = $_POST['lng'];
    $ctype = $_POST['sel'];
    $desc = $_POST['desc'];
    $time = $_POST['time'];
    $date = $_POST['date'];
    $id = $_SESSION['id'];

    $sql = " INSERT INTO maps (ctype, cdesc, lat, lng , timee , datee , address ,id) VALUES ('$ctype', '$desc', '$latitude','$longitude', '$time', '$date','$address','$id') ";

   if(mysqli_query($db,$sql))
   {
      echo "REPORT SUCCESFULLY SUBMITTED";
   



            $query1 = "SELECT email FROM users WHERE address = '$address' ";
            $result = mysqli_query($db,$query1);
            if(mysqli_num_rows($result) > 0)
            {
            foreach (mysqli_query($db,$query1) as $row) {
            

            
            
                  
                  
                    
                   $token = 'qwertzuiopasdfghjklyxcvbnmQWERTZUIOPASDFGHJKLYXCVBNM0123456789!$/()*';
                   $token = str_shuffle($token);
                   $token = substr($token, 0, 10);

                  $mail  = new PHPMailer(true);

                   try{
                    
                    $mail->isSMTP();
                    $mail->SMTPDebug =0;                 
              $mail->Host=gethostbyname('smtp.gmail.com');      
              $mail->Port =587;    
              $mail->SMTPSecure ='tls';            
              $mail->SMTPAuth = true;           
              $mail->Username = 'tyler19981988@gmail.com';          
              $mail->Password = ''; 

              $mail->SMTPOptions = array(
                    'ssl' => array(
                      'verify_peer' => false,
                      'verify_peer_name' => false,
                      'allow_self_signed' => true
                  )
              );


      $mail->setFrom('tyler19981988@gmail.com','Rambo');
      
      $mail->addAddress($row[email]);   

      $mail->IsHTML(true);  

      $bodyContent = " $desc has happened in your area : <br><br>


                    Please click on the link below to vote yes:<br><br>
                    
                    <a href='http://localhost/cr/voteconfirm.php?token=$token&lat=$latitude&lng=$longitude&cdesc=$desc' >Click Here</a><br><br>


                    Please click on the link below to vote no:<br><br>
                    
                    <a href='http://localhost/cr/voteconfirm1.php?token=$token&lat=$latitude&lng=$longitude&cdesc=$desc'>Click Here</a><br><br>


                    Please click on the link below if you dont know:<br><br>
                    
                    <a href='http://localhost/cr/voteconfirm2.php?token=$token&lat=$latitude&lng=$longitude&cdesc=$desc'>Click Here</a>




                ";

      $mail->Subject = "Please verify email!";
      $mail->Body    = $bodyContent;


              $mail->send();
            
          
        } catch (Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }

            echo "<div class='alert alert-success'>YOUR REPORT HAS BEEN SUCCESFULLY SUBMITTED CHECK YOUR MAIL IF YOU LIVE IN THE CRIME AREA</div>";
            echo '<meta http-equiv="refresh" content="3; URL=page2.html" />';
        }

                      
  }

  else
  {
    
    echo '<meta http-equiv="refresh" content="3; URL=page2.html" />';
  }
}

  else
        {
          echo "TRY AGAIN";
          echo '<meta http-equiv="refresh" content="3; URL=one.html" />';
        }     
} }
?>





