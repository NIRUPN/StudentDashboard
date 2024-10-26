<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom styles for the layout */
        .container {
            display: flex; /* Use flexbox for layout */
            align-items: center; /* Center vertically */
            margin: 20px; /* Margin around the container */
        }
        .image-container {
            flex: 1; /* Take up equal space */
            max-width: 400px; /* Increased max width for the image */
            min-width: 200px; /* Increased minimum width for the image */
        }
        .image-container img {
            width: 100%; /* Make the image responsive */
            height: auto; /* Maintain aspect ratio */
        }
        .content {
            flex: 2; /* Take up more space than the image */
            padding-left: 60px; /* Increased spacing between image and text */
            font-size: 22px; /* Increased font size for content */
        }
        h3 {
            font-size: 24px; /* Increased font size for headings */
        }

        /* Media Query for Smaller Screens */
        @media (max-width: 768px) {
            .container {
                flex-direction: column; /* Stack image and content vertically */
                align-items: flex-start; /* Align items to the start */
            }
            .image-container {
                max-width: 100%; /* Allow image to take full width */
                min-width: 0; /* Remove minimum width on small screens */
                margin-bottom: 20px; /* Add spacing below the image */
            }
            .content {
                padding-left: 0; /* Remove left padding on small screens */
                font-family: 'Courier New', Courier, monospace;
                font-size: 18px; /* Adjust font size on smaller screens */
            }
            h3 {
                font-size: 18px; /* Adjust heading size on smaller screens */
            }
        }
    </style>

</head>
<body>

    <div class="container">
        <!-- Image Container -->
        <div class="image-container">
            <img src="leftimage.jpg" alt="Students" class="img-fluid">
        </div>
        <!-- Content -->
        <div class="content">
            <h3>About Students</h3>
            <p>
                Students are the backbone of any educational institution, embodying the spirit of curiosity and the quest for knowledge. They come from diverse backgrounds and bring unique perspectives to the classroom. Education shapes their futures, helping them develop critical thinking and problem-solving skills.  
                <br><br>
                In today's world, students are also increasingly tech-savvy, utilizing digital tools to enhance their learning experience. They engage in various activities, from academics to extracurriculars, fostering a sense of community and teamwork. Each student has individual aspirations, whether pursuing higher education, vocational training, or entering the workforce directly.  
                <br><br>
                Mentorship and guidance from teachers and peers play a vital role in their development. By embracing challenges and learning from failures, students grow into resilient individuals ready to contribute to society. Their journey is filled with growth, exploration, and the pursuit of excellence.
            </p>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"></script>
</body>
</html>
