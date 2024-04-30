<?php
include '../model/lib/session.php';
include_once '../model/config/config.php';
include_once '../model/lib/database.php';
include '../model/helpers/format.php';
include '../model/thanhvien.php';
?>
<?php
class adminlogin
{
    private $db;
    private $fm; 
    private $tv;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
        $this->tv = new ThanhVien();
    }
    public function login_admin($adminUser, $adminPass)
    {
        $this->tv->setTaiKhoan($this->fm->validation($adminUser));
        $this->tv->setMatKhau($this->fm->validation($adminPass));

        $this->tv->setTaiKhoan(mysqli_real_escape_string($this->db->link, $adminUser));
        $this->tv->setMatKhau(mysqli_real_escape_string($this->db->link, $adminPass));

        if(empty($this->tv->getTaiKhoan()) || empty($this->tv->getMatKhau())){ // người dùng ko nhập tk mk
            $alert = "Tài khoản và mật khẩu không được để trống";
            return $alert;
        }else{ // có nhập
            $$adminUser = $this->tv->getTaiKhoan();
            $adminPass = $this->tv->getMatKhau();
            
            $query = "SELECT * FROM thanhvien WHERE TaiKhoan = '$adminUser' AND MatKhau = '$adminPass' LIMIT 1";
            $result = $this->db->select($query);

            if($result != false){// tức là tk mk đúng
                $value = $result->fetch_assoc(); //lấy dữ liệu ra
                Session::set('adminlogin', true); //đã tồn tại adminlogin này r
                Session::set('adminId', $value['MaTV']); //adminId (tự do nhập tên)  ---- $value['adminId'] là tên trường trong SQL bắt buộc khớp
                Session::set('adminUser', $value['TaiKhoan']);
                Session::set('adminName', $value['MatKhau']);

                header('Location: ../admin/index.php');

            }else{
                $alert = "Tài khoản hoặc mật khẩu không đúng";
            return $alert;
            }
        }
    }
}
?>

