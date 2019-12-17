<?php
// Initialize the session
echo "Ha ha this is fun";

session_start();

// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $email = $passwordconf =  "";
$err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{

 	if(empty(trim($_POST["username"]))){
        $err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }

    if(empty(trim($_POST["passwordconf"]))){
        $err = "Please enter your password.";
    } else{
        $passwordconf = trim($_POST["passwordconf"]);
    }

    if(empty(trim($_POST["email"]))){
        $err = "Please enter your email.";
    } else{
        $email = trim($_POST["email"]);
    }

    if (empty($err))
    {
    	if ($password !== $passwordconf)
    		$err = "Passwords does not match.";
    }

    
    if (empty($err))
    {
    	echo "No Errors";
    }
    else
    {
    	echo err;
    }

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
  <link rel="stylesheet" href="css/style2.css">

</head>

<body>


	<div class="modal-dialog text-center">
		<div class="col-sm-8 main-section">
			<div class="modal-content">
				
				<div class="col-12 user-img">
					<img src="img/user-login.png" />
				</div>

				<form class="col-12" action="" method="post">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Enter User Name" name="username" autocomplete="new-password" />
					</div>
					<div class="form-group">
						<input type="email" class="form-control" placeholder="Enter Email" name="email" autocomplete="new-password" />
					</div>
					<div class="form-group">
						<input type="password" class="form-control" placeholder="Enter Password" name="password" autocomplete="new-password" />
					</div>
					<div class="form-group">
						<input type="password" class="form-control" placeholder="Confirm Password" name="passwordconf" autocomplete="new-password"/>
					</div>
					<button type="submit" class="btn"><i class="fas fa-sign-in-alt"></i>Register</button>

				</form>
			</div>
		</div>
	</div>


</body>

</html>
