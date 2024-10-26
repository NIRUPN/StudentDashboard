<?php
include 'database.php'; 
include 'studentnavbar.php';


class Student {
    private $db; 

    
    public function __construct() {
        $this->db = new Database(); 
    }


    public function login($email, $password) {
    
        $stmt = $this->db->con->prepare("SELECT email FROM studentlogin WHERE email=? AND password=?");
        $stmt->bind_param("ss", $email, $password); 
        $stmt->execute(); 
        $result = $stmt->get_result(); 

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc(); 
            return $row['email']; 
        }  
    }

    
    public function closeDatabase() {
        $this->db->close(); 
    }
}


session_start();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (!empty($email) && !empty($password)) {
        $student = new Student(); 
        $studentEmail = $student->login($email, $password); 

        if ($studentEmail) {
            $_SESSION['student_email'] = $studentEmail; 
            header('Location: studentdashboard.php'); 
            exit();
        } else {
            echo "Invalid email or password."; 
        }

        $student->closeDatabase(); 
    } else {
        echo "Please provide both email and password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
    <?php include 'loginstyle.php'; ?>
</head>
<body>
    <div class="container" style="margin-top: 50px;">
        <h1>Student Login</h1>
        <form action="" method="POST"> 
            <div class="input-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
