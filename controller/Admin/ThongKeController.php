<?php
class ThongKeAdmin
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function layDSThongKe()
    {
        $query = "SELECT 
        DATE_FORMAT(ddh.NgayDatHang, '%Y-%m-%d') AS Ngay,
        COUNT(ddh.MaDDH) AS TongSoDonDatHang,
        SUM(ctdh.SoLuong * ctdh.DonGia) AS TongDoanhThu,
        SUM(ctdh.SoLuong * (ctdh.DonGia - ctpn.DonGiaNhap)) AS TienLoi,
        SUM(CASE WHEN ddh.DaThanhToan = 1 THEN 1 ELSE 0 END) AS TongSoDonDaThanhToan
    FROM 
        DONDATHANG ddh
    JOIN 
        CHITIETDONDATHANG ctdh ON ddh.MaDDH = ctdh.MaDDH
    JOIN (
        SELECT 
            MaSP,
            MAX(MaCTPN) AS MaCTPN,
            DonGiaNhap
        FROM 
            CHITIETPHIEUNHAP
        GROUP BY 
            MaSP
    ) ctpn ON ctdh.MaSP = ctpn.MaSP
    GROUP BY 
        DATE_FORMAT(ddh.NgayDatHang, '%Y-%m-%d')
    ORDER BY 
        Ngay;
    ";

        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $dsTK = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $tk = new ThongKe();
                $tk->setNgay($row['Ngay']);
                $tk->setTongSoDonDatHang($row['TongSoDonDatHang']);
                $tk->setTongDoanhThu($row['TongDoanhThu']);
                $tk->setTienLoi($row['TienLoi']);
                $tk->setTongSoDonDaThanhToan($row['TongSoDonDaThanhToan']);

                $dsTK[] = $tk;
            }
        } else {
            echo "Chưa có sản phẩm";
        }
        return $dsTK;
    }
}
