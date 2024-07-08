<?php
include 'inc/header.php';
include_once 'lib/Database.php';
include_once 'lib/Session.php';

Session::checkSession();

$db = new Database();
$donation_id = isset($_GET['id']) ? $_GET['id'] : null;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateDonation'])) {
    $name = $db->link->real_escape_string($_POST['name']);
    $email = $db->link->real_escape_string($_POST['email']);
    $amount = $db->link->real_escape_string($_POST['amount']);
    $project = $db->link->real_escape_string($_POST['project']);
    $payproof = '';

    if (isset($_FILES['payproof']) && $_FILES['payproof']['error'] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["payproof"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "<script>alert('Sorry, file already exists.');</script>";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["payproof"]["size"] > 500000) { // 500KB limit
            echo "<script>alert('Sorry, your file is too large.');</script>";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "pdf") {
            echo "<script>alert('Sorry, only JPG, JPEG, PNG & PDF files are allowed.');</script>";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "<script>alert('Sorry, your file was not uploaded.');</script>";
        } else {
            if (move_uploaded_file($_FILES["payproof"]["tmp_name"], $target_file)) {
                $payproof = $target_file;
            } else {
                echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
            }
        }
    }

    if ($payproof != '') {
        $sql = "UPDATE donation SET name='$name', email='$email', amount='$amount', project='$project', payproof='$payproof' WHERE id='$donation_id'";
    } else {
        $sql = "UPDATE donation SET name='$name', email='$email', amount='$amount', project='$project' WHERE id='$donation_id'";
    }

    if ($db->update($sql)) {
        echo "<script>alert('Donation updated successfully!');</script>";
        header("Location: manage_donations.php");
        exit();
    } else {
        echo "<script>alert('Error updating record: " . $db->link->error . "');</script>";
    }
}

if ($donation_id) {
    $sql = "SELECT * FROM donation WHERE id = $donation_id";
    $result = $db->select($sql);
    if ($result) {
        $donation = $result->fetch_assoc();
    } else {
        echo "<script>alert('Donation not found.');</script>";
        header("Location: manage_donations.php");
        exit();
    }
} else {
    echo "<script>alert('No donation ID provided.');</script>";
    header("Location: manage_donations.php");
    exit();
}
?>

<div class="container mt-5">
    <h2 class="mb-4">Edit Donation</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Donor Name</label>
            <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($donation['name']); ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Donor Email</label>
            <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($donation['email']); ?>" required>
        </div>
        <div class="form-group">
            <label for="amount">Donation Amount</label>
            <input type="number" name="amount" class="form-control" value="<?php echo htmlspecialchars($donation['amount']); ?>" required>
        </div>
        <div class="form-group">
            <label for="project">Donation Project</label>
            <input type="text" name="project" class="form-control" value="<?php echo htmlspecialchars($donation['project']); ?>" required>
        </div>
        <div class="form-group">
            <label for="payproof">Payment Proof (Image)</label>
            <input type="file" name="payproof" class="form-control">
            <?php if (!empty($donation['payproof'])): ?>
                <br>
                <img src="<?php echo $donation['payproof']; ?>" alt="Payment Proof" style="width: 200px;">
            <?php endif; ?>
        </div>
        <button type="submit" name="updateDonation" class="btn btn-primary">Update Donation</button>
    </form>
</div>

<?php
include 'inc/footer.php';
?>
