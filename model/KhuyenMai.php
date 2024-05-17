<?php

class KhuyenMai
{
    private $maKhuyenMai;
    private $tenKhuyenMai;
    private $moTa;
    private $phanTramGiamGia;
    private $ngayBatDau;
    private $ngayKetThuc;

    public function __construct($khuyenMai = null, $maKhuyenMai = null, $tenKhuyenMai = null, $moTa = null, $phanTramGiamGia = null, $ngayBatDau = null, $ngayKetThuc = null)
    {
        if ($khuyenMai !== null) {
            $this->maKhuyenMai = $khuyenMai['MaKhuyenMai'];
            $this->tenKhuyenMai = $khuyenMai['TenKhuyenMai'];
            $this->moTa = $khuyenMai['MoTa'];
            $this->phanTramGiamGia = $khuyenMai['PhanTramGiamGia'];
            $this->ngayBatDau = $khuyenMai['NgayBatDau'];
            $this->ngayKetThuc = $khuyenMai['NgayKetThuc'];
        } else {
            $this->maKhuyenMai = $maKhuyenMai;
            $this->tenKhuyenMai = $tenKhuyenMai;
            $this->moTa = $moTa;
            $this->phanTramGiamGia = $phanTramGiamGia;
            $this->ngayBatDau = $ngayBatDau;
            $this->ngayKetThuc = $ngayKetThuc;
        }
    }

    public function getMaKhuyenMai()
    {
        return $this->maKhuyenMai;
    }

    public function setMaKhuyenMai($maKhuyenMai)
    {
        $this->maKhuyenMai = $maKhuyenMai;
    }

    public function getTenKhuyenMai()
    {
        return $this->tenKhuyenMai;
    }

    public function setTenKhuyenMai($tenKhuyenMai)
    {
        $this->tenKhuyenMai = $tenKhuyenMai;
    }

    public function getMoTa()
    {
        return $this->moTa;
    }

    public function setMoTa($moTa)
    {
        $this->moTa = $moTa;
    }

    public function getPhanTramGiamGia()
    {
        return $this->phanTramGiamGia;
    }

    public function setPhanTramGiamGia($phanTramGiamGia)
    {
        $this->phanTramGiamGia = $phanTramGiamGia;
    }

    public function getNgayBatDau()
    {
        return $this->ngayBatDau;
    }

    public function setNgayBatDau($ngayBatDau)
    {
        $this->ngayBatDau = $ngayBatDau;
    }

    public function getNgayKetThuc()
    {
        return $this->ngayKetThuc;
    }

    public function setNgayKetThuc($ngayKetThuc)
    {
        $this->ngayKetThuc = $ngayKetThuc;
    }
}
