<?php
include 'inc/header.php';
include_once 'lib/Database.php';

$db = new Database();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM charitymanage WHERE id = $id";
    $result = $db->select($sql);
    if ($result) {
        $charity = $result->fetch_assoc();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateCharity'])) {
    $project = $_POST['project'];
    $description = $_POST['description'];
    $sql = "UPDATE charitymanage SET project='$project', description='$description' WHERE id=$id";
    $db->update($sql);
    header("Location: manage_charities.php");
}
?>

<h2>Edit Charity</h2>
<form action="" method="post">
    <div class="form-group">
        <label for="project">Name</label>
        <input type="text" name="project" class="form-control" value="<?php echo $charity['project']; ?>" required>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" class="form-control" required><?php echo $charity['description']; ?></textarea>
    </div>
    <button type="submit" name="updateCharity" class="btn btn-primary">Update Charity</button>
</form>

<?php
include 'inc/footer.php';
?>
