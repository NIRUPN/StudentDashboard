<?php
include 'Database.php'; 
include 'adminnavbar2.php'; // Ensure this file exists or remove this line if not needed.

class Enrollment {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function enrollStudent($student_email, $class_id) {
        // Get the class name based on the selected class ID
        $class_name = $this->getClassName($class_id);

        // Prepare statement for enrollment
        $stmt = $this->db->con->prepare("INSERT INTO enrollments (student_email, class_id, class_name) VALUES (?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("sis", $student_email, $class_id, $class_name);
            if ($stmt->execute()) {
                return "<div class='alert alert-success'>Enrollment successful!</div>";
            } else {
                return "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
            }
        } else {
            return "<div class='alert alert-danger'>Failed to prepare statement: " . $this->db->con->error . "</div>";
        }
    }

    private function getClassName($class_id) {
        $stmt = $this->db->con->prepare("SELECT classname FROM classes WHERE id = ?");
        $stmt->bind_param("i", $class_id);
        $stmt->execute();
        $stmt->bind_result($class_name);
        $stmt->fetch();
        $stmt->close();
        return $class_name;
    }
}

// Main logic for the enrollment page
$db = new Database();
$message = ""; 

// Create an instance of the Enrollment class
$enrollment = new Enrollment($db);

// Fetch students and classes from the database
$students = $db->getStudents();
$classes = $db->getClasses();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_email = $_POST['student_email'];
    $class_id = $_POST['class_id'];

    // Enroll the student using the Enrollment class
    $message = $enrollment->enrollStudent($student_email, $class_id);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enroll Student in Class</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container" style="margin-top: 150px;">
    <h2>Enroll Student in Class</h2>
    <?= $message; ?> 
    <form action="enrolement.php" method="POST"> 
        <div class="form-group">
            <label for="studentEmail">Student Email</label>
            <select class="form-control" id="studentEmail" name="student_email" required>
                <option value="">Select a student</option>
                <?php while ($student = mysqli_fetch_assoc($students)): ?>
                    <option value="<?= htmlspecialchars($student['email']) ?>">
                        <?= htmlspecialchars($student['name']) ?> (<?= htmlspecialchars($student['email']) ?>)
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="classId">Class</label>
            <select class="form-control" id="classId" name="class_id" required>
                <option value="">Select a class</option>
                <?php while ($class = mysqli_fetch_assoc($classes)): ?>
                    <option value="<?= htmlspecialchars($class['id']) ?>">
                        <?= htmlspecialchars($class['classname']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Enroll</button>
    </form>
</div>
</body>
</html>
