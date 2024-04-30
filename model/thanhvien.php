<?php
require_once 'LoaiThanhVien.php';
class ThanhVien
{
    private $maTV;
    private $maLoaiTV;
    private $taiKhoan;
    private $matKhau;
    private $hoTen;
    private $diaChi;
    private $email;
    private $sdt;
    private $cauHoi;
    private $cauTraLoi;
    private $hinhDaiDien;
    private $maToken;
    private $thoiGianMaToken;
    public $ltv;

    public function __construct($maTV = null, $maLoaiTV = null, $taiKhoan = null, $matKhau = null, $hoTen = null, $diaChi = null, $email = null, $sdt = null, $cauHoi = null, $cauTraLoi = null, $hinhDaiDien = null, $maToken = null, $thoiGianMaToken = null)
    {
        if ($maTV !== null) {
            $this->maTV = $maTV;
        }
        if ($maLoaiTV !== null) {
            $this->maLoaiTV = $maLoaiTV;
        }
        if ($taiKhoan !== null) {
            $this->taiKhoan = $taiKhoan;
        }
        if ($matKhau !== null) {
            $this->matKhau = $matKhau;
        }
        if ($hoTen !== null) {
            $this->hoTen = $hoTen;
        }
        if ($diaChi !== null) {
            $this->diaChi = $diaChi;
        }
        if ($email !== null) {
            $this->email = $email;
        }
        if ($sdt !== null) {
            $this->sdt = $sdt;
        }
        if ($cauHoi !== null) {
            $this->cauHoi = $cauHoi;
        }
        if ($cauTraLoi !== null) {
            $this->cauTraLoi = $cauTraLoi;
        }
        if ($hinhDaiDien !== null) {
            $this->hinhDaiDien = $hinhDaiDien;
        }
        if ($maToken !== null) {
            $this->maToken = $maToken;
        }
        if ($thoiGianMaToken !== null) {
            $this->thoiGianMaToken = $thoiGianMaToken;
        }

        $this->ltv = new LoaiThanhVien();
    }

    // Getters
    public function getMaTV()
    {
        return $this->maTV;
    }

    public function getMaLoaiTV()
    {
        return $this->maLoaiTV;
    }

    public function getTaiKhoan()
    {
        return $this->taiKhoan;
    }

    public function getMatKhau()
    {
        return $this->matKhau;
    }

    public function getHoTen()
    {
        return $this->hoTen;
    }

    public function getDiaChi()
    {
        return $this->diaChi;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getSdt()
    {
        return $this->sdt;
    }

    public function getCauHoi()
    {
        return $this->cauHoi;
    }

    public function getCauTraLoi()
    {
        return $this->cauTraLoi;
    }

    public function getHinhDaiDien()
    {
        return $this->hinhDaiDien;
    }

    public function getMaToken()
    {
        return $this->maToken;
    }

    public function getThoiGianMaToken()
    {
        return $this->thoiGianMaToken;
    }

    // Setters
    public function setMaTV($maTV)
    {
        $this->maTV = $maTV;
    }

    public function setMaLoaiTV($maLoaiTV)
    {
        $this->maLoaiTV = $maLoaiTV;
    }

    public function setTaiKhoan($taiKhoan)
    {
        $this->taiKhoan = $taiKhoan;
    }

    public function setMatKhau($matKhau)
    {
        $this->matKhau = $matKhau;
    }

    public function setHoTen($hoTen)
    {
        $this->hoTen = $hoTen;
    }

    public function setDiaChi($diaChi)
    {
        $this->diaChi = $diaChi;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setSdt($sdt)
    {
        $this->sdt = $sdt;
    }

    public function setCauHoi($cauHoi)
    {
        $this->cauHoi = $cauHoi;
    }

    public function setCauTraLoi($cauTraLoi)
    {
        $this->cauTraLoi = $cauTraLoi;
    }

    public function setHinhDaiDien($hinhDaiDien)
    {
        $this->hinhDaiDien = $hinhDaiDien;
    }

    public function setMaToken($maToken)
    {
        $this->maToken = $maToken;
    }

    public function setThoiGianMaToken($thoiGianMaToken)
    {
        $this->thoiGianMaToken = $thoiGianMaToken;
    }
}
