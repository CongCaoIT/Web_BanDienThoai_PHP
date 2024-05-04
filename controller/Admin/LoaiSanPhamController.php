<?php
include_once '../model/config/config.php';
include_once '../model/lib/database.php';
include '../model/LoaiSanPham.php';

class LoaiSanPhamAdmin
{
    private $fm;
    private $db;
    public $completedOrders = array();
    public $updateResult;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function layDSLSP()
    {
        $query = "SELECT * FROM `loaisanpham`";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $dsLSP = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $lsp = new LoaiSanPham();
                $lsp->setMaLoaiSP($row['MaLoaiSP']);
                $lsp->setTenLoaiSP($row['TenLoaiSP']);
                $lsp->setIcon($row['Icon']);
                $lsp->setBiDanh($row['BiDanh']);
                $dsLSP[] = $lsp;
            }
        } else {
            return null;
        }
        return $dsLSP;
    }
}
