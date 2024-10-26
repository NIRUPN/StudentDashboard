<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-container {
            background-color: #f8f9fa;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 100px auto; /* Adjusted top margin to 100px for more spacing */
        }
        footer {
            text-align: center;
            margin-top: 20px;
        }
    </style>

<div class="form-container">
    <h2>User Registration</h2>
    <form action="studentregister.php" method="post">
        <div class="mb-3">
            <label for="userName" class="form-label">Name</label>
            <input type="text" class="form-control" id="userName" name="userName" placeholder="Enter your name" required>
        </div>
        <div class="mb-3">
            <label for="userEmail" class="form-label">Email</label>
            <input type="email" class="form-control" id="userEmail" name="userEmail" placeholder="Enter your email" required>
        </div>
        <div class="mb-3">
            <label for="userPhone" class="form-label">Phone Number</label>
            <input type="tel" class="form-control" id="userPhone" name="userPhone" placeholder="Enter your phone number" required>
        </div>
        <div class="mb-3">
            <label for="userPassword" class="form-label">Password</label>
            <input type="password" class="form-control" id="userPassword" name="userPassword" placeholder="Enter your password" required>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>

<footer>
    <p>&copy; 2024 Your Company. All rights reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"></script>
</body>
</html>

<?php

include 'database.php';
include 'adminnavbar2.php';


class User {
    private $con;

  
    public function __construct($dbConnection) {
        $this->con = $dbConnection;
    }

   
    public function register($name, $email, $phone, $password) {
        
        if (!empty($name) && !empty($email) && !empty($phone) && !empty($password)) {
           
            $sql = "INSERT INTO `studentlogin` (`name`, `email`, `phone`, `password`) VALUES (?, ?, ?, ?)";
            $stmt = $this->con->prepare($sql);

            if ($stmt) {
                
                $stmt->bind_param("ssss", $name, $email, $phone, $password);

                
                if ($stmt->execute()) {
                    echo "<script>alert('Registration successful!')</script>";
                } else {
                    echo "<script>alert('Error: " . $stmt->error . "')</script>";
                }

                
                $stmt->close();
            } else {
                echo "<script>alert('Database query preparation failed: " . $this->con->error . "')</script>";
            }
        } else {
            echo "<script>alert('Please fill in all fields.')</script>";
        }
    }
}


if (isset($database)) {
   
    $user = new User($database->con);

   
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['userName'];
        $email = $_POST['userEmail'];
        $phone = $_POST['userPhone'];
        $password = $_POST['userPassword'];

       
        $user->register($name, $email, $phone, $password);
    }
} else {
    echo "<script>alert('Database connection is not set.')</script>";
}


$database->closeConnection();
?>
