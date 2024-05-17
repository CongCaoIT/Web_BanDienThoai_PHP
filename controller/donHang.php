<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
class donHang
{
    private $db;
    private $fm;
    public $completedOrders = array();
    public $updateResult;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function showDonDatHang()
    {
        $query = "SELECT 
        ddh.MaDDH,
        ddh.MaTV,
        ddh.NgayDatHang,
        ddh.NgayGiao,
        sp.TenSP,
        ctddh.SoLuong,
        ctddh.DonGia,
        ddh.thanhTien
    FROM 
        DONDATHANG ddh
    JOIN 
        CHITIETDONDATHANG ctddh ON ddh.MaDDH = ctddh.MaDDH
    JOIN 
        SANPHAM sp ON ctddh.MaSP = sp.MaSP
    ORDER BY 
        ddh.NgayDatHang DESC;
    ";

        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $dsDonDatHang = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $dh = new DonDatHang();
                $dh->setMaDDH($row['MaDDH']);
                $dh->setMaTV($row['MaTV']);
                $dh->setNgayDatHang($row['NgayDatHang']);
                $dh->setNgayGiao($row['NgayGiao']);
                $dh->sp->setTenSP($row['TenSP']);
                $dh->chitietDH->setSoLuong($row['SoLuong']);
                $dh->sp->setDonGia($row['DonGia']);
                $dh->setThanhTien($row['thanhTien']);
                $dsDonDatHang[] = $dh;
            }
        } else {
            echo "Chưa có đơn hàng";
        }
        return $dsDonDatHang;
    }

    public function showDonChuaDuyet()
    {
        $query = "SELECT 
        DDH.MaDDH,
        TTDH.HoTen,
        DDH.NgayDatHang,
        DDH.TinhTrang,
        DDH.NgayGiao,
        DDH.DaThanhToan,
        DDH.QuaTang
    FROM 
        dondathang DDH
    INNER JOIN 
        thanhvien TV ON DDH.MaTV = TV.MaTV
    INNER JOIN 
        thongtindathang TTDH ON DDH.MaTTDH = TTDH.MaTTDH WHERE `TinhTrang` LIKE 'Chưa duyệt';
    ";

        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $dsDonHangChuaDuyet = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $dh = new DonDatHang();
                $dh->setMaDDH($row['MaDDH']);
                $dh->ttdh->setHoTen($row['HoTen']);
                $dh->setNgayDatHang($row['NgayDatHang']);
                $dh->setTinhTrang($row['TinhTrang']);
                $dh->setNgayGiao($row['NgayGiao']);
                $dh->setDaThanhToan($row['DaThanhToan']);
                $dh->setQuaTang($row['QuaTang']);

                $dsDonHangChuaDuyet[] = $dh;
            }
        }
        return $dsDonHangChuaDuyet;
    }

    public function showDonDaDuyet()
    {
        $query = "SELECT 
        DDH.MaDDH,
        TTDH.HoTen,
        DDH.NgayDatHang,
        DDH.TinhTrang,
        DDH.NgayGiao,
        DDH.DaThanhToan,
        DDH.QuaTang
    FROM 
        dondathang DDH
    INNER JOIN 
        thanhvien TV ON DDH.MaTV = TV.MaTV
    INNER JOIN 
        thongtindathang TTDH ON DDH.MaTTDH = TTDH.MaTTDH WHERE `TinhTrang` LIKE 'Đã duyệt';
    ";

        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $dsDonHangDaDuyet = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $dh = new DonDatHang();
                $dh->setMaDDH($row['MaDDH']);
                $dh->ttdh->setHoTen($row['HoTen']);
                $dh->setNgayDatHang($row['NgayDatHang']);
                $dh->setTinhTrang($row['TinhTrang']);
                $dh->setNgayGiao($row['NgayGiao']);
                $dh->setDaThanhToan($row['DaThanhToan']);
                $dh->setQuaTang($row['QuaTang']);

                // Thêm đối tượng DonDatHang vào mảng
                $dsDonHangDaDuyet[] = $dh;
            }
        }
        return $dsDonHangDaDuyet;
    }

    public function showDonDaGiao()
    {
        $query = "SELECT 
        DDH.MaDDH,
        TTDH.HoTen,
        DDH.NgayDatHang,
        DDH.TinhTrang,
        DDH.NgayGiao,
        DDH.DaThanhToan,
        DDH.QuaTang
    FROM 
        dondathang DDH
    INNER JOIN 
        thanhvien TV ON DDH.MaTV = TV.MaTV
    INNER JOIN 
        thongtindathang TTDH ON DDH.MaTTDH = TTDH.MaTTDH WHERE `TinhTrang` LIKE 'Đã giao';
    ";

        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $dsDonHangDaGiao = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $dh = new DonDatHang();
                $dh->setMaDDH($row['MaDDH']);
                $dh->ttdh->setHoTen($row['HoTen']);
                $dh->setNgayDatHang($row['NgayDatHang']);
                $dh->setTinhTrang($row['TinhTrang']);
                $dh->setNgayGiao($row['NgayGiao']);
                $dh->setDaThanhToan($row['DaThanhToan']);
                $dh->setQuaTang($row['QuaTang']);

                // Thêm đối tượng DonDatHang vào mảng
                $dsDonHangDaGiao[] = $dh;
            }
        }
        return $dsDonHangDaGiao;
    }

    public function showTTKhuyenMai()
    {
        $query = "SELECT * FROM khuyenmai";
        $result = $this->db->select($query);

        $dsKhuyenMai = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $km = new KhuyenMai();
                $km->setMaKhuyenMai($row['MaKhuyenMai']);
                $km->setTenKhuyenMai($row['TenKhuyenMai']);
                $km->setMoTa($row['MoTa']);
                $km->setPhanTramGiamGia($row['PhanTramGiamGia']);
                $km->setNgayBatDau($row['NgayBatDau']);
                $km->setNgayKetThuc($row['NgayKetThuc']);

                $dsKhuyenMai[] = $km;
            }
        } else {
            echo "Chưa có khuyến mãi";
        }
        return $dsKhuyenMai;
    }

    public function insertCTKM($tenCT, $mt, $giam, $ngayBD, $ngayKT)
    {
        $tenCT = $this->fm->validation($tenCT);
        $mt = $this->fm->validation($mt);
        $giam = $this->fm->validation($giam);
        $ngayBD = $this->fm->validation($ngayBD);
        $ngayKT = $this->fm->validation($ngayKT);

        $tenCT  = mysqli_real_escape_string($this->db->link, $tenCT);
        $mt  = mysqli_real_escape_string($this->db->link, $mt);
        $giam = (int)$giam;
        // Đảm bảo $ngayBD và $ngayKT có định dạng đúng
        $ngayBD  = date('Y-m-d', strtotime($ngayBD));
        $ngayKT  = date('Y-m-d', strtotime($ngayKT));

        $query = " INSERT INTO  khuyenmai(TenKhuyenMai, MoTa, PhanTramGiamGia, NgayBatDau, NgayKetThuc) VALUES('$tenCT', '$mt', '$giam', '$ngayBD', '$ngayKT')  ";
        $result = $this->db->insert($query);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function getTTDonChuaDuyet(int $ma)
    {
        $query = "SELECT dondathang.MaDDH, thongtindathang.HoTen, dondathang.NgayDatHang, dondathang.DaThanhToan,
        chitietdondathang.MaSP, sanpham.TenSP, chitietdondathang.SoLuong, chitietdondathang.DonGia,
        dondathang.thanhTien, dondathang.MaTV, thanhvien.Email
        FROM dondathang
        JOIN thongtindathang ON dondathang.MaTTDH = thongtindathang.MaTTDH
        JOIN chitietdondathang ON dondathang.MaDDH = chitietdondathang.MaDDH
        JOIN thanhvien ON thanhvien.MaTV = dondathang.MaTV
        JOIN sanpham ON chitietdondathang.MaSP = sanpham.MaSP
        WHERE dondathang.MaDDH = ?;";

        $statement = $this->db->prepare($query);
        $statement->bind_param("i", $ma); // Sử dụng bind_param thay vì bindParam
        $statement->execute();
        $result = $statement->get_result();

        $DSResults = array();

        while ($row = $result->fetch_assoc()) {
            $dh = new DonDatHang();
            $dh->setMaDDH($row['MaDDH']);
            $dh->ttdh->setHoTen($row['HoTen']);
            $dh->setNgayDatHang($row['NgayDatHang']);
            $dh->setDaThanhToan($row['DaThanhToan']);
            $dh->sp->setMaSP($row['MaSP']);
            $dh->sp->setTenSP($row['TenSP']);
            $dh->chitietDH->setSoLuong($row['SoLuong']);
            $dh->chitietDH->setDonGia($row['DonGia']);
            $dh->setThanhTien($row['thanhTien']);
            $dh->tv->setMaTV($row['MaTV']);
            $dh->tv->setEmail($row['Email']);

            $DSResults[] = $dh;
        }

        return $DSResults;
    }

    public function guiMailThongBao($recipientEmail, $tennd)
    {
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
            $mail->addAddress($recipientEmail, $tennd);

            $mail->isHTML(true);
            $mail->Subject = mb_encode_mimeheader('Thông tin đơn hàng của bạn', 'UTF-8');
            $mail->Body    = 'Đơn hàng của bạn đã được duyệt. Xin cảm ơn bạn đã sử dụng dịch vụ của chúng tôi.';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    public function capNhatDuyetDon($maddh, $ngGiao, $ttDuyet, $ttThanhToan, $mail, $tennd)
    {
        $maddh = $this->fm->validation($maddh);
        $ngGiao = $this->fm->validation($ngGiao);
        $ttDuyet = $this->fm->validation($ttDuyet);
        $ttThanhToan = $this->fm->validation($ttThanhToan);
        $mail = $this->fm->validation($mail);
        $tennd = $this->fm->validation($tennd);

        $ttDuyet = mysqli_real_escape_string($this->db->link, $ttDuyet);
        $mail = mysqli_real_escape_string($this->db->link, $mail);
        $tennd = mysqli_real_escape_string($this->db->link, $tennd);

        $ngGiao = date('Y-m-d', strtotime($ngGiao));

        $query = "UPDATE dondathang SET NgayGiao = '$ngGiao', TinhTrang = '$ttDuyet', DaThanhToan = '$ttThanhToan' WHERE MaDDH = '$maddh'";

        $result = $this->db->update($query);

        if ($result != false) {
            $this->guiMailThongBao($mail, $tennd);
            echo '<script>window.location.href = "DuyetDonHang.php?page=daduyet";</script>';
        }
    }

    public function layTTDDH(int $maddh)
    {
        $query = "SELECT * FROM `chitietdondathang` WHERE `MaDDH` = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $maddh);
        $stmt->execute();
        $result = $stmt->get_result();
        $dsTTDH = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $sp = new ChiTietDonDatHang();
                $sp->setMaSP($row['MaSP']);
                $sp->setSoLuong($row['SoLuong']);
                $sp->setMaMau($row['MaMau']);
                $dsTTDH[] = $sp;
            }
        }
        return $dsTTDH;
    }

    public function capNhapSLTon(int $sl, int $masp, int $mamau)
    {
        $query = "UPDATE `sanpham_mau` SET `SoLuongTon`= (`SoLuongTon` - ?) WHERE `MaSP` = ? AND `MaMau` = ?;";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("iii", $sl, $masp, $mamau);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
