<?php
include('db.php');
include('header.php');

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $db->real_escape_string($_POST['name']);
    $email = $db->real_escape_string($_POST['email']);
    $amount = $db->real_escape_string($_POST['amount']);
    $project = $db->real_escape_string($_POST['project']);

    // File upload handling
    $target_dir = "admin/uploads/"; //correct dont change
    $target_file = $target_dir . basename($_FILES["myfile"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "<script>alert('Sorry, file already exists.');</script>";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["myfile"]["size"] > 500000) {
        echo "<script>alert('Sorry, your file is too large.');</script>";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg" && $fileType != "pdf") {
        echo "<script>alert('Sorry, only JPG, JPEG, PNG & PDF files are allowed.');</script>";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "<script>alert('Sorry, your file was not uploaded.');</script>";
    // If everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["myfile"]["tmp_name"], $target_file)) {
            $payment_proof = $db->real_escape_string($target_file);

            // Insert data into the donation table
            $sql = "INSERT INTO donation (name, email, amount, project, payproof) VALUES ('$name', '$email', '$amount', '$project', '$payment_proof')";

            if ($db->query($sql) === TRUE) {
                echo "<script>alert('Donation successful! Thank you!');</script>";
            } else {
                echo "Error: " . $sql . "<br>" . $db->error;
            }
        } else {
            echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
        }
    }
}

// Fetch projects from the database
$project_query = "SELECT * FROM charitymanage"; // Assuming you have a 'projects' table
$project_result = $db->query($project_query);
?>
<main class="l-main">
    <!--========== DONATION SECTION ==========-->
    <div class="donation">
    <div class="donate-header">
        <h1 style="color: #45a049; margin: 70px;">Make a Donation</h1>   
    </div>

    <div class="donation-form-container">
        <div class="donation-form">
            <h2>Make a Donation</h2>
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="donor_name">Your Name:</label>
                    <input type="text" id="donor_name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="donor_email">Your Email:</label>
                    <input type="email" id="donor_email" name="email" required>
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
                    <img style="height: 300px; margin-bottom: 20px;" src="image/qr.jpg" alt="QR Code for Payment">
                </div>
                <div class="form-group">
                    <label for="myfile">Upload your proof of payment:</label>
                    <input type="file" id="myfile" name="myfile" required>
                </div>
                <div class="form-group">
                    <button type="submit">Donate Now</button>
                </div>
            </form>
        </div>
    </div>
    </div>
</main>

<style>
    body {
        text-align: center;
    }
    .donation{
        margin: 100px;
    }
    .donate-header {
        margin: 70px;
    }
    .donation-form-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
    .donation-form {
        width: 100%;
        max-width: 600px;
        padding: 40px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        background-color: #fff;
    }
    .donation-form h2 {
        margin-bottom: 20px;
        font-size: 24px;
        color: #45a049;
    }
    .form-group {
        margin-bottom: 15px;
        text-align: left;
    }
    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }
    .form-group input[type="text"],
    .form-group input[type="email"],
    .form-group input[type="number"],
    .form-group select,
    .form-group button,
    .form-group input[type="file"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }
    .form-group button {
        background-color: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
        margin-top: 10px;
    }
    .form-group button:hover {
        background-color: #45a049;
    }
</style>

<?php
include "footer.php";
?>
</html>