<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        color: red;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh; /* Full viewport height */
        background-image: url('adminimage.jpg'); /* Add your background image */
        background-size: cover; /* Make the background cover the entire viewport */
        background-position: center; /* Center the background image */
        background-repeat: no-repeat; /* Prevent image repetition */
    }
    .container {
        color: red;
        max-width: 500px; /* Limit container width */
        padding: 20px;
        background-color: rgba(255, 255, 255, 0.7); /* White background with 70% opacity */
        border-radius: 5px; /* Rounded corners */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
    }
    .input-group {
        margin-bottom: 15px; /* Space between input fields */
        
    }
    button {
        width: 100%; /* Full width button */
    }
    .form-label {
        color: yellow; /* White text color for form labels */
        font-size: 25px;
        font-weight: 30px;
    }
    h2 {
        color: whitesmoke; 
    }
</style>

</head>
<body>

<div class="form-container">
    <h2>Admin Registration</h2>
    <form action="adminregister.php" method="post">
        <div class="mb-3">
            <label for="adminName" class="form-label">Name</label>
            <input type="text" class="form-control" id="adminName" name="adminName" required placeholder="Enter your name">
        </div>
        <div class="mb-3">
            <label for="adminEmail" class="form-label">Email</label>
            <input type="email" class="form-control" id="adminEmail" name="adminEmail" required placeholder="Enter your email">
        </div>
        <div class="mb-3">
            <label for="adminPassword" class="form-label">Password</label>
            <input type="password" class="form-control" id="adminPassword" name="adminPassword" required placeholder="Enter your password">
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>



<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"></script>
</body>
</html>


<?php
include 'database.php';
include 'adminnavbar.php';

class Admin {
    private $con;

    public function __construct($dbConnection) {
        $this->con = $dbConnection;
    }

    public function register($name, $email, $password) {
      
        error_log("Name: $name, Email: $email, Password: $password");

        if (!empty($name) && !empty($email) && !empty($password)) {
          
            $stmt = $this->con->prepare("INSERT INTO `admins` (`name`, `email`, `password`) VALUES (?, ?, ?)");
            
            $stmt->bind_param("sss", $name, $email, $password);

            
            if ($stmt->execute()) {
                echo "<script>alert('Registration successful!')</script>";
            } else {
                echo "<script>alert('Error: " . $stmt->error . "')</script>";
            }

         
            $stmt->close();
        } else {
            echo "<script>alert('FILL THE DETAILS PROPERLY')</script>";
        }
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $name = $_POST['adminName'];
    $email = $_POST['adminEmail'];
    $password = $_POST['adminPassword'];


    $database = new Database();

    $admin=new Admin($database->con);

    $admin->register($name, $email, $password);

    
    $database->closeConnection();
}
?>
