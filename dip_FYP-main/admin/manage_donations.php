<?php
include 'inc/header.php';
include_once 'lib/Database.php';

$db = new Database();

// Handle QR code update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateQR'])) {
    if (isset($_FILES['qr_code']) && $_FILES['qr_code']['error'] == 0) {
        $qr_dir = "uploads/";
        $qr_file = $qr_dir . basename($_FILES["qr_code"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($qr_file, PATHINFO_EXTENSION));

        // Check if file already exists
        if (file_exists($qr_file)) {
            echo "<script>alert('Sorry, file already exists.');</script>";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed.');</script>";
            $uploadOk = 0;
        }

        if ($uploadOk == 1) {

             // Fetch current QR code from the database to delete the old file
             $current_qr_query = "SELECT qr_code FROM settings WHERE id = 1";
             $current_qr_result = $db->select($current_qr_query);
             if ($current_qr_result) {
                 $current_qr_row = $current_qr_result->fetch_assoc();
                 $current_qr_file = $current_qr_row['qr_code'];
                 // Check if the current QR file exists and delete it
                 if (file_exists($current_qr_file)) {
                     unlink($current_qr_file);
                 }
             }

            if (move_uploaded_file($_FILES["qr_code"]["tmp_name"], $qr_file)) {
                $qr_code = $db->link->real_escape_string($qr_file);
                $sql = "UPDATE settings SET qr_code = '$qr_code' WHERE id = 1"; 
                $db->update($sql);
                echo "<script>
                    alert('QR code updated successfully');
                    window.location.href = 'manage_donations.php';
                    </script>";
            } else {
                echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
            }
        }
    } else {
        echo "<script>alert('Sorry, there was an error with your file upload.');</script>";
    }
}

// Fetch current QR code from the database
$qr_query = "SELECT qr_code FROM settings WHERE id = 1";
$qr_result = $db->select($qr_query);
$qr_row = $qr_result->fetch_assoc();
$qr_file = $qr_row ? $qr_row['qr_code'] : '/image/qr.jpg';

// Handle adding a donation
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addDonation'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $amount = $_POST['amount'];
    $project = $_POST['project'];
    $payproof = '';

    if (isset($_FILES['payproof']) && $_FILES['payproof']['error'] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["payproof"]["name"]);
        move_uploaded_file($_FILES["payproof"]["tmp_name"], $target_file);
        $payproof = $target_file;
    }

    $sql = "INSERT INTO donation (name, email, amount, project, payproof) VALUES ('$name', '$email', '$amount', '$project', '$payproof')";
    $db->insert($sql);
    header("Location: manage_donations.php");
}

// Handle deletion of a donation
if (isset($_GET['del'])) {
    $id = $_GET['del'];
    $sql = "SELECT payproof FROM donation WHERE id = $id";
    $result = $db->select($sql);
    if ($result) {
        $row = $result->fetch_assoc();
        if (file_exists($row['payproof'])) {
            unlink($row['payproof']);
        }
    }

    $sql = "DELETE FROM donation WHERE id = $id";
    $db->delete($sql);
    header("Location: manage_donations.php");
}

// Fetch projects from the database
$project_query = "SELECT * FROM charitymanage"; 
$project_result = $db->select($project_query);

$sql = "SELECT * FROM donation";
$result = $db->select($sql);
?>

<h2>Manage Donations</h2>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="qr_code">Update QR Code Image</label>
        <input type="file" name="qr_code" class="form-control" required>
    </div>
    <button type="submit" name="updateQR" class="btn btn-primary">Update QR Code</button>
</form>

<h3>Current QR Code</h3>
<a href="<?php echo $qr_file; ?>" target="_blank">View QR for Payment</a>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="name">Donor Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="email">Donor Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="amount">Donation Amount:</label>
        <input type="number" id="amount" name="amount" min="1" required>
    </div>
    <div class="form-group">
        <label for="project">Donation Project:</label>
        <select id="project" name="project" required>
            <option value="">Select a project</option>
            <?php
            if ($project_result->num_rows > 0) {
                while ($row = $project_result->fetch_assoc()) {
                    echo '<option value="' . ($row['project']) . '">' . ($row['project']) . '</option>';
                }
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="payproof">Payment Proof (Image)</label>
        <input type="file" name="payproof" class="form-control">
    </div>
    <button type="submit" name="addDonation" class="btn btn-primary">Add Donation</button>
</form>

<table class="table table-striped mt-5">
    <thead>
        <tr>
            <th>ID</th>
            <th>Donor Name</th>
            <th>Donor Email</th>
            <th>Amount</th>
            <th>Project</th>
            <th>Payment Proof</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['amount']}</td>
                        <td>{$row['project']}</td>
                        <td>";
                if (!empty($row['payproof'])) {
                    $path_parts = explode('/', $row['payproof']);
                    if (count($path_parts) >= 2) {
                        $newurl = $path_parts[count($path_parts) - 2] . '/' . $path_parts[count($path_parts) - 1];
                        echo "<a href='$newurl' target='_blank'>View Proof</a>";
                    } else {
                        echo "Invalid path";
                    }
                } else {
                    echo "No Proof";
                }
                echo "</td>
                        <td>
                            <a href='edit_donation.php?id={$row['id']}' class='btn btn-info btn-sm'>Edit</a>
                            <a href='manage_donations.php?del={$row['id']}' class='btn btn-danger btn-sm'>Delete</a>
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
