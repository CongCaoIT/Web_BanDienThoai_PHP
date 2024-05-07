
<?php
include '../model/lib/session.php';
include '../model/lib/database.php';
include '../model/helpers/format.php';
include '../model/thanhvien.php';
include '../model/MaHoa.php';
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

        if (empty($this->tv->getTaiKhoan()) || empty($this->tv->getMatKhau())) { // người dùng ko nhập tk mk
            $alert = "Tài khoản và mật khẩu không được để trống";
            return $alert;
        } else { // có nhập
            $maHoa = new MaHoa(); // Tạo một đối tượng mới của lớp MaHoa
            $adminUser = $maHoa->ma_hoa_md5($this->tv->getTaiKhoan());
            $adminPass = $maHoa->ma_hoa_md5($this->tv->getMatKhau()); // Mã hóa mật khẩu sử dụng hàm ma_hoa_md5()

            $query = "SELECT * FROM thanhvien WHERE TaiKhoan = '$adminUser' AND MatKhau = '$adminPass' LIMIT 1";
            $result = $this->db->select($query);

            if ($result != false) { // tức là tk mk đúng
                $value = $result->fetch_assoc(); //lấy dữ liệu ra
                Session::set('adminlogin', true); //đã tồn tại adminlogin này r
                Session::set('adminId', $value['MaTV']); //adminId (tự do nhập tên)  ---- $value['adminId'] là tên trường trong SQL bắt buộc khớp
                Session::set('adminUser', $value['TaiKhoan']);
                Session::set('adminName', $value['MatKhau']);

                echo "<script>window.location.href = 'index.php';</script>";
            } else {
                $alert = "Tài khoản hoặc mật khẩu không đúng";
                return $alert;
            }
        }
    }
}
?>

