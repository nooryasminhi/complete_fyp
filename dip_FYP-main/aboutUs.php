<!DOCTYPE html>
<html lang="en">
<?php include 'header.php'; ?> 
        <main class="l-main">
   
            <div class="header">
				<h1>Get to know us!</h1>
			</div>

			<div class="section">
				<p>Give &amp; Gather is a firm believer in the ability of group giving to bring about significant transformation in our local communities. Our goal is to use online platforms and contemporary technology to transform charitable endeavours in Malaysia. Our objective is to enable philanthropy to be transparent, impactful, and easily accessible to all through creative solutions and cooperative partnerships.</p>
				<img src="image/together.png" alt="mission"> 
			</div>
			<div class="section">
				<p>Give &amp; Gather is a firm believer in the ability of group giving to bring about significant transformation in our local communities. Our goal is to use online platforms and contemporary technology to transform charitable endeavours in Malaysia. Our objective is to enable philanthropy to be transparent, impactful, and easily accessible to all through creative solutions and cooperative partnerships.</p>
				<img src="image/donate.png" alt="mission"> 
			</div>
			<div class="section">
				<p>Give &amp; Gather is a firm believer in the ability of group giving to bring about significant transformation in our local communities. Our goal is to use online platforms and contemporary technology to transform charitable endeavours in Malaysia. Our objective is to enable philanthropy to be transparent, impactful, and easily accessible to all through creative solutions and cooperative partnerships.</p>
				<img src="image/give.png" alt="mission"> 
			</div>

			<div class="team-header">
				<h1>Meet the team!</h1>
			</div>
			<div class="team">
				<div class="team-cards">
					<div class="card">
						<div class="card-img">
							<img src="image/adam.jpg" alt="adam">
						</div>
						<div class="card-info">
							<h2 class="card-name">Adam</h2>
							<p class="card-role">Co-lead</p>
							<p><a href="mailto:aesthadam@gmail.com">aesthadam@gmail.com</a></p>
						</div>
					</div>
					<div class="card">
						<div class="card-img">
							<img src="image/yasmin.jpg" alt="Yasmin">
						</div>
						<div class="card-info">
							<h2 class="card-name">Yasmin</h2>
							<p class="card-role">Lead</p>
							<p><a href="mailto:yasminquasar@gmail.com">yasminquasar@gmail.com</a></p>
						</div>
					</div>
					<!-- <div class="card">
						<div class="card-img">
							<img src="image/afiqah.jpg" alt="Afiqah">
						</div>
						<div class="card-info">
							<h2 class="card-name">Afiqah</h2>
							<p class="card-role">Member</p>
							<p><a href="mailto:aaqiddd8@icloud.com">aaqiddd8@icloud.com</a></p>
						</div>
					</div> -->
				</div>
           	</div>
		<style>
			.header{
				margin-top: 100px;
				margin-bottom: 50px;
			}
			.commProj{
              	border-radius: 5px;
          	}
          	.section{
              	display: grid;
			  	padding: 0;
              	margin: 150px 100px 20px 100px;
              	border-radius: 5px;
              	grid-template-rows: auto;
              	animation: scrollReveal ease-in-out both;
              	animation-timeline: view();
              	animation-range: entry 50% cover 50%;
          	}
          	.section img{
              	grid-row: 3/4;
              	grid-column: 3/3;
              	border-radius: 5px;	
              	margin: 20px -20px;
			  	width: 450px;
          	}
          	.section p{
              	grid-row: 3/4;
              	grid-column: 1;
              	position:relative;
              	text-align: justify;
              	margin: 20px;
              	padding-right: 20px;
          	}	
			.team-header {
				margin-top: 200px;
			}
			.team{
				text-align: center;
			}
			.team h2 {
				margin-bottom: 20px;
				text-align: center;
			}
			.team-cards {
				margin: 100px;
				display: flex;
				flex-wrap: wrap;
				justify-content: center;
				gap: 15px;
			}
			.card {
				background-color: #649765;
				border-radius: 6px;
				box-shadow: 0 4px 6px rgba(0, 0, 0, 0.5);
				overflow: hidden;
				transition: transform 0.2s, box-shadow 0.2s;
				width: 18rem;
				height: 25rem;
				margin-top: 10px;
			}
			.card:hover {
				transform: translateY(-5px);
				box-shadow: 0 8px 12px rgba(0, 0, 0, 0.5);
			}
			.card-img {
				display: block;
 				margin-left: auto;
  				margin-right: auto;
  				width: 70%;
			}
			.card-img img{
				border-radius: 5px;
			}
			.card-info button {
				margin: 2rem 1rem;
			}
			.card-name {
				color: #555555e1;
			}
			.card-role {
				color: #555555e1;
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
<?php
include 'footer.php';
?>
    </body>
</html>