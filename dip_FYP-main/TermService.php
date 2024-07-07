<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!--========== BOX ICONS ==========-->
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

    <!--========== Custom CSS ==========-->
    <link rel="stylesheet" href="style.css">

    <title>G&G Contact Us</title>
</head>
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

                    <li><i class='bx bx-moon change-theme' id="theme-button"></i></li>
                </ul>
            </div>

            <div class="nav__toggle" id="nav-toggle">
                <i class='bx bx-donor'></i>
            </div>
        </nav>
    </header>
    <body>
        
        <form id="contactForm">
            <h1 style="color: #45a049;">Terms and Services</h1><br>
        <div>
            <label for="name">Greetings from Give & Gather! Your use of our website and services is governed by these Terms of Service. 
                You accept these terms by using our platform or gaining access to it. Before using our services, please carefully read these terms. <br><br>

                1. Acceptance of the Conditions:<br><br>
                
                You accept these Terms of Service and any additional terms and conditions that may apply to particular features or services by accessing
                or using our platform. Please do not use our platform if you do not agree to these terms.<br><br>

                2. Platform Usage:<br><br>
                
                Our platform may only be used for legitimate purposes. You promise not to use our services for any unauthorised or unlawful purposes, 
                such as but not restricted to breaking any laws or rules that may be relevant violating another person's rights uploading or sending 
                any content that is harmful, illegal, libellous, pornographic, or otherwise objectionable<br><br>
            
                3. Account for Users:<br><br>

                It might be necessary for you to register for an account in order to use some of our platform's features. You are in charge of all 
                activities that take place under your account and of keeping your login credentials secret.When you create an account, you promise 
                to provide accurate, complete, and up-to-date information. You also promise to update your information as soon as it changes. 
                Without authorization, you are not permitted to use another user's account<br><br>

                4. The Right to Intellectual Property: <br><br>

                Give & Gather or our licensors owns the content, logos, trademarks, and other intellectual property that is displayed on our platform. 
                These are protected by copyright, trademark, and other intellectual property laws.Without our prior written consent, you are not permitted
                 to duplicate, alter, distribute, or produce derivative works based on our content. Without our express consent, you are not permitted to 
                 use our trademarks or logos. <br><br>

                5. Links to Third Parties: <br><br>

                Links to external websites or services that are not under Give & Gather's ownership or control may appear on our platform. Before using these
                third-party websites, we advise you to read their terms of service and privacy policies as we are not liable for the information on them or
                their business practices.


            </label>
           
        </form>
    </body>
    <style>

        body {
        font-family: Arial, sans-serif;
        text-align: center;
        }

        h1 {
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

        fetch('https://example.com/api/contact', {
            method: 'POST',
            headers: {
            'Content-Type': 'application/json',
            },
            body: JSON.stringify({ name, email, message }),
        })
        .then(response => response.json())
        .then(data => {
            console.log('Message sent:', data);
            //add code here to display a success message to the user
        })
        .catch(error => {
            console.error('Error:', error);
            //add code here to display an error message to the user
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
                            <li><a href="contactUs.php" class="footer__linkz>Contact us</a></li>
                            <li><a href="privacyPolicy.php" class="footer__link">Privacy policy</a></li>
                            <li><a href="TermService" class="footer__link">Terms of services</a></li>
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!--========== BOX ICONS ==========-->
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

    <!--========== Custom CSS ==========-->
    <link rel="stylesheet" href="index.css">

    <title>G&G Contact Us</title>
</head>
<body>
    <!--========== SCROLL TOP ==========-->
    <a href="#" class="scrolltop" id="scroll-top">
        <i class='bx bx-chevron-up scrolltop__icon'></i>
    </a>

    <!--========== HEADER ==========-->
    <header class="l-header" id="header">
        <nav class="nav bd-container">
            <a href="index.html" class="nav__logo">GIVE & GATHER</a>

            <div class="nav__donor" id="nav-donor">
                <ul class="nav__list">
                    <li class="nav__item"><a href="index.php" class="nav__link">Home</a></li>
                    <li class="nav__item"><a href="#aboutUs.html" class="nav__link">About</a></li>
                    <li class="nav__item"><a href="services.php" class="nav__link">Services</a></li>
                    <li class="nav__item"><a href="Donation.php" class="nav__link">Donation</a></li>
                    <li class="nav__item"><a href="contactUs.php" class="nav__link">Contact us</a></li>
                    <li><i class='bx bx-moon change-theme' id="theme-button"></i></li>
                </ul>
            </div>

            <div class="nav__toggle" id="nav-toggle">
                <i class='bx bx-donor'></i>
            </div>
        </nav>
    </header>

    
