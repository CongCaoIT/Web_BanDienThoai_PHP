<?php
class ThongTinDatHang
{
    private $maTTDH;
    private $hoTen;
    private $sdt;
    private $email;
    private $diaChiGiaoHang;
    private $maDDH;

    public function __construct($thongTinDatHang)
    {
        $this->maTTDH = $thongTinDatHang['MaTTDH'];
        $this->hoTen = $thongTinDatHang['HoTen'];
        $this->sdt = $thongTinDatHang['SDT'];
        $this->email = $thongTinDatHang['Email'];
        $this->diaChiGiaoHang = $thongTinDatHang['DiaChiGiaoHang'];
    }

    // Getter và setter cho từng thuộc tính
    public function getMaTTDH()
    {
        return $this->maTTDH;
    }

    public function setMaTTDH($maTTDH)
    {
        $this->maTTDH = $maTTDH;
    }

    public function getHoTen()
    {
        return $this->hoTen;
    }

    public function setHoTen($hoTen)
    {
        $this->hoTen = $hoTen;
    }

    public function getSdt()
    {
        return $this->sdt;
    }

    public function setSdt($sdt)
    {
        $this->sdt = $sdt;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getDiaChiGiaoHang()
    {
        return $this->diaChiGiaoHang;
    }

    public function setDiaChiGiaoHang($diaChiGiaoHang)
    {
        $this->diaChiGiaoHang = $diaChiGiaoHang;
    }

    public function getMaDDH()
    {
        return $this->maDDH;
    }

    public function setMaDDH($maDDH)
    {
        $this->maDDH = $maDDH;
    }
}
