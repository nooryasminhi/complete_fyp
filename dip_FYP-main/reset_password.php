<?php
include 'header.php';

$servername = "localhost"; // Change this to your database server
$dbusername = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "giveandgather"; // Database name

// Create connection
$db = new mysqli($servername, $dbusername, $password, $dbname);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['resetPassword'])) {
    $email = ($_POST['email']);
    $new_password = ($_POST['new_password']);
    // $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    
    // Update the password in the database
    $sql = "UPDATE usersreg SET password = '$new_password' WHERE email = '$email'";
    if ($db->query($sql) === TRUE) {
        echo "<script>
            alert('Password successfully reset');
            window.location.href = 'login.php';
        </script>";
    } else {
        echo "<script>
            alert('Error updating password: " . $db->error . "');
        </script>";
    }
}
?>
<!-- <div class="container mt-5">
    <div class="reset-password">
        <div class="reset-header">
            <h1 style="color: #45a049; margin: 70px;">Reset User Password</h1>
        </div> -->

        <div class="reset-form-container" style="margin-top: 200px;">
            <div class="reset-form">
                <h2>Reset Password</h2>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="email">User Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="new_password">New Password</label>
                        <input type="password" name="new_password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="resetPassword" class="btn btn-primary">Reset Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include 'footer.php';
?>

<style>
.container {
    max-width: 800px;
    margin: 0 auto;
}

.reset-password {
    margin: 100px auto;
    padding: 50px;
    background-color: #f9f9f9;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.reset-header h1 {
    text-align: center;
}

.reset-form-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: auto;
}

.reset-form {
    width: 100%;
    max-width: 600px;
}

.reset-form h2 {
    text-align: center;
    margin-bottom: 20px;
}

.reset-form .form-group {
    margin-bottom: 20px;
}

.reset-form .form-group label {
    display: block;
    margin-bottom: 5px;
}

.reset-form .form-group input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.reset-form .btn-primary {
    width: 100%;
    padding: 10px;
    background-color: #45a049;
    border: none;
    color: white;
    cursor: pointer;
    border-radius: 5px;
}

.reset-form .btn-primary:hover {
    background-color: #368036;
}
</style>