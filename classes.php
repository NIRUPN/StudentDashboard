<?php

include 'database.php'; // Ensure this file contains the database connection logic

class ClassManager {
    private $db;

    public function __construct($connection) {
        $this->db = $connection;
    }

 
    public function addClass($classname, $classcode) {
        $stmt = $this->db->prepare("INSERT INTO classes (classname, classcode) VALUES (?, ?)");
        $stmt->bind_param("ss", $classname, $classcode);
        if ($stmt->execute()) {
            return "Class added successfully!";
        } else {
            return "Error adding class: " . $stmt->error;
        }
    }

    
    public function deleteClass($classId) {
        $stmt = $this->db->prepare("DELETE FROM classes WHERE id = ?");
        $stmt->bind_param("i", $classId);
        if ($stmt->execute()) {
            return "Class deleted successfully!";
        } else {
            return "Error deleting class: " . $stmt->error;
        }
    }

    public function getClasses() {
        return $this->db->query("SELECT * FROM classes");
    }
}

$database = new Database(); 
$classManager = new ClassManager($database->con); 
$message = ""; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['addClass'])) {
        $className = $_POST['className'];
        $classCode = $_POST['classCode'];
        $message = $classManager->addClass($className, $classCode);
    } elseif (isset($_POST['deleteClass'])) {
        $classId = $_POST['classId'];
        $message = $classManager->deleteClass($classId);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Classes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom styles to add margin to the form */
        .form-container {
            margin-top: 80px; /* Increased margin to push the form further down */
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Manage Classes</h2>
    <?php if ($message): ?>
        <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <div class="form-container">
        <form method="POST">
            <div class="form-group">
                <label for="className">Class Name</label>
                <input type="text" class="form-control" id="className" name="className" required>
            </div>
            <div class="form-group">
                <label for="classCode">Class Code</label>
                <input type="text" class="form-control" id="classCode" name="classCode" required>
            </div>
            <button type="submit" name="addClass" class="btn btn-primary">Add Class</button>
        </form>
    </div>

    <h3 class="mt-4">Existing Classes</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Class Name</th>
                <th>Class Code</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'adminnavbar2.php';
            $classes = $classManager->getClasses();
            if ($classes->num_rows > 0) {
                $count = 1;
                while ($class = $classes->fetch_assoc()) {
                    echo "<tr>
                            <td>{$count}</td>
                            <td>{$class['classname']}</td>
                            <td>{$class['classcode']}</td>
                            <td>
                                <form method='POST' style='display:inline-block'>
                                    <input type='hidden' name='classId' value='{$class['id']}'>
                                    <button type='submit' name='deleteClass' class='btn btn-danger btn-sm'>Delete</button>
                                </form>
                            </td>
                          </tr>";
                    $count++;
                }
            } else {
                echo "<tr><td colspan='4'>No classes found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
