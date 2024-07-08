<!DOCTYPE html>
<html lang="en">
    <?php
    include('header.php');
    ?>
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

        h1 {
        text-align: center;
        margin: 70px;
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
      <?php 
      include('footer.php');
      ?>
        </body>
