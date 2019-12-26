<!DOCTYPE html>

<?php 
	
    session_start();
   
    unset($_SESSION["verify"]);
    
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
    {
    	header("location: login.php");
    	exit;
	}
 
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{

		unset($_SESSION["loggedin"]);
		header("Location: login.php");
	}

?>

<html>

<head>
	<title>Challenge App</title>
</head>

<body>

	<h1>Hello and welcome</h1>

	<form action="" method="post">
		<input type="submit" name="logout" value="Logout" />
	</form>

</body>

</html>