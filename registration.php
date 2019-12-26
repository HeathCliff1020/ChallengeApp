<?php
// Initialize the session
session_start();


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master\src\Exception.php';
require 'PHPMailer-master\src\PHPMailer.php';
require 'PHPMailer-master\src\SMTP.php';

// Include config file
require_once "config.php";
 
unset($_SESSION["verify"]);

// Define variables and initialize with empty values
$username = $password = $email = $passwordconf =  "";
$err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{

    $password = trim($_POST["password"]);
    $passwordconf = trim($_POST["passwordconf"]);
    
    if (empty($err))
    {
    	if ($password !== $passwordconf)
    		$err = "Passwords does not match.";
    }

    $username     =   mysqli_real_escape_string($link, $_POST['username']);
    $email        =   mysqli_real_escape_string($link, $_POST['email']);
    $password     =   mysqli_real_escape_string($link, $_POST['password']);
    $passwordconf =   mysqli_real_escape_string($link, $_POST['passwordconf']);
    
    if (empty($err))
    {
      $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
      $result = mysqli_query($link, $user_check_query);
      $user = mysqli_fetch_assoc($result);
      
      if ($user) { // if user exists
        if ($user['username'] === $username) {
          $err = "Username already exists";
        }

        if ($user['email'] === $email) {
          $err = "Email already exists.";
        }
      }

      if (empty($err))
      {
        $password = md5($password);//encrypt the password before saving in the database
        $hash = md5( rand(0,1000) );

        $query = "INSERT INTO users(username, password, email, is_verified, hash) VALUES('$username', '$password', '$email', 0, '$hash')";
        
        if (mysqli_query($link, $query))
        {

          /* Namespace alias. */
          $mail = new PHPMailer(); // create a new object
          $mail->IsSMTP(); // enable SMTP
          $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
          $mail->SMTPAuth = true; // authentication enabled
          $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
          $mail->Host = "smtp.gmail.com";
          $mail->Port = 587; // or 587
          $mail->IsHTML(true);
          $mail->Username = "mukeshbisht1020@gmail.com";
          $mail->Password = "asdfgh123456";
          $mail->SetFrom("mukeshbisht1020@gmail.com");
          $mail->Subject = "Test";
          $mail->Body = "Thanks for signing up!
                          Your account has been created, you can login with the following credentials after you have activated your account by pressing 
                          the url below.
 
                          ------------------------
                          Username: '.$name.'
                          ------------------------
                           
                          Please click this link to activate your account:
                          http://localhost/challengeApp/verify.php?email=$email&hash=$hash";
          $mail->AddAddress($email);

          if(!$mail->Send()) {
              echo "Mailer Error: " . $mail->ErrorInfo;
           } else {

              if (isset($_SESSION["loggedin"]))
              {
                unset($_SESSION["loggedin"]);
              }

              $_SESSION['verify'] = true;
              header('location: verificationMessage.php');
            }
        }
        else
        {
          echo "erron in the database.";
          echo mysqli_error($link);
        }
      }

      else
      {
        echo $err;
      }
    }
    else
    {
      echo $err;
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
						<input type="text" class="form-control" placeholder="Enter User Name" autocomplete="new-password" name="username" required/>
					</div>
					<div class="form-group">
						<input type="email" class="form-control" placeholder="Enter Email" autocomplete="new-password" name="email" required />
					</div>
					<div class="form-group">
						<input type="password" class="form-control" placeholder="Enter Password" autocomplete="new-password" name="password" required/>
					</div>
					<div class="form-group">
						<input type="password" class="form-control" placeholder="Confirm Password" autocomplete="new-password" name="passwordconf" required/>
					</div>
					<button type="submit" class="btn"><i class="fas fa-sign-in-alt"></i>Register</button>

				</form>
			</div>
		</div>
	</div>


</body>

</html>
