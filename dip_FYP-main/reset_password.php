<?php
include 'inc/header.php';
include_once 'lib/Database.php';
include_once 'lib/Session.php';

Session::checkSession();

$db = new Database();
$admin_id = Session::get('id');

// Update admin details if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateAdmin'])) {
    $username = $db->link->real_escape_string($_POST['username']);
    $email = $db->link->real_escape_string($_POST['email']);
    
    $sql = "UPDATE tbl_users SET username = '$username', email = '$email' WHERE id = $admin_id";
    $db->update($sql);
    header("Location: login.php"); // Redirect to avoid form resubmission
    exit();
}

// Fetch admin details from the tbl_users table
$sql = "SELECT id, username, email FROM tbl_users WHERE id = $admin_id";
$result = $db->select($sql);

if ($result) {
    $admin = $result->fetch_assoc();
} else {
    $admin = null;
}
?>

<div class="container mt-5">
    <h2 class="mb-4">Welcome to the Admin Dashboard</h2>

    <h3>Admin Details</h3>
    <?php if ($admin): ?>
        <form action="" method="post">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo htmlspecialchars($admin['id']); ?></td>
                        <td>
                            <input type="text" name="username" class="form-control" value="<?php echo htmlspecialchars($admin['username']); ?>" required>
                        </td>
                        <td>
                            <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($admin['email']); ?>" required>
                        </td>
                        <td>
                            <button type="submit" name="updateAdmin" class="btn btn-primary">Update</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
        <a href="reset_password.php" class="btn btn-warning mt-3">Reset Password</a>
    <?php else: ?>
        <p>No admin details found.</p>
    <?php endif; ?>
</div>

<?php
include 'inc/footer.php';
?>

<style>
.container {
    max-width: 800px;
    margin: 0 auto;
}

.table th,
.table td {
    vertical-align: middle;
}

.table input.form-control {
    display: inline-block;
    width: auto;
}

.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
}

.btn-primary:hover {
    background-color: #0056b3;
    border-color: #004085;
}

.btn-warning {
    background-color: #ffc107;
    border-color: #ffc107;
}

.btn-warning:hover {
    background-color: #e0a800;
    border-color: #d39e00;
}
</style>
