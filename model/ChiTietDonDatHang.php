<?php

class ChiTietDonDatHang
{
    private $maChiTietDDH;
    private $maDDH;
    private $maSP;
    private $tenSP;
    private $soLuong;
    private $donGia;
    private $maMau;

    public function __construct($chiTietDonDatHang = null, $maChiTietDDH = null, $maDDH = null, $maSP = null, $tenSP = null, $soLuong = null, $donGia = null, $maMau = null)
    {
        if ($chiTietDonDatHang !== null) {
            $this->maChiTietDDH = $chiTietDonDatHang['MaChiTietDDH'];
            $this->maDDH = $chiTietDonDatHang['MaDDH'];
            $this->maSP = $chiTietDonDatHang['MaSP'];
            $this->soLuong = $chiTietDonDatHang['SoLuong'];
            $this->donGia = $chiTietDonDatHang['DonGia'];
            $this->maMau = $chiTietDonDatHang['MaMau'];
        } else {
            $this->maChiTietDDH = $maChiTietDDH;
            $this->maDDH = $maDDH;
            $this->maSP = $maSP;
            $this->soLuong = $soLuong;
            $this->donGia = $donGia;
            $this->maMau = $maMau;
        }
    }

    public function getMaMau()
    {
        return $this->maMau;
    }

    public function setMaMau($maMau)
    {
        $this->maMau = $maMau;
    }

    public function getMaChiTietDDH()
    {
        return $this->maChiTietDDH;
    }

    public function setMaChiTietDDH($maChiTietDDH)
    {
        $this->maChiTietDDH = $maChiTietDDH;
    }

    public function getMaDDH()
    {
        return $this->maDDH;
    }

    public function setMaDDH($maDDH)
    {
        $this->maDDH = $maDDH;
    }

    public function getMaSP()
    {
        return $this->maSP;
    }

    public function setMaSP($maSP)
    {
        $this->maSP = $maSP;
    }

    public function getTenSP()
    {
        return $this->tenSP;
    }

    public function setTenSP($tenSP)
    {
        $this->tenSP = $tenSP;
    }

    public function getSoLuong()
    {
        return $this->soLuong;
    }

    public function setSoLuong($soLuong)
    {
        $this->soLuong = $soLuong;
    }

    public function getDonGia()
    {
        return $this->donGia;
    }

    public function setDonGia($donGia)
    {
        $this->donGia = $donGia;
    }
}
