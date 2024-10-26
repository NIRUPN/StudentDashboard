<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <?php include 'loginstyle.php'; ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Full viewport height */
            background-image: url('path_to_your_image.jpg'); /* Add your background image */
            background-size: cover; /* Make the background cover the entire viewport */
            background-position: center; /* Center the background image */
            background-repeat: no-repeat; /* Prevent image repetition */
        }
        .container {
            max-width: 500px; /* Limit container width */
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9); /* White background with slight transparency */
            border-radius: 5px; /* Rounded corners */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }
        .input-group {
            margin-bottom: 15px; /* Space between input fields */
        }
        button {
            width: 100%; /* Full width button */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Admin Login</h1>
        <form action="adminlogin.php" method="POST">
            <div class="input-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</body>
</html>
