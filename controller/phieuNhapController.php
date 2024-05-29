<?php
class phieuNhapController
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function showDSPhieuNhap()
    {
        // Thực hiện truy vấn SQL
        $query = "SELECT 
        pn.MaPN,
        ncc.TenNCC,
        sp.TenSP,
        pn.NgayNhap,
        mau1.TenMau AS TenMau1,
        ctpn.SoLuongNhapMau1,
        mau2.TenMau AS TenMau2,
        ctpn.SoLuongNhapMau2,
        ctpn.DonGiaNhap
    FROM 
        PHIEUNHAP pn
    JOIN 
        NHACUNGCAP ncc ON pn.MaNCC = ncc.MaNCC
    JOIN 
        CHITIETPHIEUNHAP ctpn ON pn.MaPN = ctpn.MaPN
    JOIN 
        SANPHAM sp ON ctpn.MaSP = sp.MaSP
    LEFT JOIN 
        MAU mau1 ON ctpn.MaMau1 = mau1.MaMau
    LEFT JOIN 
        MAU mau2 ON ctpn.MaMau2 = mau2.MaMau;";

        $result = $this->db->select($query);

        $DSPNResults = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $dh = new ChiTietPhieuNhap();
                $dh->setMaPN($row['MaPN']);
                $dh->ncc->setTenNCC($row['TenNCC']);
                $dh->sp->setTenSP($row['TenSP']);
                $dh->pn->setNgayNhap($row['NgayNhap']);

                // Tạo đối tượng Mau1 và gán tên màu
                $mau1 = new Mau();
                $mau1->setTenMau($row['TenMau1']);
                $dh->mau1 = $mau1;

                // Gán số lượng màu 1
                $dh->setSoLuongNhapMau1($row['SoLuongNhapMau1']);

                // Tạo đối tượng Mau2 và gán tên màu
                $mau2 = new Mau();
                $mau2->setTenMau($row['TenMau2']);
                $dh->mau2 = $mau2;

                // Gán số lượng màu 2
                $dh->setSoLuongNhapMau2($row['SoLuongNhapMau2']);

                // Gán đơn giá nhập
                $dh->setDonGiaNhap($row['DonGiaNhap']);

                $DSPNResults[] = $dh;
            }
        } else {
            echo "Chưa có phiếu nhập";
        }

        return $DSPNResults;
    }

    public function showTenNCC()
    {
        $query = "SELECT MaNCC, TenNCC FROM nhacungcap";
        $result = $this->db->select($query);

        $dsNCC = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $ncc = new ChiTietPhieuNhap();
                $ncc->ncc->setMaNCC($row['MaNCC']);
                $ncc->ncc->setTenNCC($row['TenNCC']);

                $dsNCC[] = $ncc;
            }
        } else {
            echo "Không có nhà cung cấp";
        }
        return $dsNCC;
    }

    public function getTenSP($maNCC)
    {
        $sp = new ChiTietPhieuNhap();
        $this->fm->validation($maNCC);

        if (empty($maNCC)) {
            $alert = "Phải chọn nhà cung cấp!";
            return $alert;
        } else {
            $params = array($maNCC);
            $DSSPResult = $this->db->callProcedure('GetProductNamesBySupplierID', $params);

            $DSSPResults = array();

            if ($DSSPResult) {
                while ($row = $DSSPResult->fetch_assoc()) {
                    $dh = new ChiTietPhieuNhap();
                    $dh->sp->setMaSP($row['MaSP']);
                    $dh->sp->setTenSP($row['TenSP']);

                    $DSSPResults[] = $dh;
                }
            }
            return $DSSPResults;
        }
    }

    public function themPN($maNCC, $ngaynhap)
    {
        $ngaynhap = date('Y-m-d', strtotime($ngaynhap));

        $query = "INSERT INTO `phieunhap`(`MaNCC`, `NgayNhap`, `DaXoa`) VALUES (?, ?, 0)";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("is", $maNCC, $ngaynhap);

        if ($stmt->execute()) {
            // Lấy mã phiếu nhập vừa thêm vào
            $maPN = $stmt->insert_id;

            // Đóng kết nối và trả về mã phiếu nhập
            $stmt->close();
            return $maPN;
        } else {
            return false;
        }
    }

    public function themCTPN($maPN, $maSP, $maMau1, $maMau2, $dongianhap, $sl1, $sl2)
    {
        $query = "INSERT INTO `chitietphieunhap`(`MaPN`, `MaSP`, `MaMau1`, `MaMau2`, `DonGiaNhap`, `SoLuongNhapMau1`, `SoLuongNhapMau2`) VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("iiiisii", $maPN, $maSP, $maMau1, $maMau2, $dongianhap, $sl1, $sl2);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
