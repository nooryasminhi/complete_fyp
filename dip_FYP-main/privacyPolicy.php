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
    <!--========== SCROLL TOP ==========-->
    <a href="#" class="scrolltop" id="scroll-top">
        <i class='bx bx-chevron-up scrolltop__icon'></i>
    </a>

    <!--========== HEADER ==========-->
    <header class="l-header" id="header">
        <nav class="nav bd-container">
            <a href="Index.html" class="nav__logo">GIVE & GATHER</a>

            <div class="nav__donor" id="nav-donor">
                <ul class="nav__list">
                    <li class="nav__item"><a href="index.html" class="nav__link">Home</a></li>
                    <li class="nav__item"><a href="#aboutUs.html" class="nav__link">About</a></li>
                    <li class="nav__item"><a href="services.html" class="nav__link">Services</a></li>
                    <li class="nav__item"><a href="Donation.html" class="nav__link">Donation</a></li>
                    <li class="nav__item"><a href="contactUs.html" class="nav__link">Contact us</a></li>

                    <li><i class='bx bx-moon change-theme' id="theme-button"></i></li>
                </ul>
            </div>

            <div class="nav__toggle" id="nav-toggle">
                <i class='bx bx-donor'></i>
            </div>
        </nav>
    </header>
    <body>
        
        <form id="Privacy Policy">
            <h1 style="color: #45a049;">Privacy Policy</h1><br>
        <div>
            <label for="name">Statement of Privacy<br><br>

            Give & Gather is dedicated to safeguarding the confidentiality of your personal data and preserving your privacy. 
            When you interact with our website or use our services, your data is collected, used, and protected according to 
            the terms outlined in this Privacy Policy. You acknowledge and agree to the terms stated in this policy by using 
            our platform. <br><br>

            1. Data That We Gather: <br><br>

            Personal Data: We may gather personal data, including name, email address, phone number, and address, from you when 
            you create an account or donate on our platform.Payment Data: In the event that you donate, we will gather payment data, 
            including credit card numbers and other payment method details.Usage Data: We might gather data about how you use our website, 
            such as the pages you visit, how long you spend on each page, and other usage metrics.Cookies: To improve your online experience 
            and track usage trends, we may use cookies and other tracking technologies.<br><br>

            2. How Your Information Is Used by Us:<br><br>
            
            To Provide Services: We process donations, keep in touch with you regarding your transactions, and provide and enhance our services 
            the information we collect.To Customise Content: Based on your interests and preferences, we may utilise the information you provide 
            us to tailor the content and recommendations you receive. To Enhance Our Platform: We examine usage data to spot patterns, resolve problems, 
            and enhance the performance and usability of our platform. To Communicate: We might send you newsletters, updates, or marketing materials
            about our services or charitable endeavours using your contact information. You always have the option to unsubscribe from these emails.<br><br>

            3. Security of Data <br><br>

            We take the necessary precautions to guard against unauthorised access, disclosure, alteration, and destruction of your personal information.
            In order to protect sensitive data, like payment information, during transmission, we employ industry-standard encryption protocols. 
            Only authorised employees who require it to carry out their responsibilities are permitted access to your personal information. <br><br>

            4. Information Exchange: <br><br>
            
            Your personal information is never traded, sold, or rented to outside parties for their own marketing advantage.
            Your information might be disclosed to dependable outside service providers who help us run our platform, handle payments, or provide you with services. 
            Contractually, these providers agree to keep your information private and use it only for the purposes that we specify. If required by law or in response 
            to a court order or subpoena, for example, we might disclose your information.<br><br>    
            
            5. Your Decisions: <br><br>

            By going to your account settings on our platform, you can amend or correct your personal data.You can follow the instructions in the emails or get in touch 
            with us directly to choose not to receive any more promotional communications from us. You can set your browser to alert you when cookies are being used, 
            or you can choose to disable cookies altogether. Please be aware, though, that without cookies enabled, some features of our website might not work as intended.

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
                    <li class="nav__item"><a href="index.html" class="nav__link">Home</a></li>
                    <li class="nav__item"><a href="#aboutUs.html" class="nav__link">About</a></li>
                    <li class="nav__item"><a href="services.html" class="nav__link">Services</a></li>
                    <li class="nav__item"><a href="Donation.html" class="nav__link">Donation</a></li>
                    <li class="nav__item"><a href="contactUs.html" class="nav__link">Contact us</a></li>
                    <li><i class='bx bx-moon change-theme' id="theme-button"></i></li>
                </ul>
            </div>

            <div class="nav__toggle" id="nav-toggle">
                <i class='bx bx-donor'></i>
            </div>
        </nav>
    </header>

    