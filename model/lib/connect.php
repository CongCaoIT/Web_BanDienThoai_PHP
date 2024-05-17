<?php
include('../model/config/config.php');
class Database
{
    private $pdo;

    public function __construct()
    {
        $appConfig = AppConfig::getInstance(); // Lấy đối tượng AppConfig từ Singleton
        $dbHost = $appConfig->getDBHost();
        $dbUser = $appConfig->getDBUser();
        $dbPass = $appConfig->getDBPass();
        $dbName = $appConfig->getDBName();

        try {
            $dsn = "mysql:host=$dbHost;dbname=$dbName;charset=utf8";
            $this->pdo = new PDO($dsn, $dbUser, $dbPass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Lỗi kết nối: " . $e->getMessage();
            die();
        }
    }

    public function getPDO()
    {
        return $this->pdo;
    }

    public function query($sql, $params = [])
    {
        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute($params);
            return $statement;
        } catch (PDOException $e) {
            echo "Lỗi truy vấn: " . $e->getMessage();
            die();
        }
    }

    public function fetchAll($sql, $params = [])
    {
        $statement = $this->query($sql, $params);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetch($sql, $params = [])
    {
        $statement = $this->query($sql, $params);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function rowCount($sql, $params = [])
    {
        $statement = $this->query($sql, $params);
        return $statement->rowCount();
    }
}
