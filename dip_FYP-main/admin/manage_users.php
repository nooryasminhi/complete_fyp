<?php
include 'inc/header.php';
include_once 'lib/Database.php';

$db = new Database();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addUser'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = sha1($_POST['password']);
    $sql = "INSERT INTO usersreg (username, email, password) VALUES ('$username', '$email', '$password')";
    $db->insert($sql);
    header("Location: manage_users.php");
}

if (isset($_GET['del'])) {
    $id = $_GET['del'];
    $sql = "DELETE FROM usersreg WHERE id = $id";
    $db->delete($sql);
    header("Location: manage_users.php");
}

$sql = "SELECT * FROM usersreg";
$result = $db->select($sql);
?>

<h2>Manage Users</h2>
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
    <button type="submit" name="addUser" class="btn btn-primary">Add User</button>
</form>

<table class="table table-striped mt-5">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['username']}</td>
                        <td>{$row['email']}</td>
                        <td>
                            <a href='edit_user.php?id={$row['id']}' class='btn btn-info btn-sm'>Edit</a>
                            <a href='manage_users.php?del={$row['id']}' class='btn btn-danger btn-sm'>Delete</a>
                        </td>
                      </tr>";
            }
        }
        ?>
    </tbody>
</table>

<?php
include 'inc/footer.php';
?>
