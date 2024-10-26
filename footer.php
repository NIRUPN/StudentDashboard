<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer Example</title>
    <style>
        
        footer {
            background-color: #333; /* Dark background color */
            color: white; /* White text color */
            padding: 20px; /* Padding for spacing */
            text-align: center; /* Center text */
        }

        .footer-container {
            display: flex;
            flex-direction: column;
            align-items: center; /* Center content */
            justify-content: center;
            max-width: 1200px; /* Maximum width for the footer */
            margin: 0 auto; /* Center the footer */
        }

        .footer-links {
            margin: 15px 0; /* Spacing between links */
        }

        .footer-links a {
            color: white; /* Link color */
            text-decoration: none; /* No underline */
            margin: 0 10px; /* Spacing between links */
        }

        .footer-links a:hover {
            text-decoration: underline; /* Underline on hover */
        }

        .social-icons {
            margin: 15px 0; /* Spacing for social icons */
        }

        .social-icons a {
            color: white; /* Social icon color */
            margin: 0 10px; /* Spacing between icons */
            font-size: 20px; /* Icon size */
        }

        .social-icons a:hover {
            color: #007BFF; /* Change color on hover */
        }

        .footer-bottom {
            margin-top: 20px; /* Spacing for the bottom section */
            font-size: 14px; /* Font size for copyright */
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .footer-container {
                flex-direction: column; /* Stack items on smaller screens */
            }
        }
    </style>
</head>
<body>

    <!-- Your existing content goes here -->

    <footer>
        <div class="footer-container">
            <div class="social-icons">
                <a href="#" aria-label="Facebook"><i class="fa fa-facebook"></i></a>
                <a href="#" aria-label="Twitter"><i class="fa fa-twitter"></i></a>
                <a href="#" aria-label="Instagram"><i class="fa fa-instagram"></i></a>
                <a href="#" aria-label="LinkedIn"><i class="fa fa-linkedin"></i></a>
            </div>
            <div class="footer-bottom">
                &copy; 2024 Your Company Name. All Rights Reserved.
            </div>
        </div>
    </footer>

    <!-- Include Font Awesome for social icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</body>
</html>
