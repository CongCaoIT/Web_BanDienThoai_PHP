<?php
include '../model/lib/session.php';
include '../model/config/config.php';
include '../model/lib/database.php';
include '../model/helpers/format.php';
include '../model/MaHoa.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
?>

<?php
class ad_ForgotPass
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function capNhatMatKhau($mail, $mk)
    {
        $mail = $this->fm->validation($mail);
        $mk = $this->fm->validation($mk);

        $mail = mysqli_real_escape_string($this->db->link, $mail);
        $mk = mysqli_real_escape_string($this->db->link, $mk);

        $query = "UPDATE thanhvien SET MatKhau = '$mk' WHERE Email = '$mail'";

        $result = $this->db->update($query);
    }

    public function guiMailThongBao($recipientEmail)
    {
        $matKhauTamThoi = '';
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $length = strlen($characters);
        for ($i = 0; $i < 6; $i++) {
            $matKhauTamThoi .= $characters[rand(0, $length - 1)];
        }
        $maHoa = new MaHoa();
        $hasPass = $maHoa->ma_hoa_md5($matKhauTamThoi);

        $this->capNhatMatKhau($recipientEmail, $hasPass);

        $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug = 0;
            $mail->isSMTP();

            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'thaonguyen28062003@gmail.com';
            $mail->Password   = 'gxnrirdwvacvxjkr';
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            $mail->setFrom('thaonguyen28062003@gmail.com', 'Mailer');
            $mail->addAddress($recipientEmail);

            $mail->isHTML(true);
            $mail->Subject = mb_encode_mimeheader('Quên mật khẩu đăng nhập', 'UTF-8');
            $mail->Body    = 'Yêu cầu của bạn đã được duyệt. Mật khẩu tạm thời của bạn là: ' . $matKhauTamThoi;

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    public function ad_ForgotPass($ad_mail)
    {
        $ad_mail = $this->fm->validation($ad_mail);

        if (empty($ad_mail)) {
            $alert = "Email không được để trống";
            return $alert;
        } else {
            $ad_mail = mysqli_real_escape_string($this->db->link, $ad_mail);
            $query = "SELECT COUNT(*) AS count FROM thanhvien WHERE Email = '$ad_mail'";
            $result = $this->db->select($query);

            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $count = $row['count'];
                if ($count > 0) {
                    $this->guiMailThongBao($ad_mail);
                    echo '<script>window.location.href = "../admin/index.php";</script>';
                } else {
                    $alert = "Email không chính xác";
                    return $alert;
                }
            } else {
                $alert = "Lỗi truy vấn";
                return $alert;
            }
        }
    }
}
?> 