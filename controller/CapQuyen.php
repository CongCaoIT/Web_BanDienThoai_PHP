<?php

class CapQuyen
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }


    public function showTTTV()
    {
        $Result = $this->db->callProcedure('GetMembersWithTypes');

        if ($Result) {
            while ($row = $Result->fetch_assoc()) {
                $dh = new ThanhVien();
                $dh->setMaTV($row['MaTV']);
                $dh->setTaiKhoan($row['TaiKhoan']);
                $dh->setEmail($row['Email']);
                $dh->setSdt($row['SoDienThoai']);
                $dh->ltv->setTenLoai($row['TenLoai']);
                $completed[] = $dh;
            }
        }
        return $completed;
    }

    public function getTTThanhVien(int $ma)
    {
        $this->fm->validation($ma);

        $statement = $this->db->prepare("CALL GetMemberById(?)");
        $statement->bind_param("i", $ma);
        $statement->execute();
        $result = $statement->get_result();

        $DSResults = array();

        while ($row = $result->fetch_assoc()) {
            $dh = new ThanhVien();
            $dh->setMaTV($row['MaTV']);
            $dh->setTaiKhoan($row['TaiKhoan']);
            $dh->ltv->setMaLoaiTV($row['MaLoaiTV']);

            $DSResults[] = $dh;
        }

        return $DSResults;
    }

    public function capNhatQuyen($ma, $quyn)
    {
        $ma = $this->fm->validation($ma);
        $quyn = $this->fm->validation($quyn);

        $query = "UPDATE thanhvien SET MaLoaiTV = '$quyn' WHERE MaTV = '$ma'";

        $result = $this->db->update($query);

        if ($result != false) {
            echo '<script>window.location.href = "PhanQuyenPage.php";</script>';
        }
    }
}
