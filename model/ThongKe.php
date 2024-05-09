<?php
class ThongKe
{
    private $ngay;
    private $tongSoDonDatHang;
    private $tongDoanhThu;
    private $tienLoi;
    private $tongSoDonDaThanhToan;

    public function __construct($ngay=null, $tongSoDonDatHang=null, $tongDoanhThu=null, $tienLoi=null, $tongSoDonDaThanhToan=null)
    {
        $this->ngay = $ngay;
        $this->tongSoDonDatHang = $tongSoDonDatHang;
        $this->tongDoanhThu = $tongDoanhThu;
        $this->tienLoi = $tienLoi;
        $this->tongSoDonDaThanhToan = $tongSoDonDaThanhToan;
    }

    // Getter và setter cho từng thuộc tính
    public function getNgay()
    {
        return $this->ngay;
    }

    public function setNgay($ngay)
    {
        $this->ngay = $ngay;
    }

    public function getTongSoDonDatHang()
    {
        return $this->tongSoDonDatHang;
    }

    public function setTongSoDonDatHang($tongSoDonDatHang)
    {
        $this->tongSoDonDatHang = $tongSoDonDatHang;
    }

    public function getTongDoanhThu()
    {
        return $this->tongDoanhThu;
    }

    public function setTongDoanhThu($tongDoanhThu)
    {
        $this->tongDoanhThu = $tongDoanhThu;
    }

    public function getTienLoi()
    {
        return $this->tienLoi;
    }

    public function setTienLoi($tienLoi)
    {
        $this->tienLoi = $tienLoi;
    }

    public function getTongSoDonDaThanhToan()
    {
        return $this->tongSoDonDaThanhToan;
    }

    public function setTongSoDonDaThanhToan($tongSoDonDaThanhToan)
    {
        $this->tongSoDonDaThanhToan = $tongSoDonDaThanhToan;
    }
}
