<?php
include_once 'lib/Database.php';
include_once 'lib/Session.php';
Session::init();

$db = new Database();

// $servername = "localhost"; // Change this to your database server
// $dbusername = "root"; // Change this to your database username
// $password = ""; // Change this to your database password
// $dbname = "giveandgather"; // Database name

// Create connection
// $db = new mysqli($host, $user, $pass, $dbname);

// Check connection
// if ($db->connect_error) {
//     die("Connection failed: " . $db->connect_error);
// }

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reset'])) {
    $email = $_POST['email'];
    $new_password = $_POST['new_password'];
    // $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    // Hash the new password
    // $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Update the password in the database
    $sql = "UPDATE tbl_users SET password='$new_password' WHERE email='$email'";
    
    if ($db->update($sql)) {
        echo "<script>alert('Password reset successfully!');</script>";
        header("Location: login.php");
    } else {
        echo "<script>alert('Error updating record:  ');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body></body>

<div class="card">
  <div class="card-header">
    <h3 class='text-center'><i class="fas fa-key mr-2"></i>Reset Password</h3>
  </div>
  <div class="card-body">
    <div style="width:450px; margin:0px auto">
      <form class="" action="" method="post">
        <div class="form-group">
          <label for="email">Email address</label>
          <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="new_password">New Password</label>
          <input type="password" name="new_password" class="form-control" required>
        </div>
        <div class="form-group">
          <button type="submit" name="reset" class="btn btn-success">Reset Password</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php
include 'inc/footer.php';
?>
