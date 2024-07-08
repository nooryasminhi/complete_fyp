<?php
class Session {
    public static function init() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function set($key, $val) {
        $_SESSION[$key] = $val;
    }

    public static function get($key) {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return false;
        }
    }

    public static function checkSession() {
        self::init();
        if (self::get("user_id") == false) {
            self::destroy();
            header("Location: login.php");
        }
    }

    public static function checkLogin() {
        self::init();
        if (self::get("user_id") == true) {
            header("Location: userDashboard.php");
        }
    }

    public static function destroy() {
        session_destroy();
        session_unset();
        header("Location: login.php");
    }
}
?>
