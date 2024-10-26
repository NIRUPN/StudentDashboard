<?php
session_start(); 
include 'database.php';
include 'adminnavbar.php';


class Admin {
    private $con;

    public function __construct($dbConnection) {
        $this->con = $dbConnection;
    }

    
    public function login($email, $password) {
        
        $stmt = $this->con->prepare("SELECT password FROM admins WHERE email = ?");
        
        if (!$stmt) {
           
            die("Database error: " . $this->con->error);
        }

      
        $stmt->bind_param("s", $email);
        $stmt->execute();


        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
           
            $row = $result->fetch_assoc();
            $storedPassword = $row['password'];

            
            if ($password === $storedPassword) {
                
                $_SESSION['loggedin'] = true;
                $_SESSION['email'] = $email;

                header("Location: admindashboard.php");
                exit(); 
            } else {
               
                echo "<div class='alert alert-danger'>Invalid email or password.</div>";
            }
        } 
        $stmt->close(); 
    }
}


$database = new Database(); 
$admin = new Admin($database->con);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

   
    if (!empty($email) && !empty($password)) {
        
        $admin->login($email, $password);
    } else {
        
        echo "<div class='alert alert-danger'>Please provide both email and password.</div>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('adminimage.jpg'); /* Background image */
            background-size: cover;
            background-position: center;
        }
        .container {
            max-width: 500px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .input-group {
            margin-bottom: 15px;
        }
        button {
            width: 100%;
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
