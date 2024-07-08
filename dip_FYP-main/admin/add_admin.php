<?php
include 'inc/header.php';
include_once 'lib/Database.php';

$db = new Database();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addAdmin'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = ($_POST['password']);

    $checkEmailSql = "SELECT * FROM tbl_users WHERE email = '$email'";
    $emailResult = $db->select($checkEmailSql);

    if ($emailResult) {
        echo "<script>
        alert('Email already exists!');
        window.location.href = 'add_admin.php';
        </script>";
    } else {
        $sql = "INSERT INTO tbl_users (username, email, password) VALUES ('$username', '$email', '$password')";
        $db->insert($sql);
        echo "<script>
        alert('Admin added successfully!');
        window.location.href = 'index.php';
        </script>";
    }
}

    // $sql = "INSERT INTO tbl_users (username, email, password) VALUES ('$username', '$email', '$password')";
    // $db->insert($sql);
    // echo "<script>
    // alert('$password');
    // window.location.href = 'index.php';
    // </script>";

?>

<h2>Add Admin</h2>
<form action="" method="post">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <button type="submit" name="addAdmin" class="btn btn-primary">Add Admin</button>
</form>

<?php
include 'inc/footer.php';
?>