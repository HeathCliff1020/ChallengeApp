<?php 
    
  require_once "config.php";

  if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
    // Verify data
    $email = mysqli_real_escape_string($link, $_GET['email']); // Set email variable
    $hash = mysqli_real_escape_string($link, $_GET['hash']); // Set hash variable

    $user_check_query = "SELECT * FROM users WHERE email='$email' AND hash='$hash'";
    $result = mysqli_query($link, $user_check_query);

    if ($result)
    {
      echo mysqli_num_rows($result);
      if (mysqli_num_rows($result) > 0)
      {
        $query = "UPDATE users SET is_verified='1' WHERE email='$email' AND hash='$hash'";
        $res = mysqli_query($link, $query);

        if ($res)
        {
          echo "Your account has been verified.";
        }
        else
        {
          echo "Database Error";
        }
      }
      else
      {
        echo "Nothing in the database.";
      }
    }
    else 
    {
      echo 'Database error';
    }

  }else{
    echo "Invalid Link";
    header("Location: login.php");
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

  <form action="" method="post">
    <input type="submit" name="Logout" value="Login" />
  </form>

</body>

</html>