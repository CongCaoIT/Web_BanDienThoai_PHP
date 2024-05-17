<?php

class ChiTietGioHang
{
    private $maChiTietGH;
    private $maGioHang;
    private $maSP;
    private $soLuong;
    private $donGia;
    private $maMau;
    private $datHang;

    public function __construct($chitTietGioHang = null, $maChiTietGH = null, $maGioHang = null, $maSP = null, $soLuong = null, $donGia = null, $maMau = null, $datHang = null)
    {
        if ($chitTietGioHang !== null) {
            $this->maChiTietGH = $chitTietGioHang['MaChiTietGH'];
            $this->maGioHang = $chitTietGioHang['MaGioHang'];
            $this->maSP = $chitTietGioHang['MaSP'];
            $this->soLuong = $chitTietGioHang['SoLuong'];
            $this->donGia = $chitTietGioHang['DonGia'];
            $this->maMau = $chitTietGioHang['MaMau'];
            $this->datHang = $chitTietGioHang['DatHang'];
        } else {
            $this->maChiTietGH = $maChiTietGH;
            $this->maGioHang = $maGioHang;
            $this->maSP = $maSP;
            $this->soLuong = $soLuong;
            $this->donGia = $donGia;
            $this->maMau = $maMau;
            $this->datHang = $datHang;
        }
    }

    public function getDatHang()
    {
        return $this->datHang;
    }

    public function setDatHang($datHang)
    {
        $this->datHang = $datHang;
    }

    // Getter và setter cho maChiTietGH
    public function getMaChiTietGH()
    {
        return $this->maChiTietGH;
    }

    public function setMaChiTietGH($maChiTietGH)
    {
        $this->maChiTietGH = $maChiTietGH;
    }

    // Getter và setter cho maGioHang
    public function getMaGioHang()
    {
        return $this->maGioHang;
    }

    public function setMaGioHang($maGioHang)
    {
        $this->maGioHang = $maGioHang;
    }

    // Getter và setter cho maSP
    public function getMaSP()
    {
        return $this->maSP;
    }

    public function setMaSP($maSP)
    {
        $this->maSP = $maSP;
    }

    // Getter và setter cho soLuong
    public function getSoLuong()
    {
        return $this->soLuong;
    }

    public function setSoLuong($soLuong)
    {
        $this->soLuong = $soLuong;
    }

    // Getter và setter cho donGia
    public function getDonGia()
    {
        return $this->donGia;
    }

    public function setDonGia($donGia)
    {
        $this->donGia = $donGia;
    }

    // Getter và setter cho maMau
    public function getMaMau()
    {
        return $this->maMau;
    }

    public function setMaMau($maMau)
    {
        $this->maMau = $maMau;
    }
}
