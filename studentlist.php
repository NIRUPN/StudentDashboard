<?php
include 'database.php';
include 'adminnavbar2.php';


class Student {
    private $db; 

    
    public function __construct($dbConnection) {
        $this->db = $dbConnection;
    }

    public function getAllStudents() {
        $sql = "SELECT * FROM studentlogin"; 
        return $this->db->con->query($sql); 
    }

    
    public function closeDatabase() {
        $this->db->close(); 
    }
}

$db = new Database();


$student = new Student($db);
$result = $student->getAllStudents();


if (!$result) {
    die("Error: " . $student->db->con->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container" style="margin-top: 90px;">
    <h2>Student List</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)):  ?>
                <tr>
                    <td><?= htmlspecialchars($row['name']) ?></td> 
                    <td><?= htmlspecialchars($row['email']) ?></td> 
                    <td><?= htmlspecialchars($row['phone']) ?></td> 
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$student->closeDatabase();
?>
