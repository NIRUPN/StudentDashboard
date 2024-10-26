<?php

ini_set('memory_limit', '2G');

class Database {
    private $host = "localhost";
    private $user = "root";
    private $password = ""; 
    private $database = "dashboard";
    public $con;

    public function __construct() {
        $this->con = mysqli_connect($this->host, $this->user, $this->password, $this->database);

        if (!$this->con) {
            die("Connection failed because of this error: " . mysqli_connect_error());
        } else {
            echo ""; 
        }
    }
    public function getConnection() {
        return $this->con;
    }
    public function closeConnection() {
      
        if ($this->con) {
            mysqli_close($this->con);
        }
    }
    public function getStudents() {
        return $this->con->query("SELECT email, name FROM studentlogin");
    }

  
    public function getClasses() {
        return $this->con->query("SELECT id, classname FROM classes");
    }
    public function close() {
        $this->con->close(); 
    }
}

$database = new Database();
