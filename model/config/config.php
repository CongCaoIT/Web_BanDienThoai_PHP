<?php
if (!class_exists('AppConfig')) {
    class AppConfig
    {
        private static $instance = null;

        private $dbHost = 'localhost';
        private $dbUser = 'root';
        private $dbPass = '';
        private $dbName = 'datawebbandienthoai';
        //private $dbName = 'datawebbandt';

        private function __construct()
        {
            // Không cho phép tạo đối tượng từ bên ngoài lớp
        }

        public static function getInstance()
        {
            if (self::$instance === null) {
                self::$instance = new AppConfig();
            }
            return self::$instance;
        }

        public function getDBHost()
        {
            return $this->dbHost;
        }

        public function getDBUser()
        {
            return $this->dbUser;
        }

        public function getDBPass()
        {
            return $this->dbPass;
        }

        public function getDBName()
        {
            return $this->dbName;
        }
    }
}
