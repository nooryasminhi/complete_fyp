<?php
include 'inc/header.php';
include_once 'lib/Database.php';

$db = new Database();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addCharity'])) {
    $project = $_POST['project'];
    $description = $_POST['description'];
    $sql = "INSERT INTO charitymanage (project, description) VALUES ('$project', '$description')";
    $db->insert($sql);
    header("Location: manage_charities.php");
}

if (isset($_GET['del'])) {
    $id = $_GET['del'];
    $sql = "DELETE FROM charitymanage WHERE id = $id";
    $db->delete($sql);
    header("Location: manage_charities.php");
}

$sql = "SELECT * FROM charitymanage";
$result = $db->select($sql);
?>

<h2>Manage Charities</h2>
<form action="" method="post">
    <div class="form-group">
        <label for="project">Project</label>
        <input type="text" name="project" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" class="form-control" required></textarea>
    </div>
    <button type="submit" name="addCharity" class="btn btn-primary">Add Charity</button>
</form>

<table class="table table-striped mt-5">
    <thead>
        <tr>
            <th>ID</th>
            <th>Project</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['project']}</td>
                        <td>{$row['description']}</td>
                        <td>
                            <a href='edit_charity.php?id={$row['id']}' class='btn btn-info btn-sm'>Edit</a>
                            <a href='manage_charities.php?del={$row['id']}' class='btn btn-danger btn-sm'>Delete</a>
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