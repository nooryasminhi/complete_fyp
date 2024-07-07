<?php
include 'inc/header.php';
include_once 'lib/Database.php';

$db = new Database();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addAdmin'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = sha1($_POST['password']);
    $sql = "INSERT INTO tbl_users (username, email, password) VALUES ('$username', '$email', '$password')";
    $db->insert($sql);
    header("Location: add_admin.php");
}
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
