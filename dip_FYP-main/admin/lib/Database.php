<?php
class Database {
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $dbname = "giveandgather";
    public $link;

    public function __construct() {
        $this->connectDB();
    }

    private function connectDB() {
        $this->link = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
        if ($this->link->connect_error) {
            die("Connection failed: " . $this->link->connect_error);
        }
    }

    public function select($query) {
        $result = $this->link->query($query);
                if ($result === false) {
            // Handle query error
            die("Error executing query: " . $this->link->error);
        }
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }

    public function insert($query) {
        $insert_row = $this->link->query($query);
        if ($insert_row) {
            return $insert_row;
        } else {
            return false;
        }
    }

    public function update($query) {
        $update_row = $this->link->query($query);
        if ($update_row) {
            return $update_row;
        } else {
            return false;
        }
    }

    public function delete($query) {
        $delete_row = $this->link->query($query);
        if ($delete_row) {
            return $delete_row;
        } else {
            return false;
        }
    }
}
?>
