<!DOCTYPE html>
<html lang="en">
<?php
include 'db.php';
include 'header.php';

// Fetch charity manage
$sql = "SELECT * FROM charitymanage";
$result = $db->query($sql);
?> 
<div class="container-services" style="margin: 70px;">
  <h1 style="padding: 50px;">Services We Offer</h1>
</div>

<section style="margin: 70px">
    <img src="image/helping.png" class="img-fluid" alt="Helping">
</section>

<section class="ongoing-projects">
    <h2 style="text-align: center; padding: 50px;">Some of Our Projects</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <img src="image/Proj1.jpg" class="card-img-top" alt="Project 1">
                <div class="card-body">
                    <p class="card-text">Little Scholars Society</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <img src="image/Proj2.png" class="card-img-top" alt="Project 2">
                <div class="card-body">
                    <p class="card-text">Youth Learning Alliance</p>
                </div>
            </div>
        </div>
        <div class="col-md-4" class="w3-center w3-animate-left">
            <div class="card">
                <img src="image/Proj3.png" class="card-img-top" alt="Project 3">
                <div class="card-body">
                    <p class="card-text">Bright Future Foundation</p>
                </div>
            </div>
        </div>
    </div>
</section>

<h2 style="text-align: center; margin: 50px; padding: 50px;">What we thrive for?</h2>

<section class="community">
    <div class="commProj">
        <div class="commProj1">
            <h2>Our Mission!</h2>
            <p>Our charity community is dedicated to providing quality education and resources to underprivileged children around the world, empowering them to break the cycle of poverty and build a brighter future for themselves and their communities</p>
            <img src="image/mission.png" alt="mission">        
        </div>    
        <div class="commProj2">
            <div class="project-description"></div>
            <h2>Our Vision!</h2>
            <p>Our charity community is dedicated to providing quality education and resources to underprivileged children around the world, empowering them to break the cycle of poverty and build a brighter future for themselves and their communities</p>
            <img src="image/vision.png" alt="vision">
        </div>    
    </div>
</section>
<section class="ongoing_charity">
<h2 style="text-align: center; margin: 50px; padding: 50px;">Ongoing Charity Projects</h2>
<table class="ongoing-charity-table">
      <thead>
          <tr>
              <th>ID</th>
              <th>Project Name</th>
              <th>Description</th>
          </tr>
      </thead>
      <tbody>
      <?php
          if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  echo "<tr>
                          <td> ". ($row['id']) . " </td>
                          <td>" . ($row['project']) . "</td>
                          <td>" . ($row['description']) . "</td>
                        </tr>";
              }
          } else {
              echo "<tr><td colspan='5'>No ongoing charity projects found.</td></tr>";
          }
          ?>
      </tbody>
      </table>
</section>

<!-- Internal CSS-->
<style>
    .container{
        margin: 200px;
        background-color: #649765;
    }
    .container h1 {
        text-align: center;
    }

    /* Our Services Section */
    .our-services {
        background-color: #649765;
        padding: 50px 0;
    }
    .our-services img {
        max-width: 80%;
        height: auto;
        border-radius: 10px;
    }

    .ongoing-projects h2{
        margin: 40px;
    }
    /* Card showing some of our projects */
    .card{
        background-color: #649765;
        width: 50%;
        height: auto;
        margin: auto;
        /* opacity: 0; */
        transition: opacity 0.5s ease-in-out, transform 0.5s ease-in-out;
    }
    .card.visible{
        animation: fadeInFromTop 2s ease-in-out;
        opacity: 1;
    }
    .card p{
        white-space: nowrap;
    }
    .card img{
        width: 500px;
        height: 150px;
        border-radius: 25px;
    }
    /* commProj is for "What we thrive for?" */
    .commProj{
        border-radius: 5px;
    }
    .commProj1{
        display: grid;
        margin: 100px;
        background-color: #649765;
        border-radius: 5px;
        grid-template-rows: auto;
        animation: scrollReveal ease-in-out both;
        animation-timeline: view();
        animation-range: entry 50% cover 50%;
    }
    .commProj1 img{
        grid-row: 3/4;
        grid-column: 3/3;
        border-radius: 5px;
        margin: 20px -20px;
    }
    .commProj1 h2{
        grid-row: 1;
        grid-column: 1/4;
        display: block;
        text-align: center;
        margin: 20px;
    }
    .commProj1 p{
        grid-row: 3/4;
        grid-column: 1;
        position:relative;
        text-align: justify;
        margin: 20px;
        padding-right: 20px;
    }
    .commProj2{
        display: grid;
        margin: 100px;
        background-color: #649765;
        border-radius: 5px;
        grid-template-rows: auto;
        animation: scrollReveal ease-in-out both;
        animation-timeline: view();
        animation-range: entry 50% cover 50%;
    }
    .commProj2 img{
        grid-row: 3/4;
        grid-column: 3/3;
        border-radius: 5px;
        margin: 20px -20px;
    }           
    .commProj2 h2{
        grid-row: 1;
        grid-column: 1/4;
        display: block;
        text-align: center;
        margin: 20px;
    } 
    .commProj2 p{
        grid-row: 3/4;
        grid-column: 1;
        position:relative;
        text-align: justify;
        margin: 20px;
        padding-right: 20px;
    } 
/* Centering the table */
.ongoing_charity {
        margin: 100px auto;
        width: calc(100% - 200px); /* Adjusts the width to account for the left and right margins */
        max-width: 900px;
    }
    .table-container {
        margin-left: 100px;
        margin-right: 100px;
    }
    .ongoing-charity-table {
        border-collapse: collapse;
        width: 100%; /* Make the table width 100% to fill the container */
    }
    .ongoing-charity-table th,
    .ongoing-charity-table td {
        padding: 12px 15px;
        border: 1px solid #ddd;
    }
    .ongoing-charity-table th {
        background-color: #649765;
        color: #333;
    }

    @keyframes scrollReveal{
        from{
            opacity: 0;
            transform: translateY(100px);
        }
        to{
            opacity: 1;
            transform: translateY(0);
        }
    }
    @keyframes fadeInFromTop {
        0% {
            opacity: 0;
            transform: translateY(-20px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
</main>
<?php include 'footer.php'; ?> 
<!-- Internal JS -->
<script>
    // Animation for card
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.card');
    
        function checkVisibility() {
            cards.forEach(card => {
                const rect = card.getBoundingClientRect();
                const windowHeight = (window.innerHeight || document.documentElement.clientHeight);
    
                if (rect.top <= windowHeight) {
                    card.classList.add('visible');
                }
            });
        }
    
        window.addEventListener('scroll', checkVisibility);
        checkVisibility(); // Initial check in case the element is already in view
    });
    </script>

</body>
</html>
