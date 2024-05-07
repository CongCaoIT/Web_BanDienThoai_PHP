
<?php
include('../model/config/config.php');
class Database
{
    public $link;
    private $error;

    public function __construct()
    {
        $appConfig = AppConfig::getInstance(); // Lấy đối tượng AppConfig từ Singleton
        $dbHost = $appConfig->getDBHost();
        $dbUser = $appConfig->getDBUser();
        $dbPass = $appConfig->getDBPass();
        $dbName = $appConfig->getDBName();

        $this->connectDB($dbHost, $dbUser, $dbPass, $dbName);
    }

    private function connectDB($host, $user, $pass, $dbname)
    {
        $this->link = new mysqli($host, $user, $pass, $dbname);
        if ($this->link->connect_errno) {
            $this->error = "Connection fail: " . $this->link->connect_error;
            return false;
        }
        $this->link->set_charset("utf8");
        return true;
    }

    // Select or Read data
    public function select($query)
    {
        $result = $this->link->query($query) or
            die($this->link->error . __LINE__);
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }

    // Insert data
    public function insert($query)
    {
        $insert_row = $this->link->query($query) or
            die($this->link->error . __LINE__);
        if ($insert_row) {
            return $insert_row;
        } else {
            return false;
        }
    }

    // Update data
    public function update($query)
    {
        $update_row = $this->link->query($query) or
            die($this->link->error . __LINE__);
        if ($update_row) {
            return $update_row;
        } else {
            return false;
        }
    }

    // Delete data
    public function delete($query)
    {
        $delete_row = $this->link->query($query) or
            die($this->link->error . __LINE__);
        if ($delete_row) {
            return $delete_row;
        } else {
            return false;
        }
    }

    public function prepare($query)
    {
        try {
            $statement = $this->link->prepare($query);
            return $statement;
        } catch (PDOException $e) {
            $this->error = "Prepare statement error: " . $e->getMessage();
            return false;
        }
    }


    // Viết hàm để gọi các stored procedure
    public function callProcedure($procedureName, $params = array())
    {
        // Xây dựng câu lệnh gọi stored procedure với các tham số
        $paramString = '';
        foreach ($params as $key => $value) {
            $paramString .= "$key = '$value', ";
        }
        $paramString = rtrim($paramString, ', ');

        $callQuery = "CALL $procedureName($paramString)";

        // Thực thi stored procedure
        $result = $this->link->query($callQuery);

        // Xử lý kết quả
        if ($result) {
            return $result;
        } else {
            // Nếu có lỗi, trả về false
            return false;
        }
    }
}
?>