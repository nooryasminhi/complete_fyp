<?php
include 'inc/header.php';
include_once 'lib/Database.php';

$db = new Database();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM tbl_users WHERE id = $id";
    $result = $db->select($sql);
    if ($result) {
        $user = $result->fetch_assoc();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateAdmin'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = sha1($_POST['password']);
    $sql = "UPDATE tbl_users SET username='$username', email='$email', password='$password' WHERE id=$id";
    $db->update($sql);
    header("Location: manage_admin.php");
}
?>

<h2>Edit User</h2>
<form action="" method="post">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" class="form-control" value="<?php echo $user['username']; ?>" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" value="<?php echo $user['email']; ?>" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control" value="" required>
    </div>
    <button type="submit" name="updateAdmin" class="btn btn-primary">Update User</button>
</form>

<?php
include 'inc/footer.php';
?>
