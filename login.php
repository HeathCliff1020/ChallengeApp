<?php
// Initialize the session
session_start();
 
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
{
    header("location: index.php");
    exit;
}

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err))
    {
        
    	$username = mysqli_real_escape_string($link, $username);
    	$password = mysqli_real_escape_string($link, $password);

    	$query="select * from users where username='$username' AND password='$password'";

		if($run_query = mysqli_query($link, $query))
		{
	    
	    	$check_user = mysqli_num_rows($run_query);

	    	if ($check_user > 0)
	   		{
	            session_start();
	            
	            // Store data in session variables
	            $_SESSION["loggedin"] = true;
	            $_SESSION["id"] = $id;
	            $_SESSION["username"] = $username;                                
	            // Redirect user to welcome page
	            header("location: login.php");
	        } 
	        else
	        {
	        	echo "User name or password is incorrect";
	        }
	    }
	    else
	    {
	    	echo mysqli_error($link);
	    }
	        
    }
    else
    {
    	if ( !empty($username_err) )
    		echo $username_err;
    	else
    		echo $password_err;
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>

<html lang="en">
<head>
  
  <title>Challenge App</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/solid.css">
  <script src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
  <link rel="stylesheet" href="css/style.css">

</head>

<body>


	<div class="modal-dialog text-center">
		<div class="col-sm-8 main-section">
			<div class="modal-content">
				
				<div class="col-12 user-img">
					<img src="img/user-login.png" />
				</div>

				<form class="col-12" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Enter User Name" name="username" autocomplete="new-password" />
					</div>
					<div class="form-group">
						<input type="password" class="form-control" placeholder="Enter Password" name="password" autocomplete="new-password" />
					</div>
					<button type="submit" class="btn"><i class="fas fa-sign-in-alt"></i>Login</button>

				</form>

				<div class="col-12 forgot">
					<a href="#">Forgot Password?</a>
				</div>

			</div>
		</div>
	</div>


</body>

</html>
