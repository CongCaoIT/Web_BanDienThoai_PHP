<?php
require_once 'ChiTietSanPham.php';
class SanPham
{
    private $maSP;
    private $maNCC;
    private $maLoaiSP;
    private $maKhuyenMai;
    private $tenSP;
    private $donGia;
    private $ngayCapNhat;
    private $moTa;
    private $hinhAnh;
    private $hinhAnh2;
    private $hinhAnh3;
    private $luotXem;
    private $luotBinhChon;
    private $luotBinhLuan;
    private $soLanMua;
    private $moi;
    private $daXoa;
    public $lsp;

    public function __construct($sanPham = null, $maSP = null, $maNCC = null, $maLoaiSP = null, $maKhuyenMai = null, $tenSP = null, $donGia = null, $ngayCapNhat = null, $moTa = null, $hinhAnh = null, $hinhAnh2 = null, $hinhAnh3 = null, $luotXem = null, $luotBinhChon = null, $luotBinhLuan = null, $soLanMua = null, $moi = null, $daXoa = null)
    {
        if ($sanPham !== null) {
            $this->maSP = $sanPham['MaSP'];
            $this->maNCC = $sanPham['MaNCC'];
            $this->maLoaiSP = $sanPham['MaLoaiSP'];
            $this->maKhuyenMai = $sanPham['MaKhuyenMai'];
            $this->tenSP = $sanPham['TenSP'];
            $this->donGia = $sanPham['DonGia'];
            $this->ngayCapNhat = $sanPham['NgayCapNhat'];
            $this->moTa = $sanPham['MoTa'];
            $this->hinhAnh = $sanPham['HinhAnh'];
            $this->hinhAnh2 = $sanPham['HinhAnh2'];
            $this->hinhAnh3 = $sanPham['HinhAnh3'];
            $this->luotXem = $sanPham['LuotXem'];
            $this->luotBinhChon = $sanPham['LuotBinhChon'];
            $this->luotBinhLuan = $sanPham['LuotBinhLuan'];
            $this->soLanMua = $sanPham['SoLanMua'];
            $this->moi = $sanPham['Moi'];
            $this->daXoa = $sanPham['DaXoa'];
        } else {
            $this->maSP = $maSP;
            $this->maNCC = $maNCC;
            $this->maLoaiSP = $maLoaiSP;
            $this->maKhuyenMai = $maKhuyenMai;
            $this->tenSP = $tenSP;
            $this->donGia = $donGia;
            $this->ngayCapNhat = $ngayCapNhat;
            $this->moTa = $moTa;
            $this->hinhAnh = $hinhAnh;
            $this->hinhAnh2 = $hinhAnh2;
            $this->hinhAnh3 = $hinhAnh3;
            $this->luotXem = $luotXem;
            $this->luotBinhChon = $luotBinhChon;
            $this->luotBinhLuan = $luotBinhLuan;
            $this->soLanMua = $soLanMua;
            $this->moi = $moi;
            $this->daXoa = $daXoa;
            $this->lsp = new ChiTietSanPham();
        }
    }

    // Getter và setter cho từng thuộc tính
    public function getMaSP()
    {
        return $this->maSP;
    }

    public function setMaSP($maSP)
    {
        $this->maSP = $maSP;
    }

    public function getMaNCC()
    {
        return $this->maNCC;
    }

    public function setMaNCC($maNCC)
    {
        $this->maNCC = $maNCC;
    }

    public function getMaLoaiSP()
    {
        return $this->maLoaiSP;
    }

    public function setMaLoaiSP($maLoaiSP)
    {
        $this->maLoaiSP = $maLoaiSP;
    }

    public function getMaKhuyenMai()
    {
        return $this->maKhuyenMai;
    }

    public function setMaKhuyenMai($maKhuyenMai)
    {
        $this->maKhuyenMai = $maKhuyenMai;
    }

    public function getTenSP()
    {
        return $this->tenSP;
    }

    public function setTenSP($tenSP)
    {
        $this->tenSP = $tenSP;
    }

    public function getDonGia()
    {
        return $this->donGia;
    }

    public function setDonGia($donGia)
    {
        $this->donGia = $donGia;
    }

    public function getNgayCapNhat()
    {
        return $this->ngayCapNhat;
    }

    public function setNgayCapNhat($ngayCapNhat)
    {
        $this->ngayCapNhat = $ngayCapNhat;
    }

    public function getMoTa()
    {
        return $this->moTa;
    }

    public function setMoTa($moTa)
    {
        $this->moTa = $moTa;
    }

    public function getHinhAnh()
    {
        return $this->hinhAnh;
    }

    public function setHinhAnh($hinhAnh)
    {
        $this->hinhAnh = $hinhAnh;
    }

    public function getHinhAnh2()
    {
        return $this->hinhAnh2;
    }

    public function setHinhAnh2($hinhAnh2)
    {
        $this->hinhAnh2 = $hinhAnh2;
    }

    public function getHinhAnh3()
    {
        return $this->hinhAnh3;
    }

    public function setHinhAnh3($hinhAnh3)
    {
        $this->hinhAnh3 = $hinhAnh3;
    }

    public function getLuotXem()
    {
        return $this->luotXem;
    }

    public function setLuotXem($luotXem)
    {
        $this->luotXem = $luotXem;
    }

    public function getLuotBinhChon()
    {
        return $this->luotBinhChon;
    }

    public function setLuotBinhChon($luotBinhChon)
    {
        $this->luotBinhChon = $luotBinhChon;
    }

    public function getLuotBinhLuan()
    {
        return $this->luotBinhLuan;
    }

    public function setLuotBinhLuan($luotBinhLuan)
    {
        $this->luotBinhLuan = $luotBinhLuan;
    }

    public function getSoLanMua()
    {
        return $this->soLanMua;
    }

    public function setSoLanMua($soLanMua)
    {
        $this->soLanMua = $soLanMua;
    }

    public function getMoi()
    {
        return $this->moi;
    }

    public function setMoi($moi)
    {
        $this->moi = $moi;
    }

    public function getDaXoa()
    {
        return $this->daXoa;
    }

    public function setDaXoa($daXoa)
    {
        $this->daXoa = $daXoa;
    }
}
