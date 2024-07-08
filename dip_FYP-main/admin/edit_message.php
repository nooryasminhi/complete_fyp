<?php
include 'inc/header.php';
include_once 'lib/Database.php';

$db = new Database();
$message_id = isset($_GET['id']) ? $_GET['id'] : null;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateMessage'])) {
    $sender_name = $db->link->real_escape_string($_POST['sender_name']);
    $sender_email = $db->link->real_escape_string($_POST['sender_email']);
    $message = $db->link->real_escape_string($_POST['message']);
    $sql = "UPDATE contactus SET Name='$sender_name', Email='$sender_email', Message='$message' WHERE ID='$message_id'";
    $db->update($sql);
    header("Location: manage_messages.php");
    exit();
}

if ($message_id) {
    $sql = "SELECT * FROM contactus WHERE ID = $message_id";
    $result = $db->select($sql);
    if ($result) {
        $message = $result->fetch_assoc();
    } else {
        echo "<script>alert('Message not found.');</script>";
        header("Location: manage_messages.php");
        exit();
    }
} else {
    echo "<script>alert('No message ID provided.');</script>";
    header("Location: manage_messages.php");
    exit();
}
?>

<div class="container mt-5">
    <h2 class="mb-4">Edit Message</h2>
    <form action="" method="post">
        <div class="form-group">
            <label for="sender_name">Sender Name</label>
            <input type="text" name="sender_name" class="form-control" value="<?php echo htmlspecialchars($message['Name']); ?>" required>
        </div>
        <div class="form-group">
            <label for="sender_email">Sender Email</label>
            <input type="email" name="sender_email" class="form-control" value="<?php echo htmlspecialchars($message['Email']); ?>" required>
        </div>
        <div class="form-group">
            <label for="message">Message</label>
            <textarea name="message" class="form-control" required><?php echo htmlspecialchars($message['Message']); ?></textarea>
        </div>
        <button type="submit" name="updateMessage" class="btn btn-primary">Update Message</button>
    </form>
</div>

<?php
include 'inc/footer.php';
?>
