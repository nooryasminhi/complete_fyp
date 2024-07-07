<?php
include_once 'lib/Session.php';
include_once 'lib/Database.php';
Session::init();

$db = new Database();

// Start output buffering
ob_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $email = $db->link->real_escape_string($_POST['email']);
    $password = $db->link->real_escape_string($_POST['password']);
    $password = ($password);

    $sql = "SELECT * FROM tbl_users WHERE email = '$email' AND password = '$password' ";
    $result = $db->select($sql);

    if ($result) {
      echo "succes query";
        $value = $result->fetch_assoc();
        if ($value) {
            Session::set('login', true);
            Session::set('id', $value['id']);
            Session::set('username', $value['username']);
            Session::set('email', $value['email']);
            Session::set('password', $value['password']);
            header("Location: index.php");
            exit();  
        } else {
            $error = "Email or Password did not match!";
        }
    } else {
        $error = "Email or Password did not match!";
    }
}

$logout = Session::get('logout');
if (isset($logout)) {
    echo $logout;
    Session::set('logout', null);
}

// End output buffering and flush the output
ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h3 class='text-center'>Admin Login</h3>
        </div>
        <div class="card-body">
            <div style="width:450px; margin:0 auto">
                <?php
                if (isset($error)) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
                ?>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="login" class="btn btn-success">Login</button>
                    </div>
                    <a href="reset_password.php">Forgot password?</a>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>