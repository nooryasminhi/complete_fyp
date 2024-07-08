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

// Fetch donations made by the user
$donation_sql = "SELECT d.id, d.amount, d.payproof, c.project, c.description
                 FROM donation d
                 JOIN charitymanage c ON d.project = c.project
                 WHERE d.email = ?";
$donation_stmt = $db->prepare($donation_sql);
$donation_stmt->bind_param("s", $email); // Use the user's email to filter donations
$donation_stmt->execute();
$donation_stmt->bind_result($donation_id, $amount, $payproof, $project, $description); // Bind the result columns to variables
$donations = [];
while ($donation_stmt->fetch()) {
    $donations[] = ['id' => $donation_id, 'amount' => $amount, 'payproof' => $payproof, 'project' => $project, 'description' => $description];
}
$donation_stmt->close(); // Close the statement

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
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        a {
            color: blue;
            text-decoration: underline;
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
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Update Details</button>
            <a href="logout.php">Logout</a>
        </form>

        <!-- Display user donations -->
        <h2>Your Donations</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Project Name</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Payment Proof</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($donations) > 0): ?>
                    <?php foreach ($donations as $donation): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($donation['id']); ?></td>
                            <td><?php echo htmlspecialchars($donation['project']); ?></td>
                            <td><?php echo htmlspecialchars($donation['description']); ?></td>
                            <td><?php echo htmlspecialchars($donation['amount']); ?></td>
                            <td>
                                <?php
                                $path_parts = explode('/', $donation['payproof']);
                                $payproof_path = end($path_parts);
                                ?>
                                <a href="admin/uploads/<?php echo htmlspecialchars($payproof_path); ?>" target="_blank">View Proof</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">You have not made any donations yet.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        
    </div>

    <?php include "footer.php"; ?>
</body>
</html>
