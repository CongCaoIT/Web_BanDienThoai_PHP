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
        $DSPNResult = $this->db->callProcedure('GetDSPhieuNhap');

        $DSPNResults = array();

        if ($DSPNResult) {
            while ($row = $DSPNResult->fetch_assoc()) {
                $dh = new ChiTietPhieuNhap();
                $dh->setMaPN($row['MaPN']);
                $dh->ncc->setTenNCC($row['TenNCC']);
                $dh->sp->setTenSP($row['TenSP']);
                $dh->pn->setNgayNhap($row['NgayNhap']);
                $dh->setDonGiaNhap($row['DonGiaNhap']);
                $dh->setSoLuongNhap($row['SoLuongNhap']);

                $DSPNResults[] = $dh;
            }
        } else {
            echo "Chưa có phiếu nhập";
        }
        return $DSPNResults;
    }

    public function showTenNCC()
    {
        $query = "SELECT MaNCC, TenNCC FROM nhacungcap ";
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

    /* public function getMaNCC($tenCC)
    {
        $sp = new ChiTietPhieuNhap();
        $this->fm->validation($tenCC);

        $sp->ncc->setTenNCC($tenCC);

        $tenCC = $sp->ncc->getTenNCC();

        $query = "SELECT MaNCC FROM nhacungcap WHERE TenNCC = '$tenCC' LIMIT 1";
        $result = $this->db->select($query);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['MaNCC'];
        } else {
            return false;
        }
    } */


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
}
