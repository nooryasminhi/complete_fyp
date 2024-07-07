<?php

include 'db.php';
include_once 'session.php';

class User {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function checkExistEmail($email) {
        $sql = "SELECT email FROM tbl_users WHERE email = :email";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    public function userLoginAutho($email, $password) {
        $password = SHA1($password);
        $sql = "SELECT * FROM tbl_users WHERE email = :email AND password = :password LIMIT 1";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':password', $password);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function userLoginAuthentication($data) {
        $email = $data['email'];
        $password = $data['password'];

        $checkEmail = $this->checkExistEmail($email);

        if ($email == "" || $password == "") {
            return '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Error !</strong> Email or Password cannot be empty!</div>';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Error !</strong> Invalid email address!</div>';
        } elseif (!$checkEmail) {
            return '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Error !</strong> Email not found, please register first!</div>';
        } else {
            $logResult = $this->userLoginAutho($email, $password);

            if ($logResult) {
                Session::init();
                Session::set('login', true);
                Session::set('user_id', $logResult->id);
                Session::set('name', $logResult->name);
                Session::set('email', $logResult->email);
                Session::set('username', $logResult->username);
                Session::set('logMsg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success !</strong> You are logged in successfully!</div>');
                header("Location: userDashboard.php");
                exit();
            } else {
                return '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Error !</strong> Email or Password did not match!</div>';
            }
        }
    }
}
?>
