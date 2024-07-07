<?php
session_start();
include('header.php');
include('db.php');
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "giveandgather";

// Create connection
$db = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

if (!isset($_SESSION['user_id'])) {
    header("Location: Index.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_username = $_POST['username'];
    $new_email = $_POST['email'];
    $new_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Update user details in the database
    $update_sql = "UPDATE usersreg SET username=?, email=?, password=? WHERE id=?";
    $update_stmt = $db->prepare($update_sql);
    $update_stmt->bind_param("sssi", $new_username, $new_email, $new_password, $user_id);
    if ($update_stmt->execute()) {
        echo "<script>alert('Details updated successfully');</script>";
    } else {
        echo "<script>alert('Error updating details: " . $update_stmt->error . "');</script>";
    }
    $update_stmt->close();
}

// Fetch user details from the database
$sql = "SELECT username, email, password FROM usersreg WHERE id=?";
$stmt = $db->prepare($sql);
$stmt->bind_param("i", $user_id); // Bind the user ID parameter
$stmt->execute();
$stmt->bind_result($username, $email, $password); // Bind the result columns to variables
$stmt->fetch(); // Fetch the result
$stmt->close(); // Close the statement

// Close the database connection
$db->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
        .content {
            margin: 70px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .user-details-item {
            margin: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        input {
            padding: 10px;
            margin: 10px 0;
        }
        button {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="content">
        <form method="POST" action="">
            <div class="user-details-item">
                <label for="username"><strong>Username:</strong></label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
            </div>
            <div class="user-details-item">
                <label for="email"><strong>Email:</strong></label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            <div class="user-details-item">
                <label for="password"><strong>Password:</strong></label>
                <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($password); ?>" required>
            </div>
            <button type="submit">Update Details</button>
            <a href="logout.php">Logout</a>
        </form>
    </div>

    <?php include "footer.php"; ?>
</body>
</html>
