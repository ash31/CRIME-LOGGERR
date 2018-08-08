<?php 
  
  $mail= " ";
  
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  require 'PHPMailer/src/Exception.php';
  require 'PHPMailer/src/PHPMailer.php';
  require 'PHPMailer/src/SMTP.php';


  
  
  $db = mysqli_connect('localhost', 'root', '', 'cl');
  if (isset($_POST['submit'])) {
  	$username = $_POST['username'];
  	$email = $_POST['email'];
  	$password = md5($_POST['password']);
    $address = $_POST['address'];

  	$sql_u = "SELECT * FROM users WHERE password='$password'";
  	$sql_e = "SELECT * FROM users WHERE email='$email'";
  	$res_u = mysqli_query($db, $sql_u);
  	$res_e = mysqli_query($db, $sql_e);
        if (mysqli_num_rows($res_u) > 0) {
      	echo  "password already taken";  
    }else if(mysqli_num_rows($res_e) > 0){
      echo "Email already taken";  
    }else{

           $token = 'qwertzuiopasdfghjklyxcvbnmQWERTZUIOPASDFGHJKLYXCVBNM0123456789!$/()*';
           $token = str_shuffle($token);
           $token = substr($token, 0, 10);
           $query = " INSERT INTO users (name, email, password, address , confirm , token) VALUES ('$username', '$email', '$password','$address', '0', '$token') ";
           $results = mysqli_query($db, $query);

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

			
			                         

			$mail->setFrom('ash31may@gmail.com','Ashish');
			
			$mail->addAddress($email,$username);   // Add a recipient

			$mail->IsHTML(true);  // Set email format to HTML

			$bodyContent = "
                    Please click on the link below:<br><br>
                    
                    <a href='http://localhost/cr/confirm.php?email=$email&token=$token'>Click Here</a>
                ";

			$mail->Subject = "Please verify email!";
			$mail->Body    = $bodyContent;


							$mail->send();
				    
            echo '<meta http-equiv="refresh" content="1; URL=d.html" />';
				} catch (Exception $e) {
				    echo 'Message could not be sent.';
				    echo 'Mailer Error: ' . $mail->ErrorInfo;
				}

			}
						


           }

           


  
?>