<?php
include 'inc/header.php';
include_once 'lib/Database.php';

$db = new Database();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addMessage'])) {
    $sender_name = ($_POST['sender_name']);
    $sender_email = ($_POST['sender_email']);
    $message = ($_POST['message']);
    $sql = "INSERT INTO contactus (Name, Email, Message) VALUES ('$sender_name', '$sender_email', '$message')";
    if ($db->insert($sql)) {
        header("Location: manage_messages.php");
        exit();
    } else {
        echo "<script>alert('Error adding message');</script>";
    }
}
if (isset($_GET['del'])) {
    $id = $_GET['del'];
    $sql = "DELETE FROM contactus WHERE id = $id";

    if ($db->delete($sql)) {
        echo "<script>alert('Message deleted successfully');</script>";
        header("Location: manage_messages.php");
        exit();
    } else {
        echo "<script>alert('Error deleting message');</script>";
    }
}

$sql = "SELECT * FROM contactus";
$result = $db->select($sql);
?>

<h2>Manage Messages</h2>
<form action="" method="post">
    <div class="form-group">
        <label for="sender_name">Sender Name</label>
        <input type="text" name="sender_name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="sender_email">Sender Email</label>
        <input type="email" name="sender_email" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="message">Message</label>
        <textarea name="message" class="form-control" required></textarea>
    </div>
    <button type="submit" name="addMessage" class="btn btn-primary">Add Message</button>
</form>

<table class="table table-striped mt-5">
    <thead>
        <tr>
            <th>ID</th>
            <th>Sender Name</th>
            <th>Sender Email</th>
            <th>Message</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['Name']}</td>
                        <td>{$row['Email']}</td>
                        <td>{$row['Message']}</td>
                        <td>
                            <a href='edit_message.php?id={$row['id']}' class='btn btn-info btn-sm'>Edit</a>
                            <a href='manage_messages.php?del={$row['id']}' class='btn btn-danger btn-sm'>Delete</a>
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
