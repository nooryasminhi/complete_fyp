<?php 
session_start(); 
include 'db.php';
include 'session.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

     //Fetch user from the database
    $sql = "SELECT id, password FROM usersreg WHERE email=?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($user_id, $hashed_password);
    $stmt->fetch();
    $stmt->close();

    // Verify the password
    if (password_verify($password, $hashed_password)) {
        $_SESSION['user_id'] = $user_id;
        header("Location: userDashboard.php");
        exit();
    } else {
        $error_message = "Password incorrect";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
<?php include 'header.php'; ?>

<!--========== LOGIN ==========-->
<div class="wrapper">
  <div class="container">
    <div class="col-left">
      <div class="login-text">
        <h2>Welcome Back</h2>
        <p>Create your account.<br>It's totally free.</p>
        <a class="btn" href="userreg.php">Sign Up</a>
      </div>
    </div>
    <div class="col-right">
      <div class="login-form">
        <h2>Login</h2>
        <form action="" method="post">
          <p>
            <label>Email address<span>*</span></label>
            <input type="text" name="email" placeholder="Email" required>
          </p>
          <p>
            <label>Password<span>*</span></label>
            <input type="password" name="password" placeholder="Password" required>
          </p>
          <p>
            <input type="submit" value="Sign In" />
          </p>
          <a href="reset_password.php">Forgot password?</a>
        </form>
        <?php
        if (isset($error_message)) {
            echo '<script>alert("'.$error_message.'");</script>';
        }
        ?>
      </div>
    </div>
  </div>
</div>
<?php include 'footer.php'; ?>
</body>
</html>
