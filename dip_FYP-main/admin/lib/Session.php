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
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    public static function checkSession() {
        self::init();
        if (self::get('login') == false) {
            self::destroy();
            header("Location: login.php");
        }
    }

    public static function destroy() {
        session_destroy();
        header("Location: login.php");
    }
}
?>
