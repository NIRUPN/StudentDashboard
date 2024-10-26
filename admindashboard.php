<?php
include 'adminnavbar1.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        body {
            background: url('adminimage.jpg') no-repeat center center fixed;
            background-size: cover;
            color: white;
            margin-top: 15px;
        }
        .sidebar {
            background-color: rgba(0, 0, 0, 0.8);
            height: 100vh;
            padding: 30px 15px;
        }
        .sidebar h2 {
            color: #fff;
            margin-bottom: 30px;
        }
        .sidebar a {
            color: #ccc;
            text-decoration: none;
            display: block;
            padding: 10px;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .sidebar a:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
        .content {
            margin-left: 250px;
            padding: 30px;
        }
        .card {
            background-color: rgba(0, 0, 0, 0.7);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2>Admin Dashboard</h2>
        <a href="studentregister.php"><i class="fas fa-user-plus"></i> Student Register</a>
        <a href="classes.php"><i class="fas fa-chalkboard-teacher"></i> Classes List</a>
        <a href="teachers.php"><i class="fas fa-users"></i> Teachers</a>
        <a href="enrolement.php"><i class="fas fa-envelope"></i>ENROLEMENT CLASSSES</a>
        <a href="studentlist.php"><i class="fa-user "></i>STUDENT LIST</a>
    </div>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
