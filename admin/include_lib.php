<?php
include('../model/lib/session.php');
include('../model/lib/database.php');
include('../model/helpers/format.php');

include('../model/ChiTietSanPham.php');
include('../model/SanPham.php');
include('../model/LoaiSanPham.php');
include('../model/NhaCungCap.php');
include('../model/Mau.php');
include('../model/SanPham_Mau.php');
include('../model/ChiTietDonDatHang.php');
include('../model/ChiTietGioHang.php');
include('../model/ChiTietPhieuNhap.php');
include('../model/DonDatHang.php');
include('../model/GioHang.php');
include('../model/KhuyenMai.php');
include('../model/MaHoa.php');
include('../model/ThongKe.php');
include('../model/ThongTinDatHang.php');

include('../controller/Admin/SanPhamController.php');
include('../controller/Admin/ChiTietSanPhamController.php');
include('../controller/Admin/LoaiSanPhamController.php');
include('../controller/Admin/NhaCungCapController.php');
include('../controller/Admin/MauController.php');
include('../controller/Admin/ThongKeController.php');

include('../controller/donHang.php');
include('../controller/phieuNhapController.php');
include('../controller/CapQuyen.php');
