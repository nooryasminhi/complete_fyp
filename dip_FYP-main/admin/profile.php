<?php
include 'inc/header.php';
include_once 'lib/Session.php';
include_once 'lib/Database.php';
Session::CheckSession();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "giveandgather";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateProfile'])) {
    $id = Session::get('id');
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = !empty($_POST['password']) ? password_hash($conn->real_escape_string($_POST['password']), PASSWORD_BCRYPT) : null;

    if ($password) {
        $sql = "UPDATE tbl_users SET username='$name', email='$email', password='$password' WHERE id=$id";
    } else {
        $sql = "UPDATE tbl_users SET username='$name', email='$email' WHERE id=$id";
    }

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Profile updated successfully'); window.location.href='profile.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$id = Session::get('id');
$sql = "SELECT * FROM tbl_users WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "No user found";
}
?>

<div class="card">
  <div class="card-header">
    <h3><i class="fas fa-user mr-2"></i>Profile <span class="float-right">Welcome! <strong>
      <span class="badge badge-lg badge-secondary text-white">
      <?php
      $username = Session::get('username');
      if (isset($username)) {
        echo $username;
      }
      ?></span>
    </strong></span></h3>
  </div>
  <div class="card-body pr-2 pl-2">
    <form action="" method="POST">
      <div class="form-group">
        <label for="name">Username</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo $user['username']; ?>" required>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>" required>
      </div>
      <div class="form-group">
        <label for="password">Password (leave blank if not changing)</label>
        <input type="password" class="form-control" id="password" name="password">
      </div>
      <button type="submit" name="updateProfile" class="btn btn-primary">Update Profile</button>
    </form>
  </div>
</div>

<style>
  .btn-green {
    background-color: #28a745;
    border-color: #28a745;
    color: white;
  }

  .btn-darkgreen {
    background-color: #006400;
    border-color: #006400;
    color: white;
  }

  .btn-green:hover,
  .btn-darkgreen:hover {
    background-color: #218838;
    border-color: #1e7e34;
  }
</style>

<?php
include 'inc/footer.php';
?>
