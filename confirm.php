        <?php
	
	function redirect() {
		header('Location: registartion.html');
		exit();
	}



	if(!isset($_GET['email']) || !isset($_GET['token'])) {
		redirect();
	}

	else
	{
		$db = mysqli_connect('localhost', 'root', '', 'cl');

		$email = $_GET['email'];
		$token = $_GET['token'];


		$sql = "SELECT id FROM users WHERE email='$email' AND token='$token' AND confirm=0";
		$res = mysqli_query($db,$sql);

		if(mysqli_num_rows($res)>0)
		{
			$q = "UPDATE users SET confirm=1, token='' WHERE email='$email'";
			mysqli_query($db,$q);
			echo '<meta http-equiv="refresh" content="1; URL=login.html" />';
		}
		else
		{
			echo "REGISTER AGAIN";
		}

	}


	?>




