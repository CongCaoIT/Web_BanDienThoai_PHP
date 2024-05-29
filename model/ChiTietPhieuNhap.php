<?php
require_once 'SanPham.php';
require_once 'PhieuNhap.php';
require_once 'NhaCungCap.php';

class ChiTietPhieuNhap
{
    private $maCTPN;
    private $maPN;
    private $maSP;
    private $donGiaNhap;
    private $soLuongNhapMau1;
    private $soLuongNhapMau2;
    public $sp;
    public $pn;
    public $ncc;
    public $mau1;
    public $mau2;

    public function __construct($maCTPN = null, $maPN = null, $maSP = null, $donGiaNhap = null, $soLuongNhapMau1 = null, $soLuongNhapMau2 = null)
    {
        $this->maCTPN = $maCTPN;
        $this->maPN = $maPN;
        $this->maSP = $maSP;
        $this->donGiaNhap = $donGiaNhap;
        $this->soLuongNhapMau1 = $soLuongNhapMau1;
        $this->soLuongNhapMau2 = $soLuongNhapMau2;
        $this->sp = new SanPham();
        $this->pn = new PhieuNhap();
        $this->ncc = new NhaCungCap();
        $this->mau1 = new Mau();
        $this->mau2 = new Mau();
    }

    public function getMaCTPN()
    {
        return $this->maCTPN;
    }

    public function setMaCTPN($maCTPN)
    {
        $this->maCTPN = $maCTPN;
    }

    public function getMaPN()
    {
        return $this->maPN;
    }

    public function setMaPN($maPN)
    {
        $this->maPN = $maPN;
    }

    public function getMaSP()
    {
        return $this->maSP;
    }

    public function setMaSP($maSP)
    {
        $this->maSP = $maSP;
    }

    public function getDonGiaNhap()
    {
        return $this->donGiaNhap;
    }

    public function setDonGiaNhap($donGiaNhap)
    {
        $this->donGiaNhap = $donGiaNhap;
    }

    public function getSoLuongNhapMau1()
    {
        return $this->soLuongNhapMau1;
    }

    public function setSoLuongNhapMau1($soLuongNhapMau1)
    {
        $this->soLuongNhapMau1 = $soLuongNhapMau1;
    }

    public function getSoLuongNhapMau2()
    {
        return $this->soLuongNhapMau2;
    }

    public function setSoLuongNhapMau2($soLuongNhapMau2)
    {
        $this->soLuongNhapMau2 = $soLuongNhapMau2;
    }
}
