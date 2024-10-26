<?php
session_start();
include 'adminnavbar3.php';

class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "dashboard";
    private $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    public function closeConnection() {
        $this->conn->close();
    }
}

class Enrollment {
    private $db;

    public function __construct(Database $database) {
        $this->db = $database->getConnection();
    }

    public function getEnrolledClasses($studentEmail) {
        $sql = "SELECT class_name FROM enrollments WHERE student_email = ?";
        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            die("Query preparation failed: " . mysqli_error($this->db));
        }

        $stmt->bind_param("s", $studentEmail);
        $stmt->execute();
        $result = $stmt->get_result();

        
        if ($stmt->error) {
            echo "Error executing statement: " . $stmt->error;
            return [];
        }

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}

if (!isset($_SESSION['student_email'])) {
    echo "Session email is not set. Please log in.";
    exit();
}

$studentEmail = $_SESSION['student_email'];
$database = new Database();
$enrollment = new Enrollment($database);
$enrolledClasses = $enrollment->getEnrolledClasses($studentEmail);
$database->closeConnection();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrolled Classes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: url('your-background-image.jpg') no-repeat center center fixed;
            background-size: cover;
            color: white;
        }
        .container {
            margin-top: 90px;
        }
        .card {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <h2 class="text-center">Enrolled Classes</h2>

        <?php if (!empty($enrolledClasses)): ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Class Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($enrolledClasses as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['class_name']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No enrolled classes found.</p>
        <?php endif; ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
