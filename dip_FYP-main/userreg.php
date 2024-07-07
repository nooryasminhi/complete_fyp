<!DOCTYPE html>
<html lang="en">
<?php
    include 'db.php';
    include 'header.php';
?>
 <!--===== SIGN UP FORM =====-->
<div class="signupFrm">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form">
        <h1 class="title">Sign up</h1>

        <div class="inputContainer">
            <input type="email" class="input" placeholder="Enter your email" name="email" required>
            <label for="" class="label">Email</label>
        </div>

        <div class="inputContainer">
            <input type="text" class="input" placeholder="Enter your username" name="username" required>
            <label for="" class="label">Username</label>
        </div>

        <div class="inputContainer">
            <input type="password" class="input" placeholder="Enter your password" name="password" required>
            <label for="" class="label">Password</label>
        </div>

        <div class="inputContainer">
            <input type="password" class="input" placeholder="Confirm your password" name="confirm_password" required>
            <label for="" class="label">Confirm Password</label>
        </div>

        <button type="submit" class="button">Sign Up</button>
    </form>
</div>


<?php
// Process form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo '<script type ="text/JavaScript">';  
        echo 'alert(" Password does not match ")';  
        echo '</script>';  
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if email already exists
    $select = mysqli_query($db, "SELECT email FROM usersreg WHERE email = '$email'") or exit(mysqli_error($db));
    if (mysqli_num_rows($select)) {
        echo '<script type ="text/JavaScript">';  
        echo 'alert(" This email is already being used ")';  
        echo '</script>'; 
        exit();
    }

    // Insert user data into database
    $sql = "INSERT INTO usersreg (email, username, password) VALUES ('$email', '$username', '$hashed_password')";

    if ($db->query($sql) === TRUE) {
        echo '<script type ="text/JavaScript">';  
        echo 'alert(" Your account has been created! ")';  
        echo '</script>';
        header("Location: userDashboard.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }
}

// Close connection
$db->close();
?>
</body>
</html>
