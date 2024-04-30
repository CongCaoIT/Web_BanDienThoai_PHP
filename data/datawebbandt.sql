-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 30, 2024 lúc 05:55 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `datawebbandt`
--

DELIMITER $$
--
-- Thủ tục
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllOrders` ()   BEGIN
    SELECT dondathang.MaDDH, dondathang.MaTV, dondathang.NgayDatHang, dondathang.NgayGiao, sanpham.TenSP, chitietdondathang.SoLuong, sanpham.DonGia, dondathang.thanhTien 
    FROM dondathang 
    JOIN chitietdondathang ON dondathang.MaDDH = chitietdondathang.MaDDH 
    JOIN sanpham ON chitietdondathang.MaSP = sanpham.MaSP;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetApprovedOrders` ()   BEGIN
    SELECT `MaDDH`, `MaTV`, `NgayDatHang`, `NgayGiao`, `QuaTang`, `ThanhTien`
    FROM `dondathang`
    WHERE `TinhTrang` LIKE 'Đã duyệt';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetCompletedOrders` ()   BEGIN
    SELECT dondathang.MaDDH, dondathang.MaTV, dondathang.NgayDatHang, dondathang.NgayGiao, sanpham.TenSP, chitietdondathang.SoLuong, sanpham.DonGia, dondathang.thanhTien 
    FROM dondathang 
    JOIN chitietdondathang ON dondathang.MaDDH = chitietdondathang.MaDDH 
    JOIN sanpham ON chitietdondathang.MaSP = sanpham.MaSP
    WHERE dondathang.DaThanhToan = 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetDeliveredOrders` ()   BEGIN
    SELECT `MaDDH`, `MaTV`, `NgayDatHang`, `NgayGiao`, `QuaTang`, `ThanhTien`
    FROM `dondathang`
    WHERE `TinhTrang` LIKE 'Đã giao';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetDSPhieuNhap` ()   BEGIN
    SELECT phieunhap.MaPN, nhacungcap.TenNCC, sanpham.TenSP, phieunhap.NgayNhap, chitietphieunhap.DonGiaNhap, chitietphieunhap.SoLuongNhap 
    FROM chitietphieunhap
    JOIN phieunhap ON chitietphieunhap.MaPN = phieunhap.MaPN
    JOIN nhacungcap ON phieunhap.MaNCC = nhacungcap.MaNCC
    JOIN sanpham ON chitietphieunhap.MaSP = sanpham.MaSP
    WHERE phieunhap.DaXoa = 0;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetMemberById` (IN `memberId` INT)   BEGIN
    SELECT MaTV, TaiKhoan, MaLoaiTV
    FROM thanhvien
    WHERE MaTV = memberId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetMembersWithTypes` ()   BEGIN
    SELECT thanhvien.MaTV, thanhvien.TaiKhoan, thanhvien.Email, thanhvien.SoDienThoai, loaithanhvien.TenLoai
    FROM thanhvien
    JOIN loaithanhvien ON thanhvien.MaLoaiTV = loaithanhvien.MaLoaiTV;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetOrderDetails` (IN `order_id` INT)   BEGIN
    SELECT dondathang.MaDDH, thanhvien.HoTen, dondathang.NgayDatHang, dondathang.DaThanhToan,
           chitietdondathang.MaSP, sanpham.TenSP, chitietdondathang.SoLuong, sanpham.DonGia,
           dondathang.thanhTien, dondathang.MaTV, thanhvien.Email
    FROM dondathang
    JOIN chitietdondathang ON dondathang.MaDDH = chitietdondathang.MaDDH
    JOIN thanhvien ON thanhvien.MaTV = dondathang.MaTV
    JOIN sanpham ON chitietdondathang.MaSP = sanpham.MaSP
    WHERE dondathang.MaDDH = order_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetProductNamesBySupplierID` (IN `supplierID` INT)   BEGIN
    SELECT sanpham.MaSP, sanpham.TenSP
    FROM chitietphieunhap
    JOIN phieunhap ON chitietphieunhap.MaPN = phieunhap.MaPN
    JOIN nhacungcap ON phieunhap.MaNCC = nhacungcap.MaNCC
    JOIN sanpham ON chitietphieunhap.MaSP = sanpham.MaSP
    WHERE phieunhap.DaXoa = 0 AND nhacungcap.MaNCC = supplierID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetProductsByCategoryID` (IN `categoryID` INT)   BEGIN
    SELECT 
        sanpham.MaSP, 
        sanpham.TenSP, 
        sanpham.DonGia, 
        sanpham.MaKhuyenMai, 
        sanpham.NgayCapNhat, 
        sanpham.MoTa, 
        sanpham.HinhAnh, 
        sanpham.HinhAnh2,
        sanpham.DaXoa 
    FROM 
        loaisanpham 
    JOIN 
        sanpham ON loaisanpham.MaLoaiSP = sanpham.MaLoaiSP
    WHERE 
        sanpham.MaLoaiSP = categoryID AND sanpham.DaXoa = 0;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetUnapprovedOrders` ()   BEGIN
    SELECT `MaDDH`, `MaTV`, `NgayDatHang`, `NgayGiao`, `QuaTang`, `ThanhTien`
    FROM `dondathang`
    WHERE `TinhTrang` LIKE 'Chưa duyệt';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateThanhTien` ()   BEGIN
    UPDATE dondathang
    SET thanhTien = (
        SELECT SUM(chitietdondathang.SoLuong * sanpham.DonGia)
        FROM chitietdondathang
        INNER JOIN sanpham ON chitietdondathang.MaSP = sanpham.MaSP
        WHERE chitietdondathang.MaDDH = dondathang.MaDDH
    );
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietdondathang`
--

CREATE TABLE `chitietdondathang` (
  `MaChiTietDDH` int(11) NOT NULL,
  `MaDDH` int(11) NOT NULL,
  `MaSP` int(11) NOT NULL,
  `SoLuong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chitietdondathang`
--

INSERT INTO `chitietdondathang` (`MaChiTietDDH`, `MaDDH`, `MaSP`, `SoLuong`) VALUES
(1, 1, 1, 1),
(2, 2, 2, 2),
(3, 3, 3, 1),
(4, 5, 3, 2),
(5, 7, 1, 5),
(6, 8, 1, 6),
(7, 9, 2, 2),
(8, 10, 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietgiohang`
--

CREATE TABLE `chitietgiohang` (
  `MaChiTietGH` int(11) NOT NULL,
  `MaGioHang` int(11) NOT NULL,
  `MaSP` int(11) NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `DonGia` decimal(18,0) NOT NULL,
  `MaMau` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietphieunhap`
--

CREATE TABLE `chitietphieunhap` (
  `MaCTPN` int(11) NOT NULL,
  `MaPN` int(11) NOT NULL,
  `MaSP` int(11) NOT NULL,
  `DonGiaNhap` decimal(18,0) NOT NULL,
  `SoLuongNhap` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chitietphieunhap`
--

INSERT INTO `chitietphieunhap` (`MaCTPN`, `MaPN`, `MaSP`, `DonGiaNhap`, `SoLuongNhap`) VALUES
(1, 1, 1, 13850000, 20),
(2, 2, 2, 21500000, 10);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietsanpham`
--

CREATE TABLE `chitietsanpham` (
  `MaChiTietSP` int(11) NOT NULL,
  `MaSP` int(11) NOT NULL,
  `KICHTHUOCMANHINH` text DEFAULT NULL,
  `CONGNGHEMANHINH` text DEFAULT NULL,
  `DOPHANGIAI` text DEFAULT NULL,
  `TINHNANGMANGHINH` text DEFAULT NULL,
  `TANSOQUET` text DEFAULT NULL,
  `CAMERASAU` text DEFAULT NULL,
  `QUAYPHIM` text DEFAULT NULL,
  `CAMERATRUOC` text DEFAULT NULL,
  `TINHNANGCAMERA` text DEFAULT NULL,
  `HEDIEUHANH` text DEFAULT NULL,
  `CHIP` text DEFAULT NULL,
  `TOCDOCPU` text DEFAULT NULL,
  `CHIPDOHOA` text DEFAULT NULL,
  `RAM` text DEFAULT NULL,
  `DUNGLUONG` text DEFAULT NULL,
  `MANGDIDONG` text DEFAULT NULL,
  `SIM` text DEFAULT NULL,
  `WIFI` text DEFAULT NULL,
  `CONGKETNOI` text DEFAULT NULL,
  `DUNGLUONGPIN` text DEFAULT NULL,
  `LOAIPIN` text DEFAULT NULL,
  `HOTROSAC` text DEFAULT NULL,
  `BAOMAT` text DEFAULT NULL,
  `TINHNANGDACBIET` text DEFAULT NULL,
  `KHANGNUOC` text DEFAULT NULL,
  `THIETKE` text DEFAULT NULL,
  `CHATLIEU` text DEFAULT NULL,
  `KICHTHUOC` text DEFAULT NULL,
  `BAOHANH` int(11) DEFAULT NULL,
  `RAMAT` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chitietsanpham`
--

INSERT INTO `chitietsanpham` (`MaChiTietSP`, `MaSP`, `KICHTHUOCMANHINH`, `CONGNGHEMANHINH`, `DOPHANGIAI`, `TINHNANGMANGHINH`, `TANSOQUET`, `CAMERASAU`, `QUAYPHIM`, `CAMERATRUOC`, `TINHNANGCAMERA`, `HEDIEUHANH`, `CHIP`, `TOCDOCPU`, `CHIPDOHOA`, `RAM`, `DUNGLUONG`, `MANGDIDONG`, `SIM`, `WIFI`, `CONGKETNOI`, `DUNGLUONGPIN`, `LOAIPIN`, `HOTROSAC`, `BAOMAT`, `TINHNANGDACBIET`, `KHANGNUOC`, `THIETKE`, `CHATLIEU`, `KICHTHUOC`, `BAOHANH`, `RAMAT`) VALUES
(1, 1, '6.7\"', 'OLED', 'Super Retina XDR (1290 x 2796 Pixels)', 'Kính cường lực Ceramic Shield', '120 Hz', 'Chính 48 MP & Phụ 12 MP, 12 MP', 'HD 720p@30fps, FullHD 1080p@60fps, FullHD 1080p@30fps, 4K 2160p@24fps, 4K 2160p@30fps, 4K 2160p@60fps', '12 MP', 'Chế độ hành động (Action Mode), Dolby Vision HDR, Trôi nhanh thời gian (Time Lapse), Góc siêu rộng (Ultrawide), Zoom kỹ thuật số, Cinematic, Quay chậm (Slow Motion), Xóa phông, Deep Fusion, Toàn cảnh (Panorama), Chống rung quang học (OIS), Ban đêm (Night Mode), Zoom quang học Siêu cận (Macro), Live Photo, Bộ lọc màu, Smart HDR 4', 'iOS 16', 'Apple A16 Bionic 6 nhân', '3.46 GHz', 'Apple GPU 5 nhân', '6 GB', '128GB', 'Hỗ trợ 5G', '1 Nano SIM & 1 eSIM', 'Wi-Fi MIMO, Wi-Fi hotspot, Wi-Fi 802.11 a/b/g/n/ac/ax', 'Lightning', '4323 mAh', 'Li-Ion', '20 W', 'Mở khoá khuôn mặt Face ID', 'Phát hiện va chạm (Crash Detection), Màn hình luôn hiển thị AOD, Chạm 2 lần sáng màn hình, Apple Pay, Loa kép', 'IP68', 'Nguyên khối', 'Khung thép không gỉ & Mặt lưng kính cường lực', 'Dài 160.7 mm - Ngang 77.6 mm - Dày 7.85 mm - Nặng 240 g', 12, '2022-09-01'),
(2, 2, '6.7\"', 'OLED', 'Super Retina XDR (1290 x 2796 Pixels)', 'Kính cường lực Ceramic Shield', '120 Hz', 'Chính 48 MP & Phụ 12 MP, 12 MP', 'HD 720p@30fps, FullHD 1080p@60fps, FullHD 1080p@30fps, 4K 2160p@24fps, 4K 2160p@30fps, 4K 2160p@60fps', '12 MP', 'Chế độ hành động (Action Mode), Dolby Vision HDR, Trôi nhanh thời gian (Time Lapse), Góc siêu rộng (Ultrawide), Zoom kỹ thuật số, Cinematic, Quay chậm (Slow Motion), Xóa phông, Deep Fusion, Toàn cảnh (Panorama), Chống rung quang học (OIS), Ban đêm (Night Mode), Zoom quang học Siêu cận (Macro), Live Photo, Bộ lọc màu, Smart HDR 4', 'iOS 16', 'Apple A16 Bionic 6 nhân', '3.46 GHz', 'Apple GPU 5 nhân', '6 GB', '256GB', 'Hỗ trợ 5G', '1 Nano SIM & 1 eSIM', 'Wi-Fi MIMO, Wi-Fi hotspot, Wi-Fi 802.11 a/b/g/n/ac/ax', 'Lightning', '4323 mAh', 'Li-Ion', '20 W', 'Mở khoá khuôn mặt Face ID', 'Phát hiện va chạm (Crash Detection), Màn hình luôn hiển thị AOD, Chạm 2 lần sáng màn hình, Apple Pay, Loa kép', 'IP68', 'Nguyên khối', 'Khung thép không gỉ & Mặt lưng kính cường lực', 'Dài 160.7 mm - Ngang 77.6 mm - Dày 7.85 mm - Nặng 240 g', 12, '2022-09-01'),
(3, 3, '6.7\"', 'OLED', 'Super Retina XDR (1290 x 2796 Pixels)', 'Kính cường lực Ceramic Shield', '120 Hz', 'Chính 48 MP & Phụ 12 MP, 12 MP', 'HD 720p@30fps, FullHD 1080p@60fps, FullHD 1080p@30fps, 4K 2160p@24fps, 4K 2160p@30fps, 4K 2160p@60fps', '12 MP', 'Chế độ hành động (Action Mode), Dolby Vision HDR, Trôi nhanh thời gian (Time Lapse), Góc siêu rộng (Ultrawide), Zoom kỹ thuật số, Cinematic, Quay chậm (Slow Motion), Xóa phông, Deep Fusion, Toàn cảnh (Panorama), Chống rung quang học (OIS), Ban đêm (Night Mode), Zoom quang học Siêu cận (Macro), Live Photo, Bộ lọc màu, Smart HDR 4', 'iOS 16', 'Apple A16 Bionic 6 nhân', '3.46 GHz', 'Apple GPU 5 nhân', '6 GB', '512GB', 'Hỗ trợ 5G', '1 Nano SIM & 1 eSIM', 'Wi-Fi MIMO, Wi-Fi hotspot, Wi-Fi 802.11 a/b/g/n/ac/ax', 'Lightning', '4323 mAh', 'Li-Ion', '20 W', 'Mở khoá khuôn mặt Face ID', 'Phát hiện va chạm (Crash Detection), Màn hình luôn hiển thị AOD, Chạm 2 lần sáng màn hình, Apple Pay, Loa kép', 'IP68', 'Nguyên khối', 'Khung thép không gỉ & Mặt lưng kính cường lực', 'Dài 160.7 mm - Ngang 77.6 mm - Dày 7.85 mm - Nặng 240 g', 12, '2022-09-01'),
(4, 4, '6.7\"', 'OLED', 'Super Retina XDR (1290 x 2796 Pixels)', 'Kính cường lực Ceramic Shield', '120 Hz', 'Chính 48 MP & Phụ 12 MP, 12 MP', 'HD 720p@30fps, FullHD 1080p@60fps, FullHD 1080p@30fps, 4K 2160p@24fps, 4K 2160p@30fps, 4K 2160p@60fps', '12 MP', 'Chế độ hành động (Action Mode), Dolby Vision HDR, Trôi nhanh thời gian (Time Lapse), Góc siêu rộng (Ultrawide), Zoom kỹ thuật số, Cinematic, Quay chậm (Slow Motion), Xóa phông, Deep Fusion, Toàn cảnh (Panorama), Chống rung quang học (OIS), Ban đêm (Night Mode), Zoom quang học Siêu cận (Macro), Live Photo, Bộ lọc màu, Smart HDR 4', 'iOS 16', 'Apple A16 Bionic 6 nhân', '3.46 GHz', 'Apple GPU 5 nhân', '6 GB', '1TB', 'Hỗ trợ 5G', '1 Nano SIM & 1 eSIM', 'Wi-Fi MIMO, Wi-Fi hotspot, Wi-Fi 802.11 a/b/g/n/ac/ax', 'Lightning', '4323 mAh', 'Li-Ion', '20 W', 'Mở khoá khuôn mặt Face ID', 'Phát hiện va chạm (Crash Detection), Màn hình luôn hiển thị AOD, Chạm 2 lần sáng màn hình, Apple Pay, Loa kép', 'IP68', 'Nguyên khối', 'Khung thép không gỉ & Mặt lưng kính cường lực', 'Dài 160.7 mm - Ngang 77.6 mm - Dày 7.85 mm - Nặng 240 g', 12, '2022-09-01'),
(5, 5, '6.7\"', 'OLED', 'Super Retina XDR (1284 x 2778 Pixels)', 'Kính cường lực Ceramic Shield', '120 Hz', '3 camera 12 MP', 'HD 720p@30fps, FullHD 1080p@60fps, FullHD 1080p@30fps, 4K 2160p@24fps, 4K 2160p@30fps, 4K 2160p@60fps', '12 MP', 'Deep Fusion, Toàn cảnh (Panorama), Chống rung quang học (OIS), Tự động lấy nét (AF), Nhận diện khuôn mặt, Ảnh Raw, Ban đêm (Night Mode), Chạm lấy nét, Zoom quang học, Siêu cận (Macro), Smart HDR 4', 'iOS 15', 'Apple A15 Bionic 6 nhân', '3.22 GHz', 'Apple GPU 5 nhân', '6 GB', '128GB', 'Hỗ trợ 5G', '1 Nano SIM & 1 eSIM', 'Wi-Fi MIMO, Wi-Fi hotspot, Wi-Fi 802.11 a/b/g/n/ac/ax', 'Lightning', '4352 mAh', 'Li-Ion', '20 W', 'Mở khoá khuôn mặt Face ID', 'Phát hiện va chạm (Crash Detection), Màn hình luôn hiển thị AOD, Chạm 2 lần sáng màn hình, Apple Pay, Loa kép', 'IP68', 'Nguyên khối', 'Khung thép không gỉ & Mặt lưng kính cường lực', 'Dài 160.8 mm - Ngang 78.1 mm - Dày 7.65 mm - Nặng 240 g', 12, '2021-09-01'),
(6, 6, '6.7\"', 'OLED', 'Super Retina XDR (1284 x 2778 Pixels)', 'Kính cường lực Ceramic Shield', '120 Hz', '3 camera 12 MP', 'HD 720p@30fps, FullHD 1080p@60fps, FullHD 1080p@30fps, 4K 2160p@24fps, 4K 2160p@30fps, 4K 2160p@60fps', '12 MP', 'Deep Fusion, Toàn cảnh (Panorama), Chống rung quang học (OIS), Tự động lấy nét (AF), Nhận diện khuôn mặt, Ảnh Raw, Ban đêm (Night Mode), Chạm lấy nét, Zoom quang học, Siêu cận (Macro), Smart HDR 4', 'iOS 15', 'Apple A15 Bionic 6 nhân', '3.22 GHz', 'Apple GPU 5 nhân', '6 GB', '256GB', 'Hỗ trợ 5G', '1 Nano SIM & 1 eSIM', 'Wi-Fi MIMO, Wi-Fi hotspot, Wi-Fi 802.11 a/b/g/n/ac/ax', 'Lightning', '4352 mAh', 'Li-Ion', '20 W', 'Mở khoá khuôn mặt Face ID', 'Phát hiện va chạm (Crash Detection), Màn hình luôn hiển thị AOD, Chạm 2 lần sáng màn hình, Apple Pay, Loa kép', 'IP68', 'Nguyên khối', 'Khung thép không gỉ & Mặt lưng kính cường lực', 'Dài 160.8 mm - Ngang 78.1 mm - Dày 7.65 mm - Nặng 240 g', 12, '2021-09-01'),
(7, 7, '6.7\"', 'OLED', 'Super Retina XDR (1284 x 2778 Pixels)', 'Kính cường lực Ceramic Shield', '120 Hz', '3 camera 12 MP', 'HD 720p@30fps, FullHD 1080p@60fps, FullHD 1080p@30fps, 4K 2160p@24fps, 4K 2160p@30fps, 4K 2160p@60fps', '12 MP', 'Deep Fusion, Toàn cảnh (Panorama), Chống rung quang học (OIS), Tự động lấy nét (AF), Nhận diện khuôn mặt, Ảnh Raw, Ban đêm (Night Mode), Chạm lấy nét, Zoom quang học, Siêu cận (Macro), Smart HDR 4', 'iOS 15', 'Apple A15 Bionic 6 nhân', '3.22 GHz', 'Apple GPU 5 nhân', '6 GB', '512GB', 'Hỗ trợ 5G', '1 Nano SIM & 1 eSIM', 'Wi-Fi MIMO, Wi-Fi hotspot, Wi-Fi 802.11 a/b/g/n/ac/ax', 'Lightning', '4352 mAh', 'Li-Ion', '20 W', 'Mở khoá khuôn mặt Face ID', 'Phát hiện va chạm (Crash Detection), Màn hình luôn hiển thị AOD, Chạm 2 lần sáng màn hình, Apple Pay, Loa kép', 'IP68', 'Nguyên khối', 'Khung thép không gỉ & Mặt lưng kính cường lực', 'Dài 160.8 mm - Ngang 78.1 mm - Dày 7.65 mm - Nặng 240 g', 12, '2021-09-01'),
(8, 8, '6.7\"', 'OLED', 'Super Retina XDR (1284 x 2778 Pixels)', 'Kính cường lực Ceramic Shield', '60 Hz', '3 camera 12 MP', 'HD 720p@30fps, FullHD 1080p@60fps, FullHD 1080p@30fps, 4K 2160p@24fps, 4K 2160p@30fps, 4K 2160p@60fps', '12 MP', 'Deep Fusion, Toàn cảnh (Panorama), Chống rung quang học (OIS), Tự động lấy nét (AF), Nhận diện khuôn mặt, Ban đêm (Night Mode), Zoom quang học, Siêu cận (Macro), Smart HDR 4', 'iOS 15', 'Apple A14 Bionic 6 nhân', '2 nhân 3.1 GHz & 4 nhân 1.8 GHz', 'Apple GPU 4 nhân', '6 GB', '128GB', 'Hỗ trợ 5G', '1 Nano SIM & 1 eSIM', 'Wi-Fi MIMO, Wi-Fi hotspot, Wi-Fi 802.11 a/b/g/n/ac/ax', 'Lightning', '3687 mAh', 'Li-Ion', '20 W', 'Mở khoá khuôn mặt Face ID', 'Phát hiện va chạm (Crash Detection), Màn hình luôn hiển thị AOD, Chạm 2 lần sáng màn hình', 'IP68', 'Nguyên khối', 'Khung thép không gỉ & Mặt lưng kính cường lực', 'Dài 160.8 mm - Ngang 78.1 mm - Dày 7.4 mm - Nặng 228 g', 12, '2020-10-01'),
(9, 9, '6.7\"', 'OLED', 'Super Retina XDR (1284 x 2778 Pixels)', 'Kính cường lực Ceramic Shield', '60 Hz', '3 camera 12 MP', 'HD 720p@30fps, FullHD 1080p@60fps, FullHD 1080p@30fps, 4K 2160p@24fps, 4K 2160p@30fps, 4K 2160p@60fps', '12 MP', 'Deep Fusion, Toàn cảnh (Panorama), Chống rung quang học (OIS), Tự động lấy nét (AF), Nhận diện khuôn mặt, Ban đêm (Night Mode), Zoom quang học, Siêu cận (Macro), Smart HDR 4', 'iOS 15', 'Apple A14 Bionic 6 nhân', '2 nhân 3.1 GHz & 4 nhân 1.8 GHz', 'Apple GPU 4 nhân', '6 GB', '256GB', 'Hỗ trợ 5G', '1 Nano SIM & 1 eSIM', 'Wi-Fi MIMO, Wi-Fi hotspot, Wi-Fi 802.11 a/b/g/n/ac/ax', 'Lightning', '3687 mAh', 'Li-Ion', '20 W', 'Mở khoá khuôn mặt Face ID', 'Phát hiện va chạm (Crash Detection), Màn hình luôn hiển thị AOD, Chạm 2 lần sáng màn hình', 'IP68', 'Nguyên khối', 'Khung thép không gỉ & Mặt lưng kính cường lực', 'Dài 160.8 mm - Ngang 78.1 mm - Dày 7.4 mm - Nặng 228 g', 12, '2020-10-01'),
(10, 10, 'Chính 6.8\" & Phụ 3.26\"', 'AMOLED', 'Chính: FHD+ (2520 x 1080 Pixels) & Phụ: (720 x 382 Pixels)', 'Kính siêu mỏng Ultra Thin Glass (UTG)', '120 Hz & 60 Hz', 'Chính 50 MP & Phụ 8 MP', 'HD 720p@30fps, FullHD 1080p@60fps, FullHD 1080p@30fps, 4K 2160p@24fps, 4K 2160p@30fps', '32 MP', 'Trôi nhanh thời gian (Time Lapse), Quay chậm (Slow Motion), Xóa phông, Toàn cảnh (Panorama), Ban đêm (Night Mode), Chuyên nghiệp (Pro), HDR, Zoom quang học, Siêu độ phân giải, AI Camera, Làm đẹp, Nhãn dán (AR Stickers), Bộ lọc màu', 'Android 13', 'MediaTek Dimensity 9000+ 8 nhân', '3.2 GHz', 'Mali-G710 MC10', '8 GB', '256GB', 'Hỗ trợ 5G', '2 Nano SIM', 'Wi-Fi MIMO, Wi-Fi hotspot, Wi-Fi 802.11 a/b/g/n/ac/ax', 'Type-C', '4300 mAh', 'Li-Po', '44 W', 'Mở khoá vân tay cạnh viền, Mở khoá khuôn mặt', 'Cử chỉ thông minh, Mở rộng bộ nhớ RAM, Ứng dụng kép (Nhân bản ứng dụng), Thu nhỏ màn hình sử dụng một tay, Đa cửa sổ (chia đôi màn hình), Chế độ trẻ em (Không gian trẻ em)', 'IPX4', 'Nguyên khối', 'Khung hợp kim & Mặt lưng kính cường lực Gorilla Glass 5', 'Dài 166.2 mm - Ngang 75.2 mm - Dày 7.45 mm - Nặng 191 g', 12, '2023-04-01'),
(11, 11, '6.7\"', 'AMOLED', 'Full HD+ (1080 x 2412 Pixels)', 'Kính cường lực AGC DT-Star2', '120 Hz', 'Chính 50 MP & Phụ 32 MP, 8 MP', 'HD 720p@30fps, FullHD 1080p@60fps, FullHD 1080p@30fps, 4K 2160p@24fps, 4K 2160p@30fps', '32 MP', 'Trôi nhanh thời gian (Time Lapse), Quay chậm (Slow Motion), Xóa phông, Toàn cảnh (Panorama), Ban đêm (Night Mode), Chuyên nghiệp (Pro), HDR, Zoom quang học, Siêu độ phân giải, AI Camera, Làm đẹp, Nhãn dán (AR Stickers), Bộ lọc màu', 'Android 13', 'Snapdragon 778G 5G 8 nhân', '2.4 GHz', 'Adreno 642L', '12 GB', '256GB', 'Hỗ trợ 5G', '2 Nano SIM', 'Wi-Fi MIMO, Wi-Fi hotspot, Wi-Fi 6', 'Type-C', '4600 mAh', 'Li-Po', '80 W', 'Mở khoá vân tay cạnh viền, Mở khoá khuôn mặt', 'Cử chỉ thông minh, Mở rộng bộ nhớ RAM, Ứng dụng kép (Nhân bản ứng dụng), Thu nhỏ màn hình sử dụng một tay, Đa cửa sổ (chia đôi màn hình), Chế độ trẻ em (Không gian trẻ em)', 'IP54', 'Nguyên khối', 'Khung nhựa & Mặt lưng kính', 'Dài 162.3 mm - Ngang 74.2 mm - Dày 7.89 mm - Nặng 185 g', 12, '2023-08-01'),
(12, 12, '6.56\"', 'IPS LCD', 'HD+ (720 x 1612 Pixels)', 'Kính cường lực Panda', '90 Hz', 'Chính 50 MP & Phụ 2 MP', 'HD 720p@30fps, FullHD 1080p@30fps', '8 MP', 'Trôi nhanh thời gian (Time Lapse), Xóa phông, Toàn cảnh (Panorama), Ban đêm (Night Mode), HDR, Zoom quang học, Siêu độ phân giải, Làm đẹp, Bộ lọc màu', 'Android 12', 'Snapdragon 680 8 nhân', '2.4 GHz', 'Adreno 610', '8 GB', '128GB', 'Hỗ trợ 4G', '2 Nano SIM', 'Wi-Fi 802.11 a/b/g/n/ac, Dual-band (2.4 GHz/5 GHz)', 'Type-C', '5000 mAh', 'Li-Po', '33 W', 'Mở khoá vân tay cạnh viền, Mở khoá khuôn mặt', 'Cử chỉ thông minh, Mở rộng bộ nhớ RAM, Ứng dụng kép (Nhân bản ứng dụng), Thu nhỏ màn hình sử dụng một tay, Đa cửa sổ (chia đôi màn hình), Chế độ trẻ em (Không gian trẻ em)', 'IPX4', 'Nguyên khối', 'Khung nhựa & Mặt lưng thuỷ tinh hữu cơ', 'Dài 163.74 mm - Ngang 75.03 mm - Dày 7.99 mm - Nặng 187 g', 12, '2022-10-01'),
(13, 13, '6.56\"', 'AMOLED', 'Full HD+ (1080 x 2376 Pixels)', 'Kính cường lực Schott Xensation UP', '120 Hz', 'Chính 64 MP & Phụ 8 MP, 2 MP', 'HD 720p@30fps, FullHD 1080p@60fps, FullHD 1080p@30fps, 4K 2160p@30fps, 4K 2160p@60fps, HD 720p@60fps', '32 MP', 'Quay video hiển thị kép, Trôi nhanh thời gian (Time Lapse), Góc siêu rộng (Ultrawide), Zoom kỹ thuật số, Quay chậm (Slow Motion), Xóa phông, Toàn cảnh (Panorama), Chống rung quang học (OIS), Tự động lấy nét (AF), Ban đêm (Night Mode), Chuyên nghiệp (Pro), HDR, Siêu độ phân giải, AI Camera, Làm đẹp, Siêu cận (Macro), Hiệu ứng Bokeh, Bộ lọc màu', 'Android 12', 'MediaTek Dimensity 1300 8 nhân', '1 nhân 3 GHz, 3 nhân 2.6 GHz & 4 nhân 2 GHz', 'Mali-G77', '8 GB', '128GB', 'Hỗ trợ 5G', '2 Nano SIM', 'Wi-Fi Direct, Wi-Fi 802.11 a/b/g/n/ac, Dual-band (2.4 GHz/5 GHz)', 'Type-C', '4830 mAh', 'Li-Po', '66 W', 'Mở khoá vân tay cạnh viền, Mở khoá khuôn mặt', 'Cử chỉ thông minh, Mở rộng bộ nhớ RAM, Ứng dụng kép (Nhân bản ứng dụng), Thu nhỏ màn hình sử dụng một tay, Đa cửa sổ (chia đôi màn hình), Chế độ trẻ em (Không gian trẻ em)', 'IPX4', 'Nguyên khối', 'Khung kim loại & Mặt lưng kính', 'Dài 158.9 mm - Ngang 73.52 mm - Dày 8.62 mm - Nặng 190 g', 12, '2022-11-01'),
(14, 14, '6.51\"', 'IPS LCD', 'HD+ (720 x 1600 Pixels)', 'Kính cường lực Panda', '60 Hz', '8 MP', 'HD 720p@30fps, FullHD 1080p@30fps', '5 MP', 'Trôi nhanh thời gian (Time Lapse), Xóa phông, Làm đẹp', 'Android 12', 'MediaTek Helio P35 8 nhân', '4 nhân 2.3 GHz & 4 nhân 1.8 GHz', 'IMG PowerVR GE8320', '3 GB', '32 GB', 'Hỗ trợ 4G', '2 Nano SIM', 'Dual-band (2.4 GHz/5 GHz)', 'Micro USB', '5000 mAh', 'Li-Po', '10 W', 'Mở khoá khuôn mặt', 'Chế độ đơn giản (Giao diện đơn giản), Chặn cuộc gọi, Chặn tin nhắn, Chạm 2 lần tắt/sáng màn hình, Trợ lý ảo Google Assistant', 'IP52', 'Nguyên khối', 'Khung & Mặt lưng nhựa Polymer cao cấp', 'Dài 163.99 mm - Ngang 75.63 mm - Dày 8.49 mm - Nặng 186 g', 12, '2023-03-01'),
(15, 15, '6.62\"', 'AMOLED', 'Full HD+ (1080 x 2400 Pixels)', 'Kính cường lực Schott Xensation UP', '120 Hz', 'Chính 64 MP & Phụ 2 MP, 2 MP', 'HD 720p@30fps, FullHD 1080p@30fps, HD 720p@60fps', '32 MP', 'Quay video hiển thị kép, Phơi sáng kép, Trôi nhanh thời gian (Time Lapse), Quay chậm (Slow Motion), Xóa phông, Toàn cảnh (Panorama), Chống rung quang học (OIS), Tự động lấy nét (AF), Ban đêm (Night Mode), Chuyên nghiệp (Pro), HDR, Siêu độ phân giải, Làm đẹp, Siêu cận (Macro), Live Photo, Bộ lọc màu', 'Android 13', 'MediaTek Helio G99 8 nhân', '2 nhân 2.2 GHz & 6 nhân 2.0 GHz', 'Mali-G57', '8 GB', '256 GB', 'Hỗ trợ 4G', '2 Nano SIM', 'Dual-band (2.4 GHz/5 GHz), Wi-Fi Direct', 'Type-C', '4600 mAh', 'Li-Po', '66 W', 'Mở khoá vân tay dưới màn hình, Mở khoá khuôn mặt', 'Chế độ đơn giản (Giao diện đơn giản), Chặn cuộc gọi, Chặn tin nhắn, Chạm 2 lần tắt/sáng màn hình, Trợ lý ảo Google Assistant', 'IP54', 'Nguyên khối', 'Khung & Mặt lưng nhựa', 'Dài 162.51 mm - Ngang 75.81 mm - Dày 7.8 mm - Nặng 186 g', 12, '2023-05-01'),
(16, 16, 'Chính 7.6\" & Phụ 6.2\"', 'Dynamic AMOLED 2X', 'Chính: QXGA+ (2176 x 1812 Pixels) & Phụ: HD+ (2316 x 904 Pixels)', 'Chính: Ultra Thin Glass & Phụ: Corning Gorilla Glass Victus 2', '120 Hz', 'Chính 50 MP & Phụ 12 MP, 10 MP', 'HD 720p@30fps, FullHD 1080p@30fps, HD 720p@60fps, 4K 2160p@30fps, 4K 2160p@60fps, 8K 4320p@30fps', '10 MP & 4 MPP', 'Trôi nhanh thời gian (Time Lapse), Góc siêu rộng (Ultrawide), Zoom kỹ thuật số, Góc rộng (Wide), FlexCam, Quay chậm (Slow Motion), Xóa phông, Toàn cảnh (Panorama), Chống rung quang học (OIS), Ban đêm (Night Mode), Chuyên nghiệp (Pro), HDR, Zoom quang học, Quay Siêu chậm (Super Slow Motion), Làm đẹp, Hiệu ứng Bokeh, Bộ lọc màu', 'Android 13', 'Snapdragon 8 Gen 2 for Galaxy', '1 nhân 3.36 GHz, 4 nhân 2.8 GHz & 3 nhân 2 GHz', 'Adreno 740', '12 GB', '256 GB', 'Hỗ trợ 5G', '2 Nano SIM hoặc 1 Nano SIM + 1 eSIM', 'Dual-band (2.4 GHz/5 GHz), Wi-Fi MIMO, Wi-Fi 802.11 a/b/g/n/ac/ax', 'Type-C', '4400 mAh', 'Li-Po', '25 W', 'Mở khoá vân tay cạnh viền, Mở khoá khuôn mặt', 'Chế độ đơn giản (Giao diện đơn giản), Chặn cuộc gọi, Chặn tin nhắn, Chạm 2 lần tắt/sáng màn hình, Trợ lý ảo Google Assistant', 'IPX8', 'Nguyên khối', 'Khung nhôm & Mặt lưng kính cường lực', 'Dài 154.9 mm - Ngang 129.9 mm - Dày 6.1 mm - Nặng 253 g', 18, '2023-07-01'),
(17, 17, 'Chính 7.6\" & Phụ 6.2\"', 'Dynamic AMOLED 2X', 'Chính: QXGA+ (2176 x 1812 Pixels) & Phụ: HD+ (2316 x 904 Pixels)', 'Chính: Ultra Thin Glass & Phụ: Corning Gorilla Glass Victus 2', '120 Hz', 'Chính 50 MP & Phụ 12 MP, 10 MP', 'HD 720p@30fps, FullHD 1080p@30fps, HD 720p@60fps, 4K 2160p@30fps, 4K 2160p@60fps, 8K 4320p@30fps', '10 MP & 4 MPP', 'Trôi nhanh thời gian (Time Lapse), Góc siêu rộng (Ultrawide), Zoom kỹ thuật số, Góc rộng (Wide), FlexCam, Quay chậm (Slow Motion), Xóa phông, Toàn cảnh (Panorama), Chống rung quang học (OIS), Ban đêm (Night Mode), Chuyên nghiệp (Pro), HDR, Zoom quang học, Quay Siêu chậm (Super Slow Motion), Làm đẹp, Hiệu ứng Bokeh, Bộ lọc màu', 'Android 13', 'Snapdragon 8 Gen 2 for Galaxy', '1 nhân 3.36 GHz, 4 nhân 2.8 GHz & 3 nhân 2 GHz', 'Adreno 740', '12 GB', '512 GB', 'Hỗ trợ 5G', '2 Nano SIM hoặc 1 Nano SIM + 1 eSIM', 'Dual-band (2.4 GHz/5 GHz), Wi-Fi MIMO, Wi-Fi 802.11 a/b/g/n/ac/ax', 'Type-C', '4400 mAh', 'Li-Po', '25 W', 'Mở khoá vân tay cạnh viền, Mở khoá khuôn mặt', 'Chế độ đơn giản (Giao diện đơn giản), Chặn cuộc gọi, Chặn tin nhắn, Chạm 2 lần tắt/sáng màn hình, Trợ lý ảo Google Assistant', 'IPX8', 'Nguyên khối', 'Khung nhôm & Mặt lưng kính cường lực', 'Dài 154.9 mm - Ngang 129.9 mm - Dày 6.1 mm - Nặng 253 g', 18, '2023-07-01'),
(18, 18, 'Chính 7.6\" & Phụ 6.2\"', 'Dynamic AMOLED 2X', 'Chính: QXGA+ (2176 x 1812 Pixels) & Phụ: HD+ (2316 x 904 Pixels)', 'Chính: Ultra Thin Glass & Phụ: Corning Gorilla Glass Victus 2', '120 Hz', 'Chính 50 MP & Phụ 12 MP, 10 MP', 'HD 720p@30fps, FullHD 1080p@30fps, HD 720p@60fps, 4K 2160p@30fps, 4K 2160p@60fps, 8K 4320p@30fps', '10 MP & 4 MPP', 'Trôi nhanh thời gian (Time Lapse), Góc siêu rộng (Ultrawide), Zoom kỹ thuật số, Góc rộng (Wide), FlexCam, Quay chậm (Slow Motion), Xóa phông, Toàn cảnh (Panorama), Chống rung quang học (OIS), Ban đêm (Night Mode), Chuyên nghiệp (Pro), HDR, Zoom quang học, Quay Siêu chậm (Super Slow Motion), Làm đẹp, Hiệu ứng Bokeh, Bộ lọc màu', 'Android 13', 'Snapdragon 8 Gen 2 for Galaxy', '1 nhân 3.36 GHz, 4 nhân 2.8 GHz & 3 nhân 2 GHz', 'Adreno 740', '12 GB', '1TB', 'Hỗ trợ 5G', '2 Nano SIM hoặc 1 Nano SIM + 1 eSIM', 'Dual-band (2.4 GHz/5 GHz), Wi-Fi MIMO, Wi-Fi 802.11 a/b/g/n/ac/ax', 'Type-C', '4400 mAh', 'Li-Po', '25 W', 'Mở khoá vân tay cạnh viền, Mở khoá khuôn mặt', 'Chế độ đơn giản (Giao diện đơn giản), Chặn cuộc gọi, Chặn tin nhắn, Chạm 2 lần tắt/sáng màn hình, Trợ lý ảo Google Assistant', 'IPX8', 'Nguyên khối', 'Khung nhôm & Mặt lưng kính cường lực', 'Dài 154.9 mm - Ngang 129.9 mm - Dày 6.1 mm - Nặng 253 g', 18, '2023-07-01'),
(19, 19, 'Chính 6.7\" & Phụ 1.9\"', 'Chính: Dynamic AMOLED 2X, Phụ: Super AMOLED', 'Chính: FHD+ (2640 x 1080 Pixels) x Phụ: (260 x 512 Pixels)', 'Chính: Ultra Thin Glass & Phụ: Corning Gorilla Glass Victus+', '120 Hz', '2 camera 12 MP', 'HD 720p@30fps, FullHD 1080p@30fps, HD 720p@60fps, 4K 2160p@30fps, 4K 2160p@60fps', '10 MP', 'Trôi nhanh thời gian (Time Lapse), Góc siêu rộng (Ultrawide), Zoom kỹ thuật số, Góc rộng (Wide), FlexCam, Quay chậm (Slow Motion), Xóa phông, Toàn cảnh (Panorama), Chống rung quang học (OIS), Ban đêm (Night Mode), Chuyên nghiệp (Pro), HDR, Zoom quang học, Quay Siêu chậm (Super Slow Motion), Làm đẹp, Hiệu ứng Bokeh, Bộ lọc màu', 'Android 12', 'Snapdragon 8+ Gen 1 8 nhân', '1 nhân 3.18 GHz, 3 nhân 2.7 GHz & 4 nhân 2 GHz', 'Adreno 670', '8 GB', '128 GB', 'Hỗ trợ 5G', '1 Nano SIM & 1 eSIM', 'Dual-band (2.4 GHz/5 GHz), Wi-Fi MIMO, Wi-Fi 802.11 a/b/g/n/ac/ax', 'Type-C', '3700 mAh', 'Li-Ion', '25 W', 'Mở khoá vân tay cạnh viền, Mở khoá khuôn mặt', 'Chế độ đơn giản (Giao diện đơn giản), Chặn cuộc gọi, Chặn tin nhắn, Chạm 2 lần tắt/sáng màn hình, Trợ lý ảo Google Assistant', 'IPX8', 'Nguyên khối', 'Khung nhôm & Mặt lưng kính cường lực', 'Dài 165.2 mm - Ngang 71.9 mm - Dày 6.9 mm - Nặng 187 g', 12, '2022-08-01'),
(20, 20, 'Chính 6.7\" & Phụ 1.9\"', 'Chính: Dynamic AMOLED 2X, Phụ: Super AMOLED', 'Chính: FHD+ (2640 x 1080 Pixels) x Phụ: (260 x 512 Pixels)', 'Chính: Ultra Thin Glass & Phụ: Corning Gorilla Glass Victus+', '120 Hz', '2 camera 12 MP', 'HD 720p@30fps, FullHD 1080p@30fps, HD 720p@60fps, 4K 2160p@30fps, 4K 2160p@60fps', '10 MP', 'Trôi nhanh thời gian (Time Lapse), Góc siêu rộng (Ultrawide), Zoom kỹ thuật số, Góc rộng (Wide), FlexCam, Quay chậm (Slow Motion), Xóa phông, Toàn cảnh (Panorama), Chống rung quang học (OIS), Ban đêm (Night Mode), Chuyên nghiệp (Pro), HDR, Zoom quang học, Quay Siêu chậm (Super Slow Motion), Làm đẹp, Hiệu ứng Bokeh, Bộ lọc màu', 'Android 12', 'Snapdragon 8+ Gen 1 8 nhân', '1 nhân 3.18 GHz, 3 nhân 2.7 GHz & 4 nhân 2 GHz', 'Adreno 670', '8 GB', '256 GB', 'Hỗ trợ 5G', '1 Nano SIM & 1 eSIM', 'Dual-band (2.4 GHz/5 GHz), Wi-Fi MIMO, Wi-Fi 802.11 a/b/g/n/ac/ax', 'Type-C', '3700 mAh', 'Li-Ion', '25 W', 'Mở khoá vân tay cạnh viền, Mở khoá khuôn mặt', 'Chế độ đơn giản (Giao diện đơn giản), Chặn cuộc gọi, Chặn tin nhắn, Chạm 2 lần tắt/sáng màn hình, Trợ lý ảo Google Assistant', 'IPX8', 'Nguyên khối', 'Khung nhôm & Mặt lưng kính cường lực', 'Dài 165.2 mm - Ngang 71.9 mm - Dày 6.9 mm - Nặng 187 g', 12, '2022-08-01'),
(21, 21, 'Chính 6.7\" & Phụ 1.9\"', 'Chính: Dynamic AMOLED 2X, Phụ: Super AMOLED', 'Chính: FHD+ (2640 x 1080 Pixels) x Phụ: (260 x 512 Pixels)', 'Chính: Ultra Thin Glass & Phụ: Corning Gorilla Glass Victus+', '120 Hz', '2 camera 12 MP', 'HD 720p@30fps, FullHD 1080p@30fps, HD 720p@60fps, 4K 2160p@30fps, 4K 2160p@60fps', '10 MP', 'Trôi nhanh thời gian (Time Lapse), Góc siêu rộng (Ultrawide), Zoom kỹ thuật số, Góc rộng (Wide), FlexCam, Quay chậm (Slow Motion), Xóa phông, Toàn cảnh (Panorama), Chống rung quang học (OIS), Ban đêm (Night Mode), Chuyên nghiệp (Pro), HDR, Zoom quang học, Quay Siêu chậm (Super Slow Motion), Làm đẹp, Hiệu ứng Bokeh, Bộ lọc màu', 'Android 12', 'Snapdragon 8+ Gen 1 8 nhân', '1 nhân 3.18 GHz, 3 nhân 2.7 GHz & 4 nhân 2 GHz', 'Adreno 670', '8 GB', '512 GB', 'Hỗ trợ 5G', '1 Nano SIM & 1 eSIM', 'Dual-band (2.4 GHz/5 GHz), Wi-Fi MIMO, Wi-Fi 802.11 a/b/g/n/ac/ax', 'Type-C', '3700 mAh', 'Li-Ion', '25 W', 'Mở khoá vân tay cạnh viền, Mở khoá khuôn mặt', 'Chế độ đơn giản (Giao diện đơn giản), Chặn cuộc gọi, Chặn tin nhắn, Chạm 2 lần tắt/sáng màn hình, Trợ lý ảo Google Assistant', 'IPX8', 'Nguyên khối', 'Khung nhôm & Mặt lưng kính cường lực', 'Dài 165.2 mm - Ngang 71.9 mm - Dày 6.9 mm - Nặng 187 g', 12, '2022-08-01'),
(22, 22, '6.28\"', 'AMOLED', 'Full HD+ (1080 x 2400 Pixels)', 'Kính cường lực Corning Gorilla Glass Victus', '120 Hz', 'Chính 50 MP & Phụ 13 MP, 5 MP', 'HD 720p@30fps, FullHD 1080p@30fps, HD 720p@60fps, 4K 2160p@30fps, 4K 2160p@60fps, 8K 4320p@24fps', '32 MP', 'Trôi nhanh thời gian (Time Lapse), Góc siêu rộng (Ultrawide), Zoom kỹ thuật số, Góc rộng (Wide), FlexCam, Quay chậm (Slow Motion), Xóa phông, Toàn cảnh (Panorama), Chống rung quang học (OIS), Ban đêm (Night Mode), Chuyên nghiệp (Pro), HDR, Zoom quang học, Quay Siêu chậm (Super Slow Motion), Làm đẹp, Hiệu ứng Bokeh, Bộ lọc màu', 'Android 12', 'Snapdragon 8+ Gen 1 8 nhân', '1 nhân 3 GHz, 3 nhân 2.5 GHz & 4 nhân 1.79 GHz', 'Adreno 730', '8 GB', '256 GB', 'Hỗ trợ 5G', '2 Nano SIM', 'Dual-band (2.4 GHz/5 GHz), Wi-Fi MIMO, Wi-Fi 802.11 a/b/g/n/ac/ax', 'Type-C', '4500 mAh', 'Li-Ion', '67 W', 'Mở khoá vân tay cạnh viền, Mở khoá khuôn mặt', 'Công nghệ tản nhiệt LiquidCool, Màn hình luôn hiển thị AOD, Âm thanh Dolby Atmos, Chạm 2 lần tắt/sáng màn hình, Đa cửa sổ (chia đôi màn hình), Âm thanh bởi Harman Kardon, Loa kép', 'Không có', 'Nguyên khối', 'Khung kim loại & Mặt lưng kính', 'Dài 152.7 mm - Ngang 69.9 mm - Dày 8.2 mm - Nặng 180 g', 12, '2022-03-01'),
(23, 23, '6.43\"', 'AMOLED', 'Full HD+ (1080 x 2400 Pixels)', 'Kính cường lực Corning Gorilla Glass 3', '90 Hz', 'Chính 108 MP & Phụ 8 MP, 2 MP', 'HD 720p@30fpsFullHD 1080p@30fps', '16 MP', 'Trôi nhanh thời gian (Time Lapse), Góc siêu rộng (Ultrawide), Zoom kỹ thuật số, Góc rộng (Wide), FlexCam, Quay chậm (Slow Motion), Xóa phông, Toàn cảnh (Panorama), Chống rung quang học (OIS), Ban đêm (Night Mode), Quay Siêu chậm (Super Slow Motion), Làm đẹp, Hiệu ứng Bokeh, Bộ lọc màu', 'Android 13', 'MediaTek Helio G96 8 nhân', '2 nhân 2.05 GHz & 6 nhân 2.0 GHz', 'Mali-G57 MC2', '8 GB', '256 GB', 'Hỗ trợ 4G', '2 Nano SIM', 'Dual-band (2.4 GHz/5 GHz), Wi-Fi MIMO, Wi-Fi 802.11 a/b/g/n/ac/ax', 'Type-C', '5000 mAh', 'Li-Po', '33 W', 'Mở khoá vân tay cạnh viền, Mở khoá khuôn mặt', 'Công nghệ tản nhiệt LiquidCool, Màn hình luôn hiển thị AOD, Âm thanh Dolby Atmos, Chạm 2 lần tắt/sáng màn hình, Đa cửa sổ (chia đôi màn hình), Âm thanh bởi Harman Kardon, Loa kép', 'Không có', 'Nguyên khối', 'Khung nhựa & Mặt lưng kính', 'Dài 159.87 mm - Ngang 73.87 mm - Dày 8.09 mm - Nặng 176 g', 12, '2023-05-01'),
(24, 24, '6.67\"', 'AMOLED', 'Full HD+ (1080 x 2400 Pixels)', 'Kính cường lực Corning Gorilla Glass 5', '120 Hz', 'Chính 108 MP & Phụ 8 MP, 2 MP, 2 MP', 'HD 720p@30fpsFullHD 1080p@30fps, 4K 2160p@30fps', '16 MP', 'Trôi nhanh thời gian (Time Lapse), Góc siêu rộng (Ultrawide), Zoom kỹ thuật số, Góc rộng (Wide), FlexCam, Quay chậm (Slow Motion), Xóa phông, Toàn cảnh (Panorama), Chống rung quang học (OIS), Ban đêm (Night Mode), Quay Siêu chậm (Super Slow Motion), Làm đẹp, Hiệu ứng Bokeh, Bộ lọc màu', 'Android 11', 'Snapdragon 732G 8 nhân', '2.3 GHz', 'Adreno 618', '8 GB', '128 GB', 'Hỗ trợ 4G', '2 Nano SIM (SIM 2 chung khe thẻ nhớ)', 'Dual-band (2.4 GHz/5 GHz), Wi-Fi MIMO, Wi-Fi 802.11 a/b/g/n/ac/ax', 'Type-C', '5000 mAh', 'Li-Po', '67 W', 'Mở khoá vân tay cạnh viền, Mở khoá khuôn mặt', 'Công nghệ tản nhiệt LiquidCool, Màn hình luôn hiển thị AOD, Âm thanh Dolby Atmos, Chạm 2 lần tắt/sáng màn hình, Đa cửa sổ (chia đôi màn hình), Âm thanh bởi Harman Kardon, Loa kép', 'IP53', 'Nguyên khối', 'Khung nhựa & Mặt lưng kính', 'Dài 164.2 mm - Ngang 76.1 mm - Dày 8.12 mm - Nặng 201.8 g', 12, '2023-05-01');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dondathang`
--

CREATE TABLE `dondathang` (
  `MaDDH` int(11) NOT NULL,
  `MaTV` int(11) NOT NULL,
  `NgayDatHang` datetime NOT NULL,
  `NgayGiao` datetime DEFAULT NULL,
  `DaThanhToan` tinyint(4) NOT NULL,
  `QuaTang` text DEFAULT NULL,
  `TinhTrang` text DEFAULT NULL,
  `DaXoa` tinyint(4) DEFAULT 0,
  `thanhTien` double DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `dondathang`
--

INSERT INTO `dondathang` (`MaDDH`, `MaTV`, `NgayDatHang`, `NgayGiao`, `DaThanhToan`, `QuaTang`, `TinhTrang`, `DaXoa`, `thanhTien`) VALUES
(1, 2, '2024-04-20 15:11:52', '2024-04-29 00:00:00', 1, NULL, 'Đã duyệt', 0, 44580000),
(2, 2, '2024-03-21 07:51:13', '2024-04-30 00:00:00', 1, NULL, 'Đã duyệt', 0, 135999998),
(3, 2, '2024-04-21 07:51:13', '2024-04-25 12:51:13', 1, NULL, 'Đã giao', 0, 86000000),
(5, 2, '2024-04-28 16:22:19', NULL, 1, NULL, 'Chưa duyệt', 0, 172000000),
(7, 2, '2024-04-28 16:35:38', '2024-04-30 00:00:00', 1, NULL, 'Đã duyệt', 0, 222900000),
(8, 4, '2024-04-29 15:14:57', '2024-04-30 00:00:00', 1, NULL, 'Đã duyệt', 0, 267480000),
(9, 5, '2024-04-29 17:17:17', '2024-04-30 00:00:00', 1, NULL, 'Đã duyệt', 0, 135999998),
(10, 6, '2024-04-29 17:22:18', '2024-04-30 00:00:00', 1, NULL, 'Đã duyệt', 0, 44580000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giohang`
--

CREATE TABLE `giohang` (
  `MaGioHang` int(11) NOT NULL,
  `MaTV` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khuyenmai`
--

CREATE TABLE `khuyenmai` (
  `MaKhuyenMai` int(11) NOT NULL,
  `TenKhuyenMai` text NOT NULL,
  `MoTa` text DEFAULT NULL,
  `PhanTramGiamGia` int(11) NOT NULL,
  `NgayBatDau` date NOT NULL,
  `NgayKetThuc` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khuyenmai`
--

INSERT INTO `khuyenmai` (`MaKhuyenMai`, `TenKhuyenMai`, `MoTa`, `PhanTramGiamGia`, `NgayBatDau`, `NgayKetThuc`) VALUES
(1, 'Mừng Giải Phóng Miền Nam 30/04', 'Giảm giá sâu cho các dòng iPhone', 20, '2024-04-25', '2024-05-02'),
(2, 'Giảm giá Đại lễ Giỗ Tổ', 'Giảm sâu các dòng ViVo', 30, '2024-03-30', '2024-04-06'),
(3, 'Khuyễn mãi đợt 1 cho iPhone', 'Khuyến mãi 5% cho Iphone', 5, '2024-02-06', '2024-02-12'),
(4, 'Khuyến mãi đợt 2 cho Samsung', 'Khuyến mãi 10% cho Samsung', 10, '2024-04-01', '2024-04-06'),
(5, 'Khuyến mãi đợt 3 cho Samsung', 'Khuyến mãi 20% cho Samsung', 20, '2024-04-17', '2024-04-27'),
(6, 'Khuyễn mãi đợt 1 cho Xiaomi', 'Khuyến mãi 5% cho Xiaomi', 5, '2024-04-18', '2024-04-28'),
(7, '', '', 0, '1970-01-01', '1970-01-01'),
(8, 'Khuyễn mãi đợt 2 cho Xiaomi', 'Khuyến mãi 55% cho Xiaomi', 55, '2024-05-17', '2024-05-28');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaisanpham`
--

CREATE TABLE `loaisanpham` (
  `MaLoaiSP` int(11) NOT NULL,
  `MaDanhMuc` int(11) NOT NULL,
  `TenLoaiSP` text NOT NULL,
  `Icon` text DEFAULT NULL,
  `BiDanh` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `loaisanpham`
--

INSERT INTO `loaisanpham` (`MaLoaiSP`, `MaDanhMuc`, `TenLoaiSP`, `Icon`, `BiDanh`) VALUES
(1, 1, 'Iphone', 'logo-iphone-220x48.png', NULL),
(2, 1, 'Oppo', 'OPPO42-b_5.jpg', NULL),
(3, 1, 'Vivo', 'vivo-logo-220-220x48-3.png', NULL),
(4, 1, 'Samsung', 'samsungnew-220x48-1.png', NULL),
(5, 1, 'Xiaomi', 'logo-xiaomi-220x48-5.png', NULL),
(6, 2, 'Sạc dự phòng', NULL, NULL),
(7, 2, 'Tai nghe', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaithanhvien`
--

CREATE TABLE `loaithanhvien` (
  `MaLoaiTV` int(11) NOT NULL,
  `TenLoai` text NOT NULL,
  `UuDai` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `loaithanhvien`
--

INSERT INTO `loaithanhvien` (`MaLoaiTV`, `TenLoai`, `UuDai`) VALUES
(1, 'Admin', NULL),
(2, 'Khách hàng ', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `mau`
--

CREATE TABLE `mau` (
  `MaMau` int(11) NOT NULL,
  `TenMau` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `mau`
--

INSERT INTO `mau` (`MaMau`, `TenMau`) VALUES
(1, 'Vàng'),
(2, 'Bạc'),
(3, 'Đen'),
(4, 'Trắng'),
(5, 'Tím'),
(6, 'Đỏ'),
(7, 'Xanh'),
(8, 'Xám'),
(9, 'Hồng'),
(10, 'Cam');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhacungcap`
--

CREATE TABLE `nhacungcap` (
  `MaNCC` int(11) NOT NULL,
  `TenNCC` text NOT NULL,
  `DiaChi` text NOT NULL,
  `Email` text NOT NULL,
  `SoDienThoai` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhacungcap`
--

INSERT INTO `nhacungcap` (`MaNCC`, `TenNCC`, `DiaChi`, `Email`, `SoDienThoai`) VALUES
(1, 'Nhà cung cấp A', 'Địa chỉ A', 'nccA@example.com', '0123456789'),
(2, 'Nhà cung cấp B', 'Địa chỉ B', 'nccB@example.com', '0987654321'),
(3, 'Nhà cung cấp C', 'Địa chỉ C', 'nccC@example.com', '0369852147'),
(4, 'Nhà cung cấp D', 'Địa chỉ A', 'nccA@example.com', '0123456789'),
(5, 'Nhà cung cấp E', 'Địa chỉ B', 'nccB@example.com', '0987654321'),
(6, 'Nhà cung cấp F', 'Địa chỉ C', 'nccC@example.com', '0369852147');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phieunhap`
--

CREATE TABLE `phieunhap` (
  `MaPN` int(11) NOT NULL,
  `MaNCC` int(11) NOT NULL,
  `NgayNhap` datetime NOT NULL,
  `DaXoa` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `phieunhap`
--

INSERT INTO `phieunhap` (`MaPN`, `MaNCC`, `NgayNhap`, `DaXoa`) VALUES
(1, 1, '2024-04-26 15:53:07', 0),
(2, 2, '2024-04-26 15:53:07', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `MaSP` int(11) NOT NULL,
  `MaNCC` int(11) NOT NULL,
  `MaLoaiSP` int(11) NOT NULL,
  `MaKhuyenMai` int(11) DEFAULT NULL,
  `TenSP` text NOT NULL,
  `DonGia` decimal(18,0) DEFAULT NULL,
  `NgayCapNhat` datetime DEFAULT NULL,
  `MoTa` text DEFAULT NULL,
  `HinhAnh` text DEFAULT NULL,
  `HinhAnh2` text DEFAULT NULL,
  `HinhAnh3` text DEFAULT NULL,
  `LuotXem` int(11) DEFAULT NULL,
  `LuotBinhChon` int(11) DEFAULT NULL,
  `LuotBinhLuan` int(11) DEFAULT NULL,
  `SoLanMua` int(11) DEFAULT NULL,
  `Moi` tinyint(4) NOT NULL,
  `DaXoa` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`MaSP`, `MaNCC`, `MaLoaiSP`, `MaKhuyenMai`, `TenSP`, `DonGia`, `NgayCapNhat`, `MoTa`, `HinhAnh`, `HinhAnh2`, `HinhAnh3`, `LuotXem`, `LuotBinhChon`, `LuotBinhLuan`, `SoLanMua`, `Moi`, `DaXoa`) VALUES
(1, 1, 1, NULL, 'Điện thoại iPhone 14 Pro Max 128GB', 44580000, '2023-08-01 00:00:00', 'iPhone 14 Pro Max một siêu phẩm trong giới smartphone được nhà Táo tung ra thị trường vào tháng 09/2022. Máy trang bị con chip Apple A16 Bionic vô cùng mạnh mẽ, đi kèm theo đó là thiết kế hình màn hình mới, hứa hẹn mang lại những trải nghiệm đầy mới mẻ cho người dùng iPhone.', 'iphone-14-pro-max-purple-1.jpg', 'iphone-14-pro-max-vang-1.jpg', 'iphone-14-pro-max-note.jpg', NULL, NULL, NULL, 0, 1, 0),
(2, 1, 1, NULL, 'Điện thoại iPhone 14 Pro Max 256GB', 67999999, '2023-08-01 00:00:00', 'iPhone 14 Pro Max một siêu phẩm trong giới smartphone được nhà Táo tung ra thị trường vào tháng 09/2022. Máy trang bị con chip Apple A16 Bionic vô cùng mạnh mẽ, đi kèm theo đó là thiết kế hình màn hình mới, hứa hẹn mang lại những trải nghiệm đầy mới mẻ cho người dùng iPhone.', 'iphone-14-pro-max-purple-1.jpg', 'iphone-14-pro-max-vang-1.jpg', 'iphone-14-pro-max-note.jpg', NULL, NULL, NULL, 0, 1, 0),
(3, 1, 1, NULL, 'Điện thoại iPhone 14 Pro Max 512GB', 86000000, '2023-08-01 00:00:00', 'iPhone 14 Pro Max một siêu phẩm trong giới smartphone được nhà Táo tung ra thị trường vào tháng 09/2022. Máy trang bị con chip Apple A16 Bionic vô cùng mạnh mẽ, đi kèm theo đó là thiết kế hình màn hình mới, hứa hẹn mang lại những trải nghiệm đầy mới mẻ cho người dùng iPhone.', 'iphone-14-pro-max-purple-1.jpg', 'iphone-14-pro-max-vang-1.jpg', 'iphone-14-pro-max-note.jpg', NULL, NULL, NULL, 0, 1, 0),
(4, 1, 1, NULL, 'Điện thoại iPhone 14 Pro Max 1TB', NULL, '2023-08-01 00:00:00', 'iPhone 14 Pro Max một siêu phẩm trong giới smartphone được nhà Táo tung ra thị trường vào tháng 09/2022. Máy trang bị con chip Apple A16 Bionic vô cùng mạnh mẽ, đi kèm theo đó là thiết kế hình màn hình mới, hứa hẹn mang lại những trải nghiệm đầy mới mẻ cho người dùng iPhone.', 'iphone-14-pro-max-purple-1.jpg', 'iphone-14-pro-max-vang-1.jpg', 'iphone-14-pro-max-note.jpg', NULL, NULL, NULL, 0, 1, 0),
(5, 1, 1, NULL, 'Điện thoại iPhone 13 Pro Max 123GB', NULL, '2023-08-01 00:00:00', 'Điện thoại iPhone 13 Pro Max 128 GB - siêu phẩm được mong chờ nhất ở nửa cuối năm 2021 đến từ Apple. Máy có thiết kế không mấy đột phá khi so với người tiền nhiệm, bên trong đây vẫn là một sản phẩm có màn hình siêu đẹp, tần số quét được nâng cấp lên 120 Hz mượt mà, cảm biến camera có kích thước lớn hơn, cùng hiệu năng mạnh mẽ với sức mạnh đến từ Apple A15 Bionic, sẵn sàng cùng bạn chinh phục mọi thử thách.', 'iphone-13-pro-max-1-1.jpg', 'iphone-13-pro-max-1.jpg', 'iphone-13-pro-max-n-2.jpg', NULL, NULL, NULL, 0, 1, 0),
(6, 1, 1, NULL, 'Điện thoại iPhone 13 Pro Max 256GB', NULL, '2023-08-01 00:00:00', 'Điện thoại iPhone 13 Pro Max 256 GB - siêu phẩm được mong chờ nhất ở nửa cuối năm 2021 đến từ Apple. Máy có thiết kế không mấy đột phá khi so với người tiền nhiệm, bên trong đây vẫn là một sản phẩm có màn hình siêu đẹp, tần số quét được nâng cấp lên 120 Hz mượt mà, cảm biến camera có kích thước lớn hơn, cùng hiệu năng mạnh mẽ với sức mạnh đến từ Apple A15 Bionic, sẵn sàng cùng bạn chinh phục mọi thử thách.', 'iphone-13-pro-max-1-1.jpg', 'iphone-13-pro-max-1.jpg', 'iphone-13-pro-max-n-2.jpg', NULL, NULL, NULL, 0, 1, 0),
(7, 1, 1, NULL, 'Điện thoại iPhone 13 Pro Max 512GB', NULL, '2023-08-01 00:00:00', 'Điện thoại iPhone 13 Pro Max 512 GB - siêu phẩm được mong chờ nhất ở nửa cuối năm 2021 đến từ Apple. Máy có thiết kế không mấy đột phá khi so với người tiền nhiệm, bên trong đây vẫn là một sản phẩm có màn hình siêu đẹp, tần số quét được nâng cấp lên 120 Hz mượt mà, cảm biến camera có kích thước lớn hơn, cùng hiệu năng mạnh mẽ với sức mạnh đến từ Apple A15 Bionic, sẵn sàng cùng bạn chinh phục mọi thử thách.', 'iphone-13-pro-max-1-1.jpg', 'iphone-13-pro-max-1.jpg', 'iphone-13-pro-max-n-2.jpg', NULL, NULL, NULL, 0, 1, 0),
(8, 1, 1, NULL, 'Điện thoại iPhone 12 Pro Max 128GB', NULL, '2023-08-01 00:00:00', 'iPhone 12 Pro Max 128 GB một siêu phẩm smartphone đến từ Apple. Máy có một hiệu năng hoàn toàn mạnh mẽ đáp ứng tốt nhiều nhu cầu đến từ người dùng và mang trong mình một thiết kế đầy vuông vức, sang trọng.', 'iphone-12-pro-max-512gb-1-org.jpg', 'iphone-12-pro-max-512gb-bac-1-org.jpg', 'iphone-12-pro-max-512gb-note-2.jpg', NULL, NULL, NULL, 0, 0, 0),
(9, 1, 1, NULL, 'Điện thoại iPhone 12 Pro Max 256GB', NULL, '2023-08-01 00:00:00', 'iPhone 12 Pro Max 256 GB một siêu phẩm smartphone đến từ Apple. Máy có một hiệu năng hoàn toàn mạnh mẽ đáp ứng tốt nhiều nhu cầu đến từ người dùng và mang trong mình một thiết kế đầy vuông vức, sang trọng.', 'iphone-12-pro-max-512gb-1-org.jpg', 'iphone-12-pro-max-512gb-bac-1-org.jpg', 'iphone-12-pro-max-512gb-note-2.jpg', NULL, NULL, NULL, 0, 0, 0),
(10, 2, 2, NULL, 'Điện thoại OPPO Find N2 Flip 5G', NULL, '2023-08-01 00:00:00', 'OPPO Find N2 Flip 5G - chiếc điện thoại gập đầu tiên của OPPO đã được giới thiệu chính thức tại Việt Nam vào tháng 03/2023. Sở hữu cấu hình mạnh mẽ cùng thiết kế siêu nhỏ gọn giúp tối ưu kích thước, chiếc điện thoại sẽ cùng bạn nổi bật trong mọi không gian với vẻ ngoài đầy cá tính.', 'oppo-n2-flip-tim-1-1.jpg', 'oppo-n2-flip-den-1.jpg', 'oppo-n2-flip-tim-note.jpg', NULL, NULL, NULL, 0, 1, 0),
(11, 2, 2, NULL, 'Điện thoại OPPO Reno10 Pro 5G', NULL, '2023-08-01 00:00:00', 'OPPO Reno10 Pro 5G là một trong những sản phẩm của OPPO được ra mắt trong 2023. Với thiết kế đẹp mắt, màn hình lớn và hiệu năng mạnh mẽ, Reno10 Pro chắc chắn sẽ là lựa chọn đáng cân nhắc dành cho những ai đang tìm kiếm chiếc máy tầm trung để phục vụ tốt mọi nhu cầu.', 'oppo-reno10-pro-xam-1-1.jpg', 'oppo-reno10-pro-tim-1-2.jpg', 'oppo-reno10-pro-note.jpg', NULL, NULL, NULL, 0, 1, 0),
(12, 2, 2, NULL, 'Điện thoại OPPO A77s', NULL, '2023-08-01 00:00:00', 'OPPO vừa cho ra mắt mẫu điện thoại tầm trung mới với tên gọi OPPO A77s, máy sở hữu màn hình lớn, thiết kế đẹp mắt, hiệu năng ổn định cùng khả năng mở rộng RAM lên đến 8 GB vô cùng nổi bật trong phân khúc.', 'oppo-a77s-den-1.jpg', 'oppo-a77s-xanh-1.jpg', 'oppo-a77s-note-2.jpg', NULL, NULL, NULL, 0, 1, 0),
(13, 3, 3, NULL, 'Điện thoại vivo V25 Pro 5G', NULL, '2023-08-01 00:00:00', 'VIVO V25 Pro 5G vừa được ra mắt với một mức giá bán cực kỳ hấp dẫn, thế mạnh của máy thuộc về phần hiệu năng nhờ trang bị con chip MediaTek Dimensity 1300 và cụm camera sắc nét 64 MP, hứa hẹn mang lại cho người dùng những trải nghiệm ổn định trong suốt quá trình sử dụng.', 'vivo-v25-pro-5g-sld-xanh-1.jpg', 'vivo-v25-pro-5g-den-1.jpg', 'vivo-v25-pro-5g-note-2.jpg', NULL, NULL, NULL, 0, 1, 0),
(14, 3, 3, NULL, 'Điện thoại vivo Y02A', NULL, '2023-08-01 00:00:00', 'VIVO Y02A mẫu điện thoại được nhà vivo cho ra mắt hướng đến nhóm người dùng yêu thích sự đơn giản trong thiết kế, hiệu năng tốt có thể xử lý các tác vụ thường ngày và một viên pin lớn đáp ứng được nhu cầu sử dụng lâu dài.', 'vivo-y02-den-1.jpg', 'vivo-y02-tim-1.jpg', 'vivo-y02-note.jpg', NULL, NULL, NULL, 0, 1, 0),
(15, 3, 3, NULL, 'Điện thoại vivo V27e', NULL, '2023-08-01 00:00:00', 'vivo V27e một trong những chiếc điện thoại tầm trung nổi bật của vivo trong năm 2023. Với thiết kế độc đáo và khả năng chụp ảnh - quay phim ấn tượng, vì thế máy đã mang lại cho vivo nhiều niềm tự hào khi ra mắt tại thị trường Việt Nam, hứa hẹn mang đến trải nghiệm tuyệt vời đến với người dùng.', 'vivo-v27e-tim-1-1.jpg', 'vivo-v27e-den-1.jpg', 'vivo-v27e-note.jpg', NULL, NULL, NULL, 0, 1, 0),
(16, 4, 4, NULL, 'Điện thoại Samsung Galaxy Z Fold5 5G 256GB ', NULL, '2023-08-01 00:00:00', 'Samsung Galaxy Z Fold5 là mẫu điện thoại cao cấp được ra mắt vào tháng 07/2023 với nhiều điểm đáng chú ý như thiết kế gập độc đáo, hiệu năng mạnh mẽ cùng camera quay chụp tốt, điều này giúp cho máy thu hút được nhiều sự quan tâm của đông đảo người dùng yêu công nghệ hiện nay.', 'samsung-galaxy-zfold5-xanh-256gb-1-1.jpg', 'samsung-galaxy-zfold5-den-256gb-1.jpg', 'samsung-galaxy-zfold5-note.jpg', NULL, NULL, NULL, 0, 1, 0),
(17, 4, 4, NULL, 'Điện thoại Samsung Galaxy Z Fold5 5G 512GB ', NULL, '2023-08-01 00:00:00', 'Samsung Galaxy Z Fold5 là mẫu điện thoại cao cấp được ra mắt vào tháng 07/2023 với nhiều điểm đáng chú ý như thiết kế gập độc đáo, hiệu năng mạnh mẽ cùng camera quay chụp tốt, điều này giúp cho máy thu hút được nhiều sự quan tâm của đông đảo người dùng yêu công nghệ hiện nay.', 'samsung-galaxy-zfold5-xanh-256gb-1-1.jpg', 'samsung-galaxy-zfold5-den-256gb-1.jpg', 'samsung-galaxy-zfold5-note.jpg', NULL, NULL, NULL, 0, 1, 0),
(18, 4, 4, NULL, 'Điện thoại Samsung Galaxy Z Fold5 5G 1TB', NULL, '2023-08-01 00:00:00', 'Samsung Galaxy Z Fold5 là mẫu điện thoại cao cấp được ra mắt vào tháng 07/2023 với nhiều điểm đáng chú ý như thiết kế gập độc đáo, hiệu năng mạnh mẽ cùng camera quay chụp tốt, điều này giúp cho máy thu hút được nhiều sự quan tâm của đông đảo người dùng yêu công nghệ hiện nay.', 'samsung-galaxy-zfold5-xanh-256gb-1-1.jpg', 'samsung-galaxy-zfold5-den-256gb-1.jpg', 'samsung-galaxy-zfold5-note.jpg', NULL, NULL, NULL, 0, 1, 0),
(19, 4, 4, NULL, 'Điện thoại Samsung Galaxy Z Flip4 5G 128GB', NULL, '2023-08-01 00:00:00', 'Samsung Galaxy Z Flip4 128GB đã chính thức ra mắt thị trường công nghệ, đánh dấu sự trở lại của Samsung trên con đường định hướng người dùng về sự tiện lợi trên những chiếc điện thoại gập. Với độ bền được gia tăng cùng kiểu thiết kế đẹp mắt giúp Flip4 trở thành một trong những tâm điểm sáng giá cho nửa cuối năm 2022.', 'samsung-galaxy-flip4-glr-tim-1.jpg', 'samsung-galaxy-flip-den-1.jpg', 'samsung-galaxy-z-flip4-note-1-1.jpg', NULL, NULL, NULL, 0, 1, 0),
(20, 4, 4, NULL, 'Điện thoại Samsung Galaxy Z Flip4 5G 256GB', NULL, '2023-08-01 00:00:00', 'Samsung Galaxy Z Flip4 256GB đã chính thức ra mắt thị trường công nghệ, đánh dấu sự trở lại của Samsung trên con đường định hướng người dùng về sự tiện lợi trên những chiếc điện thoại gập. Với độ bền được gia tăng cùng kiểu thiết kế đẹp mắt giúp Flip4 trở thành một trong những tâm điểm sáng giá cho nửa cuối năm 2022.', 'samsung-galaxy-flip4-glr-tim-1.jpg', 'samsung-galaxy-flip-den-1.jpg', 'samsung-galaxy-z-flip4-note-1-1.jpg', NULL, NULL, NULL, 0, 1, 0),
(21, 4, 4, NULL, 'Điện thoại Samsung Galaxy Z Flip4 5G 512GB', NULL, '2023-08-01 00:00:00', 'Samsung Galaxy Z Flip4 512GB đã chính thức ra mắt thị trường công nghệ, đánh dấu sự trở lại của Samsung trên con đường định hướng người dùng về sự tiện lợi trên những chiếc điện thoại gập. Với độ bền được gia tăng cùng kiểu thiết kế đẹp mắt giúp Flip4 trở thành một trong những tâm điểm sáng giá cho nửa cuối năm 2022.', 'samsung-galaxy-flip4-glr-tim-1.jpg', 'samsung-galaxy-flip-den-1.jpg', 'samsung-galaxy-z-flip4-note-1-1.jpg', NULL, NULL, NULL, 0, 1, 0),
(22, 5, 5, NULL, 'Điện thoại Xiaomi 12 5G', NULL, '2023-08-01 00:00:00', 'Điện thoại Xiaomi đang dần khẳng định chỗ đứng của mình trong phân khúc flagship bằng việc ra mắt Xiaomi 12 với bộ thông số ấn tượng, máy có một thiết kế gọn gàng, hiệu năng mạnh mẽ, màn hình hiển thị chi tiết cùng khả năng chụp ảnh sắc nét nhờ trang bị ống kính đến từ Sony.', 'xiaomi-mi-12-1-1.jpg', 'xiaomi-mi-12-1.jpg', 'xiaomi-mi-12-note.jpg', NULL, NULL, NULL, 0, 1, 0),
(23, 5, 5, NULL, 'Điện thoại Xiaomi Redmi Note 12S', NULL, '2023-08-01 00:00:00', 'Xiaomi Redmi Note 12S sẽ là chiếc điện thoại tiếp theo được nhà Xiaomi tung ra thị trường Việt Nam trong thời gian tới (05/2023). Điện thoại sở hữu một lối thiết kế hiện đại, màn hình hiển thị chi tiết đi cùng với đó là một hiệu năng mượt mà xử lý tốt các tác vụ.', 'xiaomi-redmi-note-12s-1-1.jpg', 'xiaomi-redmi-note-12s-xanh-1.jpg', 'xiaomi-redmi-note-12s-note.jpg', NULL, NULL, NULL, 0, 1, 0),
(24, 5, 5, NULL, 'Điện thoại Xiaomi Redmi Note 12 Pro 128GB', NULL, '2023-08-01 00:00:00', 'Xiaomi Redmi Note 12 Pro 4G tiếp tục sẽ là mẫu điện thoại tầm trung được nhà Xiaomi giới thiệu đến thị trường Việt Nam trong năm 2023, máy nổi bật với camera 108 MP chất lượng, thiết kế viền mỏng cùng hiệu năng đột phá nhờ trang bị chip Snapdragon 732G.', 'xiami-redmi-12-pro-xam-1.jpg', 'xiaomi-redmi-12-pro-4g-xanh-duong-1.jpg', 'xiaomi-redmi-12-note-2.jpg', NULL, NULL, NULL, 0, 1, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham_mau`
--

CREATE TABLE `sanpham_mau` (
  `MaSP_Mau` int(11) NOT NULL,
  `MaSP` int(11) NOT NULL,
  `SoLuongTon` int(11) NOT NULL,
  `MaMau` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sanpham_mau`
--

INSERT INTO `sanpham_mau` (`MaSP_Mau`, `MaSP`, `SoLuongTon`, `MaMau`) VALUES
(1, 1, 10, 5),
(2, 1, 10, 1),
(3, 2, 10, 5),
(4, 2, 10, 1),
(5, 3, 10, 5),
(6, 3, 10, 1),
(7, 4, 10, 5),
(8, 4, 10, 1),
(9, 5, 10, 1),
(10, 5, 10, 4),
(11, 6, 10, 1),
(12, 6, 10, 4),
(13, 7, 10, 1),
(14, 7, 10, 4),
(15, 8, 10, 1),
(16, 8, 10, 2),
(17, 9, 10, 1),
(18, 9, 10, 2),
(19, 10, 10, 5),
(20, 10, 10, 3),
(21, 11, 10, 8),
(22, 11, 10, 5),
(23, 12, 10, 3),
(24, 12, 10, 7),
(25, 13, 10, 7),
(26, 13, 10, 3),
(27, 14, 10, 3),
(28, 14, 10, 5),
(29, 15, 10, 5),
(30, 15, 10, 3),
(31, 16, 10, 7),
(32, 16, 10, 3),
(33, 17, 10, 7),
(34, 17, 10, 3),
(35, 18, 10, 7),
(36, 18, 10, 3),
(37, 19, 10, 5),
(38, 19, 10, 3),
(39, 20, 10, 5),
(40, 20, 10, 3),
(41, 21, 10, 5),
(42, 21, 10, 3),
(43, 22, 10, 8),
(44, 22, 10, 5),
(45, 23, 10, 3),
(46, 23, 10, 7),
(47, 24, 10, 8),
(48, 24, 10, 7);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thanhvien`
--

CREATE TABLE `thanhvien` (
  `MaTV` int(11) NOT NULL,
  `MaLoaiTV` int(11) DEFAULT NULL,
  `TaiKhoan` text NOT NULL,
  `MatKhau` text NOT NULL,
  `HoTen` text NOT NULL,
  `DiaChi` text DEFAULT NULL,
  `Email` text DEFAULT NULL,
  `SoDienThoai` varchar(12) DEFAULT NULL,
  `CauHoi` text DEFAULT NULL,
  `CauTraLoi` text DEFAULT NULL,
  `HinhDaiDien` text DEFAULT 'default.png',
  `MaToken` text DEFAULT NULL,
  `ThoiGianMaToken` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `thanhvien`
--

INSERT INTO `thanhvien` (`MaTV`, `MaLoaiTV`, `TaiKhoan`, `MatKhau`, `HoTen`, `DiaChi`, `Email`, `SoDienThoai`, `CauHoi`, `CauTraLoi`, `HinhDaiDien`, `MaToken`, `ThoiGianMaToken`) VALUES
(1, 1, 'admin', '1', 'Nguyễn Văn A', 'Địa chỉ A', 'email1@example.com', '0123456789', NULL, NULL, 'avatar1.png', NULL, NULL),
(2, 2, 'taopro', '1', 'Trần Thị B', 'Địa chỉ B', 'email2@example.com', '0987654321', NULL, NULL, 'avatar2.png', NULL, NULL),
(3, 1, 'thaoadmin', '1', 'Thao Nguyen', '123 abc', 'thaonguyen28062003@gmail.com', NULL, 'Quê bạn ở đâu?', 'Vinh', 'default.png', NULL, NULL),
(4, 2, 'thaoto123', 'ghNShK', 'Linh An', '123 abc', 'ln5966220@gmail.com', '123456789', NULL, NULL, 'default.png', NULL, NULL),
(5, 2, 'CayNguiPhan', '1', 'Lê Trí Cường', '1234 avb', 'letricuong08@gmail.com', '123456789', NULL, NULL, 'default.png', NULL, NULL),
(6, 2, 'daiuytoan', '1', 'Trương Toàn', '124 asf', 'toantruong567@gmail.com', '123456789', NULL, NULL, 'default.png', NULL, NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chitietdondathang`
--
ALTER TABLE `chitietdondathang`
  ADD PRIMARY KEY (`MaChiTietDDH`),
  ADD KEY `FK_CTDDH_DDH` (`MaDDH`),
  ADD KEY `FK_CTDDH_SP` (`MaSP`);

--
-- Chỉ mục cho bảng `chitietgiohang`
--
ALTER TABLE `chitietgiohang`
  ADD PRIMARY KEY (`MaChiTietGH`),
  ADD KEY `FK_CTGH_GH` (`MaGioHang`),
  ADD KEY `FK_CTGH_SP` (`MaSP`);

--
-- Chỉ mục cho bảng `chitietphieunhap`
--
ALTER TABLE `chitietphieunhap`
  ADD PRIMARY KEY (`MaCTPN`),
  ADD KEY `FK_CTPN_PN` (`MaPN`),
  ADD KEY `FK_CTPN_SP` (`MaSP`);

--
-- Chỉ mục cho bảng `chitietsanpham`
--
ALTER TABLE `chitietsanpham`
  ADD PRIMARY KEY (`MaChiTietSP`),
  ADD KEY `FK_CTSP_SANPHAM` (`MaSP`);

--
-- Chỉ mục cho bảng `dondathang`
--
ALTER TABLE `dondathang`
  ADD PRIMARY KEY (`MaDDH`),
  ADD KEY `FK_DDH_TV` (`MaTV`);

--
-- Chỉ mục cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD PRIMARY KEY (`MaGioHang`),
  ADD KEY `FK_GIOHANG_TV` (`MaTV`);

--
-- Chỉ mục cho bảng `khuyenmai`
--
ALTER TABLE `khuyenmai`
  ADD PRIMARY KEY (`MaKhuyenMai`);

--
-- Chỉ mục cho bảng `loaisanpham`
--
ALTER TABLE `loaisanpham`
  ADD PRIMARY KEY (`MaLoaiSP`);

--
-- Chỉ mục cho bảng `loaithanhvien`
--
ALTER TABLE `loaithanhvien`
  ADD PRIMARY KEY (`MaLoaiTV`);

--
-- Chỉ mục cho bảng `mau`
--
ALTER TABLE `mau`
  ADD PRIMARY KEY (`MaMau`);

--
-- Chỉ mục cho bảng `nhacungcap`
--
ALTER TABLE `nhacungcap`
  ADD PRIMARY KEY (`MaNCC`);

--
-- Chỉ mục cho bảng `phieunhap`
--
ALTER TABLE `phieunhap`
  ADD PRIMARY KEY (`MaPN`),
  ADD KEY `FK_PN_NCC` (`MaNCC`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`MaSP`),
  ADD KEY `FK_SP_LSP` (`MaLoaiSP`),
  ADD KEY `FK_SP_NCC` (`MaNCC`),
  ADD KEY `FK_SP_KM` (`MaKhuyenMai`);

--
-- Chỉ mục cho bảng `sanpham_mau`
--
ALTER TABLE `sanpham_mau`
  ADD PRIMARY KEY (`MaSP_Mau`),
  ADD KEY `FK_SPMAU_SP` (`MaSP`),
  ADD KEY `FK_SPMAU_MAU` (`MaMau`);

--
-- Chỉ mục cho bảng `thanhvien`
--
ALTER TABLE `thanhvien`
  ADD PRIMARY KEY (`MaTV`),
  ADD KEY `FK_TV_LTV` (`MaLoaiTV`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `chitietdondathang`
--
ALTER TABLE `chitietdondathang`
  MODIFY `MaChiTietDDH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `chitietgiohang`
--
ALTER TABLE `chitietgiohang`
  MODIFY `MaChiTietGH` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `chitietphieunhap`
--
ALTER TABLE `chitietphieunhap`
  MODIFY `MaCTPN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `chitietsanpham`
--
ALTER TABLE `chitietsanpham`
  MODIFY `MaChiTietSP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `dondathang`
--
ALTER TABLE `dondathang`
  MODIFY `MaDDH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `giohang`
--
ALTER TABLE `giohang`
  MODIFY `MaGioHang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `khuyenmai`
--
ALTER TABLE `khuyenmai`
  MODIFY `MaKhuyenMai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `loaisanpham`
--
ALTER TABLE `loaisanpham`
  MODIFY `MaLoaiSP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `loaithanhvien`
--
ALTER TABLE `loaithanhvien`
  MODIFY `MaLoaiTV` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `mau`
--
ALTER TABLE `mau`
  MODIFY `MaMau` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `nhacungcap`
--
ALTER TABLE `nhacungcap`
  MODIFY `MaNCC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `phieunhap`
--
ALTER TABLE `phieunhap`
  MODIFY `MaPN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `MaSP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `sanpham_mau`
--
ALTER TABLE `sanpham_mau`
  MODIFY `MaSP_Mau` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT cho bảng `thanhvien`
--
ALTER TABLE `thanhvien`
  MODIFY `MaTV` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chitietdondathang`
--
ALTER TABLE `chitietdondathang`
  ADD CONSTRAINT `FK_CTDDH_DDH` FOREIGN KEY (`MaDDH`) REFERENCES `dondathang` (`MaDDH`),
  ADD CONSTRAINT `FK_CTDDH_SP` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`MaSP`);

--
-- Các ràng buộc cho bảng `chitietgiohang`
--
ALTER TABLE `chitietgiohang`
  ADD CONSTRAINT `FK_CTGH_GH` FOREIGN KEY (`MaGioHang`) REFERENCES `giohang` (`MaGioHang`),
  ADD CONSTRAINT `FK_CTGH_SP` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`MaSP`);

--
-- Các ràng buộc cho bảng `chitietphieunhap`
--
ALTER TABLE `chitietphieunhap`
  ADD CONSTRAINT `FK_CTPN_PN` FOREIGN KEY (`MaPN`) REFERENCES `phieunhap` (`MaPN`),
  ADD CONSTRAINT `FK_CTPN_SP` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`MaSP`);

--
-- Các ràng buộc cho bảng `chitietsanpham`
--
ALTER TABLE `chitietsanpham`
  ADD CONSTRAINT `FK_CTSP_SANPHAM` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`MaSP`);

--
-- Các ràng buộc cho bảng `dondathang`
--
ALTER TABLE `dondathang`
  ADD CONSTRAINT `FK_DDH_TV` FOREIGN KEY (`MaTV`) REFERENCES `thanhvien` (`MaTV`);

--
-- Các ràng buộc cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD CONSTRAINT `FK_GIOHANG_TV` FOREIGN KEY (`MaTV`) REFERENCES `thanhvien` (`MaTV`);

--
-- Các ràng buộc cho bảng `phieunhap`
--
ALTER TABLE `phieunhap`
  ADD CONSTRAINT `FK_PN_NCC` FOREIGN KEY (`MaNCC`) REFERENCES `nhacungcap` (`MaNCC`);

--
-- Các ràng buộc cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `FK_SP_KM` FOREIGN KEY (`MaKhuyenMai`) REFERENCES `khuyenmai` (`MaKhuyenMai`),
  ADD CONSTRAINT `FK_SP_LSP` FOREIGN KEY (`MaLoaiSP`) REFERENCES `loaisanpham` (`MaLoaiSP`),
  ADD CONSTRAINT `FK_SP_NCC` FOREIGN KEY (`MaNCC`) REFERENCES `nhacungcap` (`MaNCC`);

--
-- Các ràng buộc cho bảng `sanpham_mau`
--
ALTER TABLE `sanpham_mau`
  ADD CONSTRAINT `FK_SPMAU_MAU` FOREIGN KEY (`MaMau`) REFERENCES `mau` (`MaMau`),
  ADD CONSTRAINT `FK_SPMAU_SP` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`MaSP`);

--
-- Các ràng buộc cho bảng `thanhvien`
--
ALTER TABLE `thanhvien`
  ADD CONSTRAINT `FK_TV_LTV` FOREIGN KEY (`MaLoaiTV`) REFERENCES `loaithanhvien` (`MaLoaiTV`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
