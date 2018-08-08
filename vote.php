<?


<?

	session_start();

	$db = mysqli_connect('localhost', 'root', '', 'cl');

	if (isset($_POST['submit'])) {


	$query2 = mysqli_query($db,"SELECT * FROM voted WHERE vote = 1 ");	

	if(mysqli_num_rows($res)>0)
	{
		echo "YOU CANNOT VOTE TWICE";
		echo '<meta http-equiv="refresh" content="4; URL=page2.html" />';
	}

	else

	{

	
	$id = $_SESSION['id'];


	$query = mysqli_query($db,"SELECT address FROM maps WHERE id = '$id' ");

	$query1 = mysqli_query($db,"SELECT address FROM users WHERE id = '$id' ");




	if(strpos($users, $query) !== false)  
	{
		echo "YOU CAN VOTE NOW";
		echo '<meta http-equiv="refresh" content="4; URL=subvote.php" />';
	}


	else
	{
		echo "NO NEW CRIMES IN YOUR AREA";
	}







}