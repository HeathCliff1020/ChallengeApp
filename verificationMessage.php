<?php 
  
    session_start();
    
    if(!isset($_SESSION["verify"]) || $_SESSION["verify"] !== true)
    {
      header("location: login.php");
      exit;
  }
 
  if ($_SERVER["REQUEST_METHOD"] == "POST")
  {

    unset($_SESSION["loggedin"]);
    unset($_SESSION["verify"]);
    header("Location: login.php");
  }

?>

<html>

<head>
  <title>Challenge App</title>
</head>

<body>

  <h1>A verification mail has been sent to your email address, click the verification button to verify your account.</h1>

  <form action="" method="post">
    <input type="submit" name="Logout" value="Login" />
  </form>

</body>

</html>