<?php
// Ensure the correct paths to your files
include_once 'db.php'; 
include_once 'session.php';
// Path to your db.php
// include_once 'session.php'; // Path to your session.php

// Initialize the session
// Session::init();
// Session::checkSession();
Session::init();
$user_id = Session::get('user_id');

// $user_id = $_SESSION['user_id'];

// Fetch user details from the database
$sql = "SELECT * FROM usersreg WHERE id = ?";
$stmt = $db->prepare($sql);
if (!$stmt) {
    die("Prepare statement failed: " . $db->error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!--========== BOX ICONS ==========-->
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    <!--========== CSS ==========-->
    <link rel="stylesheet" href="style.css">
    <title>G&G User Dashboard</title>
</head>
<body>

<!--========== SCROLL TOP ==========-->
<a href="#" class="scrolltop" id="scroll-top">
    <i class='bx bx-chevron-up scrolltop__icon'></i>
</a>

<!--========== HEADER ==========-->
<header class="l-header" id="header">
    <nav class="nav bd-container">
        <a href="Index.php" class="nav__logo">GIVE & GATHER</a>
        <div class="nav__donor" id="nav-donor">
            <ul class="nav__list">
                <li class="nav__item"><a href="Index.php" class="nav__link">Home</a></li>
                <li class="nav__item"><a href="aboutUs.php" class="nav__link">About</a></li>
                <li class="nav__item"><a href="services.php" class="nav__link">Services</a></li>
                <li class="nav__item"><a href="Donation.php" class="nav__link">Donation</a></li>
                <li class="nav__item"><a href="contactUs.php" class="nav__link">Contact us</a></li>
                <?php if ($user_id) { ?>
                    <li class="nav__item"><a href="userDashboard.php" class="nav__link"><i class='bx bx-user nav__icon'></i></a></li>
                <?php } else { ?>
                    <li class="nav__item"><a href="javascript:void(0)" onclick="alert('You are not logged in. Please log in first.');" class="nav__link"><i class='bx bx-user nav__icon'></i></a></li>
                <?php } ?>
                <li><i class='bx bx-moon change-theme' id="theme-button"></i></li>
            </ul>
        </div>
        <div class="nav__toggle" id="nav-toggle">
            <i class='bx bx-menu'></i>
        </div>
    </nav>

<script>
</script>

       <!-- Popup Modal -->
       <div id="popup" class="popup" style="display: <?php echo $popup_display; ?>;">
        <div class="popup-content">
            <span class="close" onclick="document.getElementById('popup').style.display='none'">&times;</span>
            <p><?php echo $popup_message; ?></p>
        </div>
    </div>

    <script>

document.querySelector('.nav__icon').addEventListener('click', function(event) {
    <?php if (!$user_id) { ?>
    alert('You are not logged in. Please log in first.');
    event.preventDefault();
    <?php } ?>
});
        // Close the popup when clicking outside of it
        window.onclick = function(event) {
            var modal = document.getElementById('popup');
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</header>
