<?php


include 'database.php'; 
include 'adminnavbar2.php';

class TeacherManager {
    private $db;

    public function __construct($connection) {
        $this->db = $connection;
    }

    public function addTeacher($name, $email) {
      
        $emailCheck = $this->db->prepare("SELECT id FROM teachers WHERE email = ?");
        $emailCheck->bind_param("s", $email);
        $emailCheck->execute();
        $emailCheck->store_result();

        if ($emailCheck->num_rows > 0) {
            return "Error: Email already exists.";
        }

        $stmt = $this->db->prepare("INSERT INTO teachers (name, email) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $email);
        
        if ($stmt->execute()) {
            return "Teacher added successfully!";
        } else {
            return "MySQL error: " . $stmt->error;
        }
    }

    public function deleteTeacher($teacherId) {
        $stmt = $this->db->prepare("DELETE FROM teachers WHERE id = ?");
        $stmt->bind_param("i", $teacherId);
        
        if ($stmt->execute()) {
            return "Teacher deleted successfully!";
        } else {
            return "MySQL error: " . $stmt->error;
        }
    }

    public function getTeachers() {
        return $this->db->query("SELECT id, name, email FROM teachers");
    }
}

$database = new Database(); 
$teacherManager = new TeacherManager($database->con);
$message = ""; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['addTeacher'])) {
        $teacherName = $_POST['teacherName'];
        $teacherEmail = $_POST['teacherEmail'];
        $message = $teacherManager->addTeacher($teacherName, $teacherEmail);
    } elseif (isset($_POST['delete'])) {
        $teacherId = $_POST['teacherId'];
        $message = $teacherManager->deleteTeacher($teacherId);
    }
}


$result = $teacherManager->getTeachers();
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Teachers</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: url('your-background-image.jpg') no-repeat center center fixed;
            background-size: cover;
            color: white;
            
        }
        .container {
            margin-top: 70px;
        }
        .card {
            background-color:whitesmoke;
            padding: 20px;
            border-radius: 10px;
            color: black;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <h2 class="text-center">Manage Teachers</h2>
        <form method="POST" action="teachers.php">
            <div class="form-group">
                <label for="teacherName">Teacher Name</label>
                <input type="text" class="form-control" id="teacherName" name="teacherName" required>
            </div>
            <div class="form-group">
                <label for="teacherEmail">Teacher Email</label>
                <input type="email" class="form-control" id="teacherEmail" name="teacherEmail" required>
            </div>
            <button type="submit" name="addTeacher" class="btn btn-primary">Add Teacher</button>
        </form>

        <?php if ($message): ?>
            <div class="alert alert-info mt-4" role="alert">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <h3 class="mt-4">Existing Teachers</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                <td>" . htmlspecialchars($row['id']) . "</td>
                                <td>" . htmlspecialchars($row['name']) . "</td>
                                <td>" . htmlspecialchars($row['email']) . "</td>
                                <td>
                                    <form action='teachers.php' method='POST' style='display:inline;'>
                                        <input type='hidden' name='teacherId' value='" . $row['id'] . "'>
                                        <button type='submit' name='delete' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure you want to delete this teacher?');\">Delete</button>
                                    </form>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No teachers found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
