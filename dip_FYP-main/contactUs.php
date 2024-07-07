!DOCTYPE html>
<html lang="en">
<?php 
include 'header.php'; 
include 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Validate input
    if (!empty($name) && !empty($email) && !empty($message)) {
        // Insert data into the contactus table
        $sql = "INSERT INTO contactus (Name, Email, Message) VALUES ('$name', '$email', '$message')";
        if ($db->query($sql) === TRUE) {
            echo "<script>document.getElementById('contactForm').reset(); alert('Message sent successfully!');</script>";
        } else {
            echo "<script>alert('Error: " . $sql . "<br>" . $db->error . "');</script>";
        }
    } else {
        echo "<script>alert('Please fill in all fields.');</script>";
    }
}


?>
        <body>
            
            <form id="contactForm">
                <h1 style="color: #45a049; margin: 70px;">Send us a message!</h1>
            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="message">Message:</label>
                <textarea id="message" name="message" required></textarea>
            </div>
            <button type="submit">Send Message</button>
            </form>

  

        </body>
        <style>

            body {
            text-align: center;
            }

            form {
            margin: 20px auto;
            width: 50%;
            }

            input, textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            box-sizing: border-box;
            }
            textarea {
            height: 250px;
            }

            button {
            background-color: #4CAF50;
            color: white;
            padding: 15px 20px;
            border: none;
            cursor: pointer;
            }

            button:hover {
            background-color: #45a049;
            }
        </style>
      
      <script>
    document.getElementById('contactForm').addEventListener('submit', function(event) {
        event.preventDefault();
        let name = document.getElementById('name').value;
        let email = document.getElementById('email').value;
        let message = document.getElementById('message').value;

        fetch('contactUs.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `name=${encodeURIComponent(name)}&email=${encodeURIComponent(email)}&message=${encodeURIComponent(message)}`,
        })
        .then(response => response.text())
        .then(data => {
            console.log('Message sent:', data);
            // Add code here to display a success message to the user
            alert('Message sent successfully!');
        })
        .catch(error => {
            console.error('Error:', error);
            // Add code here to display an error message to the user
            alert('There was an error sending your message.');
        });
    });
</script>

                <!--========== FOOTER ==========-->
                <footer class="footer section bd-container">
                    <div class="footer__container bd-grid">
                        <div class="footer__content">
                            <a href="#" class="footer__logo">GIVE & GATHER</a>
                            <span class="footer__description">Charity</span>
                            <div>
                                <a href="#" class="footer__social"><i class='bx bxl-facebook'></i></a>
                                <a href="#" class="footer__social"><i class='bx bxl-instagram'></i></a>
                                <a href="#" class="footer__social"><i class='bx bxl-twitter'></i></a>
                            </div>
                        </div>
        
                        <div class="footer__content">
                            <h3 class="footer__title">Services</h3>
                            <ul>
                                <li><a href="#" class="footer__link">Projects</a></li>
                                <li><a href="#" class="footer__link">Ongoing Project</a></li>
                                <li><a href="#" class="footer__link">Charity cases</a></li>
                                <li><a href="#" class="footer__link">Statistics</a></li>
                            </ul>
                        </div>
        
                        <div class="footer__content">
                            <h3 class="footer__title">Information</h3>
                            <ul>
                                <li><a href="#" class="footer__link">Event</a></li>
                                <li><a href="#" class="footer__link">Contact us</a></li>
                                <li><a href="#" class="footer__link">Privacy policy</a></li>
                                <li><a href="#" class="footer__link">Terms of services</a></li>
                            </ul>
                        </div>
        
                        <div class="footer__content">
                            <h3 class="footer__title">Address</h3>
                            <ul>
                                <li>MultiMedia University</li>
                                <li>Cyberjaya, Selangor</li>
                                <li>+601-116622710</li>
                                <li>1201201826@student.mmu.edu.my</li>
                            </ul>
                        </div>
                    </div>
        
                    <p class="footer__copy">&#169; 2023 4q!d$. All right reserved</p>
                </footer>
        
                <!--========== SCROLL REVEAL ==========-->
                <script src="https://unpkg.com/scrollreveal"></script>
        
                <!--========== MAIN JS ==========-->
                <script src="javascript.js"></script>
                 <!--========== Bootstrap JS ==========-->
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            </body>
        </html>