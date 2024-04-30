<?php

/**
 *Session Class
 **/
if (!class_exists('Session')) {
    class Session
    {
        //mỗi lần thêm giỏ hàng hay thanh toán hay đăng nhập nó sẽ lưu phiên giao dịch
        public static function init() // tao session ban dau
        {

            if (version_compare(phpversion(), '5.4.0', '<')) {
                if (session_id() == '') {
                    session_start();
                }
            } else {
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
            }
        }

        public static function set($key, $val) // set key thanh gia tri vd: username la admin no se xuat ra admin
        {
            $_SESSION[$key] = $val;
        }

        public static function get($key) // lay gia tri
        {
            if (isset($_SESSION[$key])) {
                return $_SESSION[$key];
            } else {
                return false;
            }
        }

        public static function checkSession() // kiem tra phien co ton tai ko
        {
            self::init();
            if (self::get("adminlogin") == false) {
                self::destroy();
                header("Location: ../admin/login.php");
            }
        }

        public static function checkLogin()
        {
            self::init();
            if (self::get("adminlogin") == true) {
                header("Location: ../admin/index.php");
            }
        }

        public static function countOnlineUsers()
        {
            self::init();
            if (!isset($_SESSION['online_users'])) {
                $_SESSION['online_users'] = array();
            }
            $sessionId = session_id();
            if (!in_array($sessionId, $_SESSION['online_users'])) {
                $_SESSION['online_users'][] = $sessionId;
            }
            return count($_SESSION['online_users']);
        } 

        public static function destroy()
        {
            session_destroy();
            header("Location: ../admin/login.php");
        }
    }
}
?>
