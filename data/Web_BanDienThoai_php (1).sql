CREATE TABLE NHACUNGCAP
(
   MaNCC INT AUTO_INCREMENT PRIMARY KEY,
   TenNCC TEXT NOT NULL,
   DiaChi TEXT NOT NULL,
   Email TEXT NOT NULL,
   SoDienThoai VARCHAR(12) NOT NULL
);

CREATE TABLE PHIEUNHAP
(
    MaPN INT AUTO_INCREMENT PRIMARY KEY,
    MaNCC INT NOT NULL,
    NgayNhap DATETIME NOT NULL,
    DaXoa TINYINT NOT NULL,
        
    CONSTRAINT FK_PN_NCC FOREIGN KEY (MaNCC) REFERENCES NHACUNGCAP(MaNCC)
);

CREATE TABLE LOAITHANHVIEN
(
    MaLoaiTV INT AUTO_INCREMENT PRIMARY KEY,
    TenLoai TEXT NOT NULL,
    UuDai INT NULL
);

CREATE TABLE THANHVIEN
(
    MaTV INT AUTO_INCREMENT PRIMARY KEY,
    MaLoaiTV INT NULL,
    TaiKhoan TEXT NOT NULL,
    MatKhau TEXT NOT NULL,
    HoTen TEXT NOT NULL,
    DiaChi TEXT NULL,
    Email TEXT NULL,
    SoDienThoai VARCHAR(12) NULL,
    CauHoi TEXT NULL,
    CauTraLoi TEXT NULL,
    HinhDaiDien TEXT DEFAULT 'default.png' NULL,
    MaToken TEXT NULL,
    ThoiGianMaToken DATETIME NULL,

    CONSTRAINT FK_TV_LTV FOREIGN KEY(MaLoaiTV) REFERENCES LOAITHANHVIEN(MaLoaiTV)
);

CREATE TABLE LOAISANPHAM
(
    MaLoaiSP INT AUTO_INCREMENT PRIMARY KEY,
    MaDanhMuc INT NOT NULL,
    TenLoaiSP TEXT NOT NULL,
    Icon TEXT NULL,
    BiDanh TEXT NULL
);

CREATE TABLE KHUYENMAI
(
    MaKhuyenMai INT AUTO_INCREMENT PRIMARY KEY,
    TenKhuyenMai TEXT NOT NULL,
    MoTa TEXT NULL,
    PhanTramGiamGia INT NOT NULL,
    NgayBatDau DATE NOT NULL,
    NgayKetThuc DATE NOT NULL
);

CREATE TABLE SANPHAM
(
    MaSP INT AUTO_INCREMENT PRIMARY KEY,
    MaNCC INT NOT NULL,
    MaLoaiSP INT NOT NULL,
	MaKhuyenMai  INT NULL,

    TenSP TEXT NOT NULL,
    DonGia DECIMAL(18,0) NULL,
    NgayCapNhat DATETIME NULL,
    MoTa TEXT NULL,
    HinhAnh TEXT NULL,
    HinhAnh2 TEXT NULL,
    HinhAnh3 TEXT NULL,
    LuotXem INT NULL,
    LuotBinhChon INT NULL,
    LuotBinhLuan INT NULL,
    SoLanMua INT NULL,
    Moi TINYINT NOT NULL,
    DaXoa TINYINT NOT NULL,

    CONSTRAINT FK_SP_LSP FOREIGN KEY(MaLoaiSP) REFERENCES LOAISANPHAM(MaLoaiSP),
    CONSTRAINT FK_SP_NCC FOREIGN KEY(MaNCC) REFERENCES NHACUNGCAP(MaNCC),
	CONSTRAINT FK_SP_KM FOREIGN KEY(MaKhuyenMai) REFERENCES KHUYENMAI(MaKhuyenMai)
);

CREATE TABLE CHITIETPHIEUNHAP
(
    MaCTPN INT AUTO_INCREMENT PRIMARY KEY,
    MaPN INT NOT NULL,
    MaSP INT NOT NULL,
    DonGiaNhap DECIMAL(18,0) NOT NULL,
    SoLuongNhap INT NOT NULL,

    CONSTRAINT FK_CTPN_PN FOREIGN KEY(MaPN) REFERENCES PHIEUNHAP(MaPN),
    CONSTRAINT FK_CTPN_SP FOREIGN KEY(MaSP) REFERENCES SANPHAM(MaSP)
);

CREATE TABLE DONDATHANG
(
    MaDDH INT AUTO_INCREMENT PRIMARY KEY,
    MaTV INT NOT NULL,
    NgayDatHang DATETIME NOT NULL,
    NgayGiao DATETIME NULL,
    DaThanhToan TINYINT NOT NULL,
    QuaTang TEXT NULL,
    TinhTrang TEXT NULL,
    DaXoa TINYINT DEFAULT 0 NULL,

    CONSTRAINT FK_DDH_TV FOREIGN KEY(MaTV) REFERENCES THANHVIEN(MaTV)
);

CREATE TABLE CHITIETDONDATHANG
(
    MaChiTietDDH INT AUTO_INCREMENT PRIMARY KEY,
    MaDDH INT NOT NULL,
    MaSP INT NOT NULL,
    TenSP TEXT NOT NULL,
    SoLuong INT NOT NULL,
    DonGia DECIMAL(18,0) NOT NULL,

    CONSTRAINT FK_CTDDH_DDH FOREIGN KEY(MaDDH) REFERENCES DONDATHANG(MaDDH),
    CONSTRAINT FK_CTDDH_SP FOREIGN KEY(MaSP) REFERENCES SANPHAM(MaSP)
);

CREATE TABLE CHITIETSANPHAM
(
    MaChiTietSP INT AUTO_INCREMENT PRIMARY KEY,
    MaSP INT NOT NULL,

    KICHTHUOCMANHINH TEXT NULL,
    CONGNGHEMANHINH TEXT NULL,
    DOPHANGIAI TEXT NULL,
    TINHNANGMANGHINH TEXT NULL,
    TANSOQUET TEXT NULL,
    CAMERASAU TEXT NULL, 
    QUAYPHIM TEXT NULL,
    CAMERATRUOC TEXT NULL,
    TINHNANGCAMERA TEXT NULL,
    HEDIEUHANH TEXT NULL,
    CHIP TEXT NULL,
    TOCDOCPU TEXT NULL,
    CHIPDOHOA TEXT NULL,
    RAM TEXT NULL,
    DUNGLUONG TEXT NULL,
    MANGDIDONG TEXT NULL,
    SIM TEXT NULL,
    WIFI TEXT NULL,
    CONGKETNOI TEXT NULL,
    DUNGLUONGPIN TEXT NULL,
    LOAIPIN TEXT NULL,
    HOTROSAC TEXT NULL,
    BAOMAT TEXT NULL,
    TINHNANGDACBIET TEXT NULL,
    KHANGNUOC TEXT NULL,
    THIETKE TEXT NULL,
    CHATLIEU TEXT NULL,
    KICHTHUOC TEXT NULL,
    BAOHANH INT NULL,
    RAMAT DATE NULL,

    CONSTRAINT FK_CTSP_SANPHAM FOREIGN KEY(MaSP) REFERENCES SANPHAM(MaSP)
);

CREATE TABLE MAU
(
    MaMau INT AUTO_INCREMENT PRIMARY KEY,
    TenMau TEXT NULL
);
CREATE TABLE SANPHAM_MAU
(
     MaSP_Mau INT AUTO_INCREMENT PRIMARY KEY,
     MaSP INT NOT NULL,
     SoLuongTon INT NOT NULL,
     MaMau INT NOT NULL,

     CONSTRAINT FK_SPMAU_SP FOREIGN KEY(MaSP) REFERENCES SANPHAM(MaSP),
     CONSTRAINT FK_SPMAU_MAU FOREIGN KEY(MaMau) REFERENCES MAU(MaMau)
);


CREATE TABLE GIOHANG
(
    MaGioHang INT AUTO_INCREMENT PRIMARY KEY,
    MaTV INT NULL,

    CONSTRAINT FK_GIOHANG_TV FOREIGN KEY(MaTV) REFERENCES THANHVIEN(MaTV)
);

CREATE TABLE CHITIETGIOHANG
(
    MaChiTietGH INT AUTO_INCREMENT PRIMARY KEY,
    MaGioHang INT NOT NULL,
    MaSP INT NOT NULL,
    SoLuong INT NOT NULL,
    DonGia DECIMAL(18,0) NOT NULL,
    MaMau INT NOT NULL,

    CONSTRAINT FK_CTGH_GH FOREIGN KEY(MaGioHang) REFERENCES GIOHANG(MaGioHang),
    CONSTRAINT FK_CTGH_SP FOREIGN KEY(MaSP) REFERENCES SANPHAM(MaSP)
);

INSERT INTO NHACUNGCAP (TenNCC, DiaChi, Email, SoDienThoai) VALUES 
('Nhà cung cấp A', 'Địa chỉ A', 'nccA@example.com', '0123456789'),
('Nhà cung cấp B', 'Địa chỉ B', 'nccB@example.com', '0987654321'),
('Nhà cung cấp C', 'Địa chỉ C', 'nccC@example.com', '0369852147'),
('Nhà cung cấp D', 'Địa chỉ A', 'nccA@example.com', '0123456789'),
('Nhà cung cấp E', 'Địa chỉ B', 'nccB@example.com', '0987654321'),
('Nhà cung cấp F', 'Địa chỉ C', 'nccC@example.com', '0369852147');

INSERT INTO LOAITHANHVIEN (TenLoai, UuDai) VALUES 
('Admin', null),
('Khách hàng ', null);

INSERT INTO THANHVIEN (MaLoaiTV, TaiKhoan, MatKhau, HoTen, DiaChi, Email, SoDienThoai, CauHoi, CauTraLoi, HinhDaiDien, MaToken, ThoiGianMaToken) VALUES
(1, 'admin', '1', 'Nguyễn Văn A', 'Địa chỉ A', 'email1@example.com', '0123456789', null, null, 'avatar1.png', NULL, NULL),
(2, 'taopro', '1', 'Trần Thị B', 'Địa chỉ B', 'email2@example.com', '0987654321', null, null, 'avatar2.png', NULL, NULL);

INSERT INTO LOAISANPHAM(MaDanhMuc, TenLoaiSP, Icon, BiDanh) VALUES
(1, N'Iphone', N'logo-iphone-220x48.png', null),
(1, N'Oppo', N'OPPO42-b_5.jpg', null),
(1, N'Vivo', N'vivo-logo-220-220x48-3.png', null),
(1, N'Samsung', N'samsungnew-220x48-1.png', null),
(1, N'Xiaomi', N'logo-xiaomi-220x48-5.png', null),
(2, N'Sạc dự phòng', null, null),
(2, N'Tai nghe', null, null);

INSERT INTO SANPHAM(MaNCC, MaLoaiSP, MaKhuyenMai, TenSP, DonGia, NgayCapNhat, MoTa, HinhAnh, HinhAnh2, HinhAnh3, LuotXem, LuotBinhChon, LuotBinhLuan, SoLanMua, Moi, DaXoa) VALUES
(1, 1, NULL, N'Điện thoại iPhone 14 Pro Max 128GB', NULL, '2023-08-01', N'iPhone 14 Pro Max một siêu phẩm trong giới smartphone được nhà Táo tung ra thị trường vào tháng 09/2022. Máy trang bị con chip Apple A16 Bionic vô cùng mạnh mẽ, đi kèm theo đó là thiết kế hình màn hình mới, hứa hẹn mang lại những trải nghiệm đầy mới mẻ cho người dùng iPhone.', N'iphone-14-pro-max-purple-1.jpg', N'iphone-14-pro-max-vang-1.jpg', N'iphone-14-pro-max-note.jpg',  null, null, null, 0, 1, 0),
(1, 1, NULL, N'Điện thoại iPhone 14 Pro Max 256GB', NULL, '2023-08-01', N'iPhone 14 Pro Max một siêu phẩm trong giới smartphone được nhà Táo tung ra thị trường vào tháng 09/2022. Máy trang bị con chip Apple A16 Bionic vô cùng mạnh mẽ, đi kèm theo đó là thiết kế hình màn hình mới, hứa hẹn mang lại những trải nghiệm đầy mới mẻ cho người dùng iPhone.', N'iphone-14-pro-max-purple-1.jpg', N'iphone-14-pro-max-vang-1.jpg', N'iphone-14-pro-max-note.jpg',  null, null, null, 0, 1, 0),
(1, 1, NULL,  N'Điện thoại iPhone 14 Pro Max 512GB', NULL, '2023-08-01', N'iPhone 14 Pro Max một siêu phẩm trong giới smartphone được nhà Táo tung ra thị trường vào tháng 09/2022. Máy trang bị con chip Apple A16 Bionic vô cùng mạnh mẽ, đi kèm theo đó là thiết kế hình màn hình mới, hứa hẹn mang lại những trải nghiệm đầy mới mẻ cho người dùng iPhone.', N'iphone-14-pro-max-purple-1.jpg', N'iphone-14-pro-max-vang-1.jpg', N'iphone-14-pro-max-note.jpg',  null, null, null, 0, 1, 0),
(1, 1, NULL, N'Điện thoại iPhone 14 Pro Max 1TB', NULL, '2023-08-01', N'iPhone 14 Pro Max một siêu phẩm trong giới smartphone được nhà Táo tung ra thị trường vào tháng 09/2022. Máy trang bị con chip Apple A16 Bionic vô cùng mạnh mẽ, đi kèm theo đó là thiết kế hình màn hình mới, hứa hẹn mang lại những trải nghiệm đầy mới mẻ cho người dùng iPhone.', N'iphone-14-pro-max-purple-1.jpg', N'iphone-14-pro-max-vang-1.jpg', N'iphone-14-pro-max-note.jpg',  null, null, null, 0, 1, 0),
(1, 1, NULL, N'Điện thoại iPhone 13 Pro Max 123GB', NULL, '2023-08-01', N'Điện thoại iPhone 13 Pro Max 128 GB - siêu phẩm được mong chờ nhất ở nửa cuối năm 2021 đến từ Apple. Máy có thiết kế không mấy đột phá khi so với người tiền nhiệm, bên trong đây vẫn là một sản phẩm có màn hình siêu đẹp, tần số quét được nâng cấp lên 120 Hz mượt mà, cảm biến camera có kích thước lớn hơn, cùng hiệu năng mạnh mẽ với sức mạnh đến từ Apple A15 Bionic, sẵn sàng cùng bạn chinh phục mọi thử thách.', N'iphone-13-pro-max-1-1.jpg', N'iphone-13-pro-max-1.jpg', N'iphone-13-pro-max-n-2.jpg',  null, null, null, 0, 1, 0),
(1, 1, NULL, N'Điện thoại iPhone 13 Pro Max 256GB', NULL, '2023-08-01', N'Điện thoại iPhone 13 Pro Max 256 GB - siêu phẩm được mong chờ nhất ở nửa cuối năm 2021 đến từ Apple. Máy có thiết kế không mấy đột phá khi so với người tiền nhiệm, bên trong đây vẫn là một sản phẩm có màn hình siêu đẹp, tần số quét được nâng cấp lên 120 Hz mượt mà, cảm biến camera có kích thước lớn hơn, cùng hiệu năng mạnh mẽ với sức mạnh đến từ Apple A15 Bionic, sẵn sàng cùng bạn chinh phục mọi thử thách.', N'iphone-13-pro-max-1-1.jpg', N'iphone-13-pro-max-1.jpg', N'iphone-13-pro-max-n-2.jpg',  null, null, null, 0, 1, 0),
(1, 1, NULL, N'Điện thoại iPhone 13 Pro Max 512GB', NULL, '2023-08-01', N'Điện thoại iPhone 13 Pro Max 512 GB - siêu phẩm được mong chờ nhất ở nửa cuối năm 2021 đến từ Apple. Máy có thiết kế không mấy đột phá khi so với người tiền nhiệm, bên trong đây vẫn là một sản phẩm có màn hình siêu đẹp, tần số quét được nâng cấp lên 120 Hz mượt mà, cảm biến camera có kích thước lớn hơn, cùng hiệu năng mạnh mẽ với sức mạnh đến từ Apple A15 Bionic, sẵn sàng cùng bạn chinh phục mọi thử thách.', N'iphone-13-pro-max-1-1.jpg', N'iphone-13-pro-max-1.jpg', N'iphone-13-pro-max-n-2.jpg',  null, null, null, 0, 1, 0),
(1, 1, NULL, N'Điện thoại iPhone 12 Pro Max 128GB', NULL, '2023-08-01', N'iPhone 12 Pro Max 128 GB một siêu phẩm smartphone đến từ Apple. Máy có một hiệu năng hoàn toàn mạnh mẽ đáp ứng tốt nhiều nhu cầu đến từ người dùng và mang trong mình một thiết kế đầy vuông vức, sang trọng.', N'iphone-12-pro-max-512gb-1-org.jpg', N'iphone-12-pro-max-512gb-bac-1-org.jpg', N'iphone-12-pro-max-512gb-note-2.jpg',  null, null, null, 0, 0, 0),
(1, 1, NULL, N'Điện thoại iPhone 12 Pro Max 256GB', NULL, '2023-08-01', N'iPhone 12 Pro Max 256 GB một siêu phẩm smartphone đến từ Apple. Máy có một hiệu năng hoàn toàn mạnh mẽ đáp ứng tốt nhiều nhu cầu đến từ người dùng và mang trong mình một thiết kế đầy vuông vức, sang trọng.', N'iphone-12-pro-max-512gb-1-org.jpg', N'iphone-12-pro-max-512gb-bac-1-org.jpg', N'iphone-12-pro-max-512gb-note-2.jpg',  null, null, null, 0, 0, 0),
(2, 2, NULL, N'Điện thoại OPPO Find N2 Flip 5G', NULL, '2023-08-01', N'OPPO Find N2 Flip 5G - chiếc điện thoại gập đầu tiên của OPPO đã được giới thiệu chính thức tại Việt Nam vào tháng 03/2023. Sở hữu cấu hình mạnh mẽ cùng thiết kế siêu nhỏ gọn giúp tối ưu kích thước, chiếc điện thoại sẽ cùng bạn nổi bật trong mọi không gian với vẻ ngoài đầy cá tính.', N'oppo-n2-flip-tim-1-1.jpg', N'oppo-n2-flip-den-1.jpg', N'oppo-n2-flip-tim-note.jpg',  null, null, null, 0, 1, 0),
(2, 2, NULL, N'Điện thoại OPPO Reno10 Pro 5G', NULL, '2023-08-01', N'OPPO Reno10 Pro 5G là một trong những sản phẩm của OPPO được ra mắt trong 2023. Với thiết kế đẹp mắt, màn hình lớn và hiệu năng mạnh mẽ, Reno10 Pro chắc chắn sẽ là lựa chọn đáng cân nhắc dành cho những ai đang tìm kiếm chiếc máy tầm trung để phục vụ tốt mọi nhu cầu.', N'oppo-reno10-pro-xam-1-1.jpg', N'oppo-reno10-pro-tim-1-2.jpg', N'oppo-reno10-pro-note.jpg',  null, null, null, 0, 1, 0),
(2, 2, NULL, N'Điện thoại OPPO A77s', NULL, '2023-08-01', N'OPPO vừa cho ra mắt mẫu điện thoại tầm trung mới với tên gọi OPPO A77s, máy sở hữu màn hình lớn, thiết kế đẹp mắt, hiệu năng ổn định cùng khả năng mở rộng RAM lên đến 8 GB vô cùng nổi bật trong phân khúc.', N'oppo-a77s-den-1.jpg', N'oppo-a77s-xanh-1.jpg', N'oppo-a77s-note-2.jpg', null, null, null, 0, 1, 0),
(3, 3, NULL, N'Điện thoại vivo V25 Pro 5G', NULL, '2023-08-01', N'VIVO V25 Pro 5G vừa được ra mắt với một mức giá bán cực kỳ hấp dẫn, thế mạnh của máy thuộc về phần hiệu năng nhờ trang bị con chip MediaTek Dimensity 1300 và cụm camera sắc nét 64 MP, hứa hẹn mang lại cho người dùng những trải nghiệm ổn định trong suốt quá trình sử dụng.', N'vivo-v25-pro-5g-sld-xanh-1.jpg', N'vivo-v25-pro-5g-den-1.jpg', N'vivo-v25-pro-5g-note-2.jpg',  null, null, null, 0, 1, 0),
(3, 3, NULL, N'Điện thoại vivo Y02A', NULL, '2023-08-01', N'VIVO Y02A mẫu điện thoại được nhà vivo cho ra mắt hướng đến nhóm người dùng yêu thích sự đơn giản trong thiết kế, hiệu năng tốt có thể xử lý các tác vụ thường ngày và một viên pin lớn đáp ứng được nhu cầu sử dụng lâu dài.', N'vivo-y02-den-1.jpg', N'vivo-y02-tim-1.jpg', N'vivo-y02-note.jpg', null, null, null, 0, 1, 0),
(3, 3, NULL, N'Điện thoại vivo V27e', NULL, '2023-08-01', N'vivo V27e một trong những chiếc điện thoại tầm trung nổi bật của vivo trong năm 2023. Với thiết kế độc đáo và khả năng chụp ảnh - quay phim ấn tượng, vì thế máy đã mang lại cho vivo nhiều niềm tự hào khi ra mắt tại thị trường Việt Nam, hứa hẹn mang đến trải nghiệm tuyệt vời đến với người dùng.', N'vivo-v27e-tim-1-1.jpg', N'vivo-v27e-den-1.jpg', N'vivo-v27e-note.jpg',  null, null, null, 0, 1, 0),
(4, 4, NULL, N'Điện thoại Samsung Galaxy Z Fold5 5G 256GB ', NULL, '2023-08-01', N'Samsung Galaxy Z Fold5 là mẫu điện thoại cao cấp được ra mắt vào tháng 07/2023 với nhiều điểm đáng chú ý như thiết kế gập độc đáo, hiệu năng mạnh mẽ cùng camera quay chụp tốt, điều này giúp cho máy thu hút được nhiều sự quan tâm của đông đảo người dùng yêu công nghệ hiện nay.', N'samsung-galaxy-zfold5-xanh-256gb-1-1.jpg', N'samsung-galaxy-zfold5-den-256gb-1.jpg', N'samsung-galaxy-zfold5-note.jpg',  null, null, null, 0, 1, 0),
(4, 4, NULL, N'Điện thoại Samsung Galaxy Z Fold5 5G 512GB ', NULL, '2023-08-01', N'Samsung Galaxy Z Fold5 là mẫu điện thoại cao cấp được ra mắt vào tháng 07/2023 với nhiều điểm đáng chú ý như thiết kế gập độc đáo, hiệu năng mạnh mẽ cùng camera quay chụp tốt, điều này giúp cho máy thu hút được nhiều sự quan tâm của đông đảo người dùng yêu công nghệ hiện nay.', N'samsung-galaxy-zfold5-xanh-256gb-1-1.jpg', N'samsung-galaxy-zfold5-den-256gb-1.jpg', N'samsung-galaxy-zfold5-note.jpg',  null, null, null, 0, 1, 0),
(4, 4, NULL, N'Điện thoại Samsung Galaxy Z Fold5 5G 1TB', NULL, '2023-08-01', N'Samsung Galaxy Z Fold5 là mẫu điện thoại cao cấp được ra mắt vào tháng 07/2023 với nhiều điểm đáng chú ý như thiết kế gập độc đáo, hiệu năng mạnh mẽ cùng camera quay chụp tốt, điều này giúp cho máy thu hút được nhiều sự quan tâm của đông đảo người dùng yêu công nghệ hiện nay.', N'samsung-galaxy-zfold5-xanh-256gb-1-1.jpg', N'samsung-galaxy-zfold5-den-256gb-1.jpg', N'samsung-galaxy-zfold5-note.jpg',  null, null, null, 0, 1, 0),
(4, 4, NULL, N'Điện thoại Samsung Galaxy Z Flip4 5G 128GB', NULL, '2023-08-01', N'Samsung Galaxy Z Flip4 128GB đã chính thức ra mắt thị trường công nghệ, đánh dấu sự trở lại của Samsung trên con đường định hướng người dùng về sự tiện lợi trên những chiếc điện thoại gập. Với độ bền được gia tăng cùng kiểu thiết kế đẹp mắt giúp Flip4 trở thành một trong những tâm điểm sáng giá cho nửa cuối năm 2022.', N'samsung-galaxy-flip4-glr-tim-1.jpg', N'samsung-galaxy-flip-den-1.jpg', N'samsung-galaxy-z-flip4-note-1-1.jpg',  null, null, null, 0, 1, 0),
(4, 4, NULL, N'Điện thoại Samsung Galaxy Z Flip4 5G 256GB', NULL, '2023-08-01', N'Samsung Galaxy Z Flip4 256GB đã chính thức ra mắt thị trường công nghệ, đánh dấu sự trở lại của Samsung trên con đường định hướng người dùng về sự tiện lợi trên những chiếc điện thoại gập. Với độ bền được gia tăng cùng kiểu thiết kế đẹp mắt giúp Flip4 trở thành một trong những tâm điểm sáng giá cho nửa cuối năm 2022.', N'samsung-galaxy-flip4-glr-tim-1.jpg', N'samsung-galaxy-flip-den-1.jpg', N'samsung-galaxy-z-flip4-note-1-1.jpg',  null, null, null, 0, 1, 0),
(4, 4, NULL, N'Điện thoại Samsung Galaxy Z Flip4 5G 512GB', NULL, '2023-08-01', N'Samsung Galaxy Z Flip4 512GB đã chính thức ra mắt thị trường công nghệ, đánh dấu sự trở lại của Samsung trên con đường định hướng người dùng về sự tiện lợi trên những chiếc điện thoại gập. Với độ bền được gia tăng cùng kiểu thiết kế đẹp mắt giúp Flip4 trở thành một trong những tâm điểm sáng giá cho nửa cuối năm 2022.', N'samsung-galaxy-flip4-glr-tim-1.jpg', N'samsung-galaxy-flip-den-1.jpg', N'samsung-galaxy-z-flip4-note-1-1.jpg',  null, null, null, 0, 1, 0),
(5, 5, NULL, N'Điện thoại Xiaomi 12 5G', NULL, '2023-08-01', N'Điện thoại Xiaomi đang dần khẳng định chỗ đứng của mình trong phân khúc flagship bằng việc ra mắt Xiaomi 12 với bộ thông số ấn tượng, máy có một thiết kế gọn gàng, hiệu năng mạnh mẽ, màn hình hiển thị chi tiết cùng khả năng chụp ảnh sắc nét nhờ trang bị ống kính đến từ Sony.', N'xiaomi-mi-12-1-1.jpg', N'xiaomi-mi-12-1.jpg', N'xiaomi-mi-12-note.jpg',  null, null, null, 0, 1, 0),
(5, 5, NULL, N'Điện thoại Xiaomi Redmi Note 12S', NULL, '2023-08-01', N'Xiaomi Redmi Note 12S sẽ là chiếc điện thoại tiếp theo được nhà Xiaomi tung ra thị trường Việt Nam trong thời gian tới (05/2023). Điện thoại sở hữu một lối thiết kế hiện đại, màn hình hiển thị chi tiết đi cùng với đó là một hiệu năng mượt mà xử lý tốt các tác vụ.', N'xiaomi-redmi-note-12s-1-1.jpg', N'xiaomi-redmi-note-12s-xanh-1.jpg', N'xiaomi-redmi-note-12s-note.jpg',  null, null, null, 0, 1, 0),
(5, 5, NULL, N'Điện thoại Xiaomi Redmi Note 12 Pro 128GB', NULL, '2023-08-01', N'Xiaomi Redmi Note 12 Pro 4G tiếp tục sẽ là mẫu điện thoại tầm trung được nhà Xiaomi giới thiệu đến thị trường Việt Nam trong năm 2023, máy nổi bật với camera 108 MP chất lượng, thiết kế viền mỏng cùng hiệu năng đột phá nhờ trang bị chip Snapdragon 732G.', N'xiami-redmi-12-pro-xam-1.jpg', N'xiaomi-redmi-12-pro-4g-xanh-duong-1.jpg', N'xiaomi-redmi-12-note-2.jpg',  null, null, null, 0, 1, 0);

INSERT INTO CHITIETSANPHAM(MaSP, KICHTHUOCMANHINH, CONGNGHEMANHINH, DOPHANGIAI, TINHNANGMANGHINH, TANSOQUET, CAMERASAU, QUAYPHIM, CAMERATRUOC, TINHNANGCAMERA, HEDIEUHANH, CHIP, TOCDOCPU, CHIPDOHOA, RAM, DUNGLUONG, MANGDIDONG, SIM, WIFI, CONGKETNOI, DUNGLUONGPIN, LOAIPIN, HOTROSAC, BAOMAT, TINHNANGDACBIET, KHANGNUOC, THIETKE, CHATLIEU, KICHTHUOC, BAOHANH, RAMAT) VALUES
(1, N'6.7"', N'OLED', N'Super Retina XDR (1290 x 2796 Pixels)', N'Kính cường lực Ceramic Shield', N'120 Hz', N'Chính 48 MP & Phụ 12 MP, 12 MP', N'HD 720p@30fps, FullHD 1080p@60fps, FullHD 1080p@30fps, 4K 2160p@24fps, 4K 2160p@30fps, 4K 2160p@60fps', N'12 MP', N'Chế độ hành động (Action Mode), Dolby Vision HDR, Trôi nhanh thời gian (Time Lapse), Góc siêu rộng (Ultrawide), Zoom kỹ thuật số, Cinematic, Quay chậm (Slow Motion), Xóa phông, Deep Fusion, Toàn cảnh (Panorama), Chống rung quang học (OIS), Ban đêm (Night Mode), Zoom quang học Siêu cận (Macro), Live Photo, Bộ lọc màu, Smart HDR 4', N'iOS 16', N'Apple A16 Bionic 6 nhân', N'3.46 GHz', N'Apple GPU 5 nhân', N'6 GB', N'128GB', N'Hỗ trợ 5G', N'1 Nano SIM & 1 eSIM', N'Wi-Fi MIMO, Wi-Fi hotspot, Wi-Fi 802.11 a/b/g/n/ac/ax', N'Lightning', N'4323 mAh', N'Li-Ion', N'20 W', N'Mở khoá khuôn mặt Face ID', N'Phát hiện va chạm (Crash Detection), Màn hình luôn hiển thị AOD, Chạm 2 lần sáng màn hình, Apple Pay, Loa kép', N'IP68', N'Nguyên khối', N'Khung thép không gỉ & Mặt lưng kính cường lực', N'Dài 160.7 mm - Ngang 77.6 mm - Dày 7.85 mm - Nặng 240 g',12, '2022-09-01'),
(2, N'6.7"', N'OLED', N'Super Retina XDR (1290 x 2796 Pixels)', N'Kính cường lực Ceramic Shield', N'120 Hz', N'Chính 48 MP & Phụ 12 MP, 12 MP', N'HD 720p@30fps, FullHD 1080p@60fps, FullHD 1080p@30fps, 4K 2160p@24fps, 4K 2160p@30fps, 4K 2160p@60fps', N'12 MP', N'Chế độ hành động (Action Mode), Dolby Vision HDR, Trôi nhanh thời gian (Time Lapse), Góc siêu rộng (Ultrawide), Zoom kỹ thuật số, Cinematic, Quay chậm (Slow Motion), Xóa phông, Deep Fusion, Toàn cảnh (Panorama), Chống rung quang học (OIS), Ban đêm (Night Mode), Zoom quang học Siêu cận (Macro), Live Photo, Bộ lọc màu, Smart HDR 4', N'iOS 16', N'Apple A16 Bionic 6 nhân', N'3.46 GHz', N'Apple GPU 5 nhân', N'6 GB', N'256GB', N'Hỗ trợ 5G', N'1 Nano SIM & 1 eSIM', N'Wi-Fi MIMO, Wi-Fi hotspot, Wi-Fi 802.11 a/b/g/n/ac/ax', N'Lightning', N'4323 mAh', N'Li-Ion', N'20 W', N'Mở khoá khuôn mặt Face ID', N'Phát hiện va chạm (Crash Detection), Màn hình luôn hiển thị AOD, Chạm 2 lần sáng màn hình, Apple Pay, Loa kép', N'IP68', N'Nguyên khối', N'Khung thép không gỉ & Mặt lưng kính cường lực', N'Dài 160.7 mm - Ngang 77.6 mm - Dày 7.85 mm - Nặng 240 g', 12, '2022-09-01'),
(3, N'6.7"', N'OLED', N'Super Retina XDR (1290 x 2796 Pixels)', N'Kính cường lực Ceramic Shield', N'120 Hz', N'Chính 48 MP & Phụ 12 MP, 12 MP', N'HD 720p@30fps, FullHD 1080p@60fps, FullHD 1080p@30fps, 4K 2160p@24fps, 4K 2160p@30fps, 4K 2160p@60fps', N'12 MP', N'Chế độ hành động (Action Mode), Dolby Vision HDR, Trôi nhanh thời gian (Time Lapse), Góc siêu rộng (Ultrawide), Zoom kỹ thuật số, Cinematic, Quay chậm (Slow Motion), Xóa phông, Deep Fusion, Toàn cảnh (Panorama), Chống rung quang học (OIS), Ban đêm (Night Mode), Zoom quang học Siêu cận (Macro), Live Photo, Bộ lọc màu, Smart HDR 4', N'iOS 16', N'Apple A16 Bionic 6 nhân', N'3.46 GHz', N'Apple GPU 5 nhân', N'6 GB', N'512GB', N'Hỗ trợ 5G', N'1 Nano SIM & 1 eSIM', N'Wi-Fi MIMO, Wi-Fi hotspot, Wi-Fi 802.11 a/b/g/n/ac/ax', N'Lightning', N'4323 mAh', N'Li-Ion', N'20 W', N'Mở khoá khuôn mặt Face ID', N'Phát hiện va chạm (Crash Detection), Màn hình luôn hiển thị AOD, Chạm 2 lần sáng màn hình, Apple Pay, Loa kép', N'IP68', N'Nguyên khối', N'Khung thép không gỉ & Mặt lưng kính cường lực', N'Dài 160.7 mm - Ngang 77.6 mm - Dày 7.85 mm - Nặng 240 g', 12, '2022-09-01'),
(4, N'6.7"', N'OLED', N'Super Retina XDR (1290 x 2796 Pixels)', N'Kính cường lực Ceramic Shield', N'120 Hz', N'Chính 48 MP & Phụ 12 MP, 12 MP', N'HD 720p@30fps, FullHD 1080p@60fps, FullHD 1080p@30fps, 4K 2160p@24fps, 4K 2160p@30fps, 4K 2160p@60fps', N'12 MP', N'Chế độ hành động (Action Mode), Dolby Vision HDR, Trôi nhanh thời gian (Time Lapse), Góc siêu rộng (Ultrawide), Zoom kỹ thuật số, Cinematic, Quay chậm (Slow Motion), Xóa phông, Deep Fusion, Toàn cảnh (Panorama), Chống rung quang học (OIS), Ban đêm (Night Mode), Zoom quang học Siêu cận (Macro), Live Photo, Bộ lọc màu, Smart HDR 4', N'iOS 16', N'Apple A16 Bionic 6 nhân', N'3.46 GHz', N'Apple GPU 5 nhân', N'6 GB', N'1TB', N'Hỗ trợ 5G', N'1 Nano SIM & 1 eSIM', N'Wi-Fi MIMO, Wi-Fi hotspot, Wi-Fi 802.11 a/b/g/n/ac/ax', N'Lightning', N'4323 mAh', N'Li-Ion', N'20 W', N'Mở khoá khuôn mặt Face ID', N'Phát hiện va chạm (Crash Detection), Màn hình luôn hiển thị AOD, Chạm 2 lần sáng màn hình, Apple Pay, Loa kép', N'IP68', N'Nguyên khối', N'Khung thép không gỉ & Mặt lưng kính cường lực', N'Dài 160.7 mm - Ngang 77.6 mm - Dày 7.85 mm - Nặng 240 g', 12, '2022-09-01'),
(5, N'6.7"', N'OLED', N'Super Retina XDR (1284 x 2778 Pixels)', N'Kính cường lực Ceramic Shield', N'120 Hz', N'3 camera 12 MP', N'HD 720p@30fps, FullHD 1080p@60fps, FullHD 1080p@30fps, 4K 2160p@24fps, 4K 2160p@30fps, 4K 2160p@60fps', N'12 MP', N'Deep Fusion, Toàn cảnh (Panorama), Chống rung quang học (OIS), Tự động lấy nét (AF), Nhận diện khuôn mặt, Ảnh Raw, Ban đêm (Night Mode), Chạm lấy nét, Zoom quang học, Siêu cận (Macro), Smart HDR 4', N'iOS 15', N'Apple A15 Bionic 6 nhân', N'3.22 GHz', N'Apple GPU 5 nhân', N'6 GB', N'128GB', N'Hỗ trợ 5G', N'1 Nano SIM & 1 eSIM', N'Wi-Fi MIMO, Wi-Fi hotspot, Wi-Fi 802.11 a/b/g/n/ac/ax', N'Lightning', N'4352 mAh', N'Li-Ion', N'20 W', N'Mở khoá khuôn mặt Face ID', N'Phát hiện va chạm (Crash Detection), Màn hình luôn hiển thị AOD, Chạm 2 lần sáng màn hình, Apple Pay, Loa kép', N'IP68', N'Nguyên khối', N'Khung thép không gỉ & Mặt lưng kính cường lực', N'Dài 160.8 mm - Ngang 78.1 mm - Dày 7.65 mm - Nặng 240 g', 12, '2021-09-01'),
(6, N'6.7"', N'OLED', N'Super Retina XDR (1284 x 2778 Pixels)', N'Kính cường lực Ceramic Shield', N'120 Hz', N'3 camera 12 MP', N'HD 720p@30fps, FullHD 1080p@60fps, FullHD 1080p@30fps, 4K 2160p@24fps, 4K 2160p@30fps, 4K 2160p@60fps', N'12 MP', N'Deep Fusion, Toàn cảnh (Panorama), Chống rung quang học (OIS), Tự động lấy nét (AF), Nhận diện khuôn mặt, Ảnh Raw, Ban đêm (Night Mode), Chạm lấy nét, Zoom quang học, Siêu cận (Macro), Smart HDR 4', N'iOS 15', N'Apple A15 Bionic 6 nhân', N'3.22 GHz', N'Apple GPU 5 nhân', N'6 GB', N'256GB', N'Hỗ trợ 5G', N'1 Nano SIM & 1 eSIM', N'Wi-Fi MIMO, Wi-Fi hotspot, Wi-Fi 802.11 a/b/g/n/ac/ax', N'Lightning', N'4352 mAh', N'Li-Ion', N'20 W', N'Mở khoá khuôn mặt Face ID', N'Phát hiện va chạm (Crash Detection), Màn hình luôn hiển thị AOD, Chạm 2 lần sáng màn hình, Apple Pay, Loa kép', N'IP68', N'Nguyên khối', N'Khung thép không gỉ & Mặt lưng kính cường lực', N'Dài 160.8 mm - Ngang 78.1 mm - Dày 7.65 mm - Nặng 240 g', 12, '2021-09-01'),
(7, N'6.7"', N'OLED', N'Super Retina XDR (1284 x 2778 Pixels)', N'Kính cường lực Ceramic Shield', N'120 Hz', N'3 camera 12 MP', N'HD 720p@30fps, FullHD 1080p@60fps, FullHD 1080p@30fps, 4K 2160p@24fps, 4K 2160p@30fps, 4K 2160p@60fps', N'12 MP', N'Deep Fusion, Toàn cảnh (Panorama), Chống rung quang học (OIS), Tự động lấy nét (AF), Nhận diện khuôn mặt, Ảnh Raw, Ban đêm (Night Mode), Chạm lấy nét, Zoom quang học, Siêu cận (Macro), Smart HDR 4', N'iOS 15', N'Apple A15 Bionic 6 nhân', N'3.22 GHz', N'Apple GPU 5 nhân', N'6 GB', N'512GB', N'Hỗ trợ 5G', N'1 Nano SIM & 1 eSIM', N'Wi-Fi MIMO, Wi-Fi hotspot, Wi-Fi 802.11 a/b/g/n/ac/ax', N'Lightning', N'4352 mAh', N'Li-Ion', N'20 W', N'Mở khoá khuôn mặt Face ID', N'Phát hiện va chạm (Crash Detection), Màn hình luôn hiển thị AOD, Chạm 2 lần sáng màn hình, Apple Pay, Loa kép', N'IP68', N'Nguyên khối', N'Khung thép không gỉ & Mặt lưng kính cường lực', N'Dài 160.8 mm - Ngang 78.1 mm - Dày 7.65 mm - Nặng 240 g', 12, '2021-09-01'),
(8, N'6.7"', N'OLED', N'Super Retina XDR (1284 x 2778 Pixels)', N'Kính cường lực Ceramic Shield', N'60 Hz', N'3 camera 12 MP', N'HD 720p@30fps, FullHD 1080p@60fps, FullHD 1080p@30fps, 4K 2160p@24fps, 4K 2160p@30fps, 4K 2160p@60fps', N'12 MP', N'Deep Fusion, Toàn cảnh (Panorama), Chống rung quang học (OIS), Tự động lấy nét (AF), Nhận diện khuôn mặt, Ban đêm (Night Mode), Zoom quang học, Siêu cận (Macro), Smart HDR 4', N'iOS 15', N'Apple A14 Bionic 6 nhân', N'2 nhân 3.1 GHz & 4 nhân 1.8 GHz', N'Apple GPU 4 nhân', N'6 GB', N'128GB', N'Hỗ trợ 5G', N'1 Nano SIM & 1 eSIM', N'Wi-Fi MIMO, Wi-Fi hotspot, Wi-Fi 802.11 a/b/g/n/ac/ax', N'Lightning', N'3687 mAh', N'Li-Ion', N'20 W', N'Mở khoá khuôn mặt Face ID', N'Phát hiện va chạm (Crash Detection), Màn hình luôn hiển thị AOD, Chạm 2 lần sáng màn hình', N'IP68', N'Nguyên khối', N'Khung thép không gỉ & Mặt lưng kính cường lực', N'Dài 160.8 mm - Ngang 78.1 mm - Dày 7.4 mm - Nặng 228 g', 12, '2020-10-01'),
(9, N'6.7"', N'OLED', N'Super Retina XDR (1284 x 2778 Pixels)', N'Kính cường lực Ceramic Shield', N'60 Hz', N'3 camera 12 MP', N'HD 720p@30fps, FullHD 1080p@60fps, FullHD 1080p@30fps, 4K 2160p@24fps, 4K 2160p@30fps, 4K 2160p@60fps', N'12 MP', N'Deep Fusion, Toàn cảnh (Panorama), Chống rung quang học (OIS), Tự động lấy nét (AF), Nhận diện khuôn mặt, Ban đêm (Night Mode), Zoom quang học, Siêu cận (Macro), Smart HDR 4', N'iOS 15', N'Apple A14 Bionic 6 nhân', N'2 nhân 3.1 GHz & 4 nhân 1.8 GHz', N'Apple GPU 4 nhân', N'6 GB', N'256GB', N'Hỗ trợ 5G', N'1 Nano SIM & 1 eSIM', N'Wi-Fi MIMO, Wi-Fi hotspot, Wi-Fi 802.11 a/b/g/n/ac/ax', N'Lightning', N'3687 mAh', N'Li-Ion', N'20 W', N'Mở khoá khuôn mặt Face ID', N'Phát hiện va chạm (Crash Detection), Màn hình luôn hiển thị AOD, Chạm 2 lần sáng màn hình', N'IP68', N'Nguyên khối', N'Khung thép không gỉ & Mặt lưng kính cường lực', N'Dài 160.8 mm - Ngang 78.1 mm - Dày 7.4 mm - Nặng 228 g', 12, '2020-10-01'),
(10, N'Chính 6.8" & Phụ 3.26"', N'AMOLED', N'Chính: FHD+ (2520 x 1080 Pixels) & Phụ: (720 x 382 Pixels)', N'Kính siêu mỏng Ultra Thin Glass (UTG)', N'120 Hz & 60 Hz', N'Chính 50 MP & Phụ 8 MP', N'HD 720p@30fps, FullHD 1080p@60fps, FullHD 1080p@30fps, 4K 2160p@24fps, 4K 2160p@30fps', N'32 MP', N'Trôi nhanh thời gian (Time Lapse), Quay chậm (Slow Motion), Xóa phông, Toàn cảnh (Panorama), Ban đêm (Night Mode), Chuyên nghiệp (Pro), HDR, Zoom quang học, Siêu độ phân giải, AI Camera, Làm đẹp, Nhãn dán (AR Stickers), Bộ lọc màu', N'Android 13', N'MediaTek Dimensity 9000+ 8 nhân', N'3.2 GHz', N'Mali-G710 MC10', N'8 GB', N'256GB', N'Hỗ trợ 5G', N'2 Nano SIM', N'Wi-Fi MIMO, Wi-Fi hotspot, Wi-Fi 802.11 a/b/g/n/ac/ax', N'Type-C', N'4300 mAh', N'Li-Po', N'44 W', N'Mở khoá vân tay cạnh viền, Mở khoá khuôn mặt', N'Cử chỉ thông minh, Mở rộng bộ nhớ RAM, Ứng dụng kép (Nhân bản ứng dụng), Thu nhỏ màn hình sử dụng một tay, Đa cửa sổ (chia đôi màn hình), Chế độ trẻ em (Không gian trẻ em)', N'IPX4', N'Nguyên khối', N'Khung hợp kim & Mặt lưng kính cường lực Gorilla Glass 5', N'Dài 166.2 mm - Ngang 75.2 mm - Dày 7.45 mm - Nặng 191 g', 12, '2023-04-01'),
(11, N'6.7"', N'AMOLED', N'Full HD+ (1080 x 2412 Pixels)', N'Kính cường lực AGC DT-Star2', N'120 Hz', N'Chính 50 MP & Phụ 32 MP, 8 MP', N'HD 720p@30fps, FullHD 1080p@60fps, FullHD 1080p@30fps, 4K 2160p@24fps, 4K 2160p@30fps', N'32 MP', N'Trôi nhanh thời gian (Time Lapse), Quay chậm (Slow Motion), Xóa phông, Toàn cảnh (Panorama), Ban đêm (Night Mode), Chuyên nghiệp (Pro), HDR, Zoom quang học, Siêu độ phân giải, AI Camera, Làm đẹp, Nhãn dán (AR Stickers), Bộ lọc màu', N'Android 13', N'Snapdragon 778G 5G 8 nhân', N'2.4 GHz', N'Adreno 642L', N'12 GB', N'256GB', N'Hỗ trợ 5G', N'2 Nano SIM', N'Wi-Fi MIMO, Wi-Fi hotspot, Wi-Fi 6', N'Type-C', N'4600 mAh', N'Li-Po', N'80 W', N'Mở khoá vân tay cạnh viền, Mở khoá khuôn mặt', N'Cử chỉ thông minh, Mở rộng bộ nhớ RAM, Ứng dụng kép (Nhân bản ứng dụng), Thu nhỏ màn hình sử dụng một tay, Đa cửa sổ (chia đôi màn hình), Chế độ trẻ em (Không gian trẻ em)', N'IP54', N'Nguyên khối', N'Khung nhựa & Mặt lưng kính', N'Dài 162.3 mm - Ngang 74.2 mm - Dày 7.89 mm - Nặng 185 g', 12, '2023-08-01'),
(12, N'6.56"', N'IPS LCD', N'HD+ (720 x 1612 Pixels)', N'Kính cường lực Panda', N'90 Hz', N'Chính 50 MP & Phụ 2 MP', N'HD 720p@30fps, FullHD 1080p@30fps', N'8 MP', N'Trôi nhanh thời gian (Time Lapse), Xóa phông, Toàn cảnh (Panorama), Ban đêm (Night Mode), HDR, Zoom quang học, Siêu độ phân giải, Làm đẹp, Bộ lọc màu', N'Android 12', N'Snapdragon 680 8 nhân', N'2.4 GHz', N'Adreno 610', N'8 GB', N'128GB', N'Hỗ trợ 4G', N'2 Nano SIM', N'Wi-Fi 802.11 a/b/g/n/ac, Dual-band (2.4 GHz/5 GHz)', N'Type-C', N'5000 mAh', N'Li-Po', N'33 W', N'Mở khoá vân tay cạnh viền, Mở khoá khuôn mặt', N'Cử chỉ thông minh, Mở rộng bộ nhớ RAM, Ứng dụng kép (Nhân bản ứng dụng), Thu nhỏ màn hình sử dụng một tay, Đa cửa sổ (chia đôi màn hình), Chế độ trẻ em (Không gian trẻ em)', N'IPX4', N'Nguyên khối', N'Khung nhựa & Mặt lưng thuỷ tinh hữu cơ', N'Dài 163.74 mm - Ngang 75.03 mm - Dày 7.99 mm - Nặng 187 g', 12, '2022-10-01'),
(13, N'6.56"', N'AMOLED', N'Full HD+ (1080 x 2376 Pixels)', N'Kính cường lực Schott Xensation UP', N'120 Hz', N'Chính 64 MP & Phụ 8 MP, 2 MP', N'HD 720p@30fps, FullHD 1080p@60fps, FullHD 1080p@30fps, 4K 2160p@30fps, 4K 2160p@60fps, HD 720p@60fps', N'32 MP', N'Quay video hiển thị kép, Trôi nhanh thời gian (Time Lapse), Góc siêu rộng (Ultrawide), Zoom kỹ thuật số, Quay chậm (Slow Motion), Xóa phông, Toàn cảnh (Panorama), Chống rung quang học (OIS), Tự động lấy nét (AF), Ban đêm (Night Mode), Chuyên nghiệp (Pro), HDR, Siêu độ phân giải, AI Camera, Làm đẹp, Siêu cận (Macro), Hiệu ứng Bokeh, Bộ lọc màu', N'Android 12', N'MediaTek Dimensity 1300 8 nhân', N'1 nhân 3 GHz, 3 nhân 2.6 GHz & 4 nhân 2 GHz', N'Mali-G77', N'8 GB', N'128GB', N'Hỗ trợ 5G', N'2 Nano SIM', N'Wi-Fi Direct, Wi-Fi 802.11 a/b/g/n/ac, Dual-band (2.4 GHz/5 GHz)', N'Type-C', N'4830 mAh', N'Li-Po', N'66 W', N'Mở khoá vân tay cạnh viền, Mở khoá khuôn mặt', N'Cử chỉ thông minh, Mở rộng bộ nhớ RAM, Ứng dụng kép (Nhân bản ứng dụng), Thu nhỏ màn hình sử dụng một tay, Đa cửa sổ (chia đôi màn hình), Chế độ trẻ em (Không gian trẻ em)', N'IPX4', N'Nguyên khối', N'Khung kim loại & Mặt lưng kính', N'Dài 158.9 mm - Ngang 73.52 mm - Dày 8.62 mm - Nặng 190 g', 12, '2022-11-01'),
(14, N'6.51"', N'IPS LCD', N'HD+ (720 x 1600 Pixels)', N'Kính cường lực Panda', N'60 Hz', N'8 MP', N'HD 720p@30fps, FullHD 1080p@30fps', N'5 MP', N'Trôi nhanh thời gian (Time Lapse), Xóa phông, Làm đẹp', N'Android 12', N'MediaTek Helio P35 8 nhân', N'4 nhân 2.3 GHz & 4 nhân 1.8 GHz', N'IMG PowerVR GE8320', N'3 GB', N'32 GB', N'Hỗ trợ 4G', N'2 Nano SIM', N'Dual-band (2.4 GHz/5 GHz)', N'Micro USB', N'5000 mAh', N'Li-Po', N'10 W', N'Mở khoá khuôn mặt', N'Chế độ đơn giản (Giao diện đơn giản), Chặn cuộc gọi, Chặn tin nhắn, Chạm 2 lần tắt/sáng màn hình, Trợ lý ảo Google Assistant', N'IP52', N'Nguyên khối', N'Khung & Mặt lưng nhựa Polymer cao cấp', N'Dài 163.99 mm - Ngang 75.63 mm - Dày 8.49 mm - Nặng 186 g', 12, '2023-03-01'),
(15, N'6.62"', N'AMOLED', N'Full HD+ (1080 x 2400 Pixels)', N'Kính cường lực Schott Xensation UP', N'120 Hz', N'Chính 64 MP & Phụ 2 MP, 2 MP', N'HD 720p@30fps, FullHD 1080p@30fps, HD 720p@60fps', N'32 MP', N'Quay video hiển thị kép, Phơi sáng kép, Trôi nhanh thời gian (Time Lapse), Quay chậm (Slow Motion), Xóa phông, Toàn cảnh (Panorama), Chống rung quang học (OIS), Tự động lấy nét (AF), Ban đêm (Night Mode), Chuyên nghiệp (Pro), HDR, Siêu độ phân giải, Làm đẹp, Siêu cận (Macro), Live Photo, Bộ lọc màu', N'Android 13', N'MediaTek Helio G99 8 nhân', N'2 nhân 2.2 GHz & 6 nhân 2.0 GHz', N'Mali-G57', N'8 GB', N'256 GB', N'Hỗ trợ 4G', N'2 Nano SIM', N'Dual-band (2.4 GHz/5 GHz), Wi-Fi Direct', N'Type-C', N'4600 mAh', N'Li-Po', N'66 W', N'Mở khoá vân tay dưới màn hình, Mở khoá khuôn mặt', N'Chế độ đơn giản (Giao diện đơn giản), Chặn cuộc gọi, Chặn tin nhắn, Chạm 2 lần tắt/sáng màn hình, Trợ lý ảo Google Assistant', N'IP54', N'Nguyên khối', N'Khung & Mặt lưng nhựa', N'Dài 162.51 mm - Ngang 75.81 mm - Dày 7.8 mm - Nặng 186 g', 12, '2023-05-01'),
(16, N'Chính 7.6" & Phụ 6.2"', N'Dynamic AMOLED 2X', N'Chính: QXGA+ (2176 x 1812 Pixels) & Phụ: HD+ (2316 x 904 Pixels)', N'Chính: Ultra Thin Glass & Phụ: Corning Gorilla Glass Victus 2', N'120 Hz', N'Chính 50 MP & Phụ 12 MP, 10 MP', N'HD 720p@30fps, FullHD 1080p@30fps, HD 720p@60fps, 4K 2160p@30fps, 4K 2160p@60fps, 8K 4320p@30fps', N'10 MP & 4 MPP', N'Trôi nhanh thời gian (Time Lapse), Góc siêu rộng (Ultrawide), Zoom kỹ thuật số, Góc rộng (Wide), FlexCam, Quay chậm (Slow Motion), Xóa phông, Toàn cảnh (Panorama), Chống rung quang học (OIS), Ban đêm (Night Mode), Chuyên nghiệp (Pro), HDR, Zoom quang học, Quay Siêu chậm (Super Slow Motion), Làm đẹp, Hiệu ứng Bokeh, Bộ lọc màu', N'Android 13', N'Snapdragon 8 Gen 2 for Galaxy', N'1 nhân 3.36 GHz, 4 nhân 2.8 GHz & 3 nhân 2 GHz', N'Adreno 740', N'12 GB', N'256 GB', N'Hỗ trợ 5G', N'2 Nano SIM hoặc 1 Nano SIM + 1 eSIM', N'Dual-band (2.4 GHz/5 GHz), Wi-Fi MIMO, Wi-Fi 802.11 a/b/g/n/ac/ax', N'Type-C', N'4400 mAh', N'Li-Po', N'25 W', N'Mở khoá vân tay cạnh viền, Mở khoá khuôn mặt', N'Chế độ đơn giản (Giao diện đơn giản), Chặn cuộc gọi, Chặn tin nhắn, Chạm 2 lần tắt/sáng màn hình, Trợ lý ảo Google Assistant', N'IPX8', N'Nguyên khối', N'Khung nhôm & Mặt lưng kính cường lực', N'Dài 154.9 mm - Ngang 129.9 mm - Dày 6.1 mm - Nặng 253 g', 18, '2023-07-01'),
(17, N'Chính 7.6" & Phụ 6.2"', N'Dynamic AMOLED 2X', N'Chính: QXGA+ (2176 x 1812 Pixels) & Phụ: HD+ (2316 x 904 Pixels)', N'Chính: Ultra Thin Glass & Phụ: Corning Gorilla Glass Victus 2', N'120 Hz', N'Chính 50 MP & Phụ 12 MP, 10 MP', N'HD 720p@30fps, FullHD 1080p@30fps, HD 720p@60fps, 4K 2160p@30fps, 4K 2160p@60fps, 8K 4320p@30fps', N'10 MP & 4 MPP', N'Trôi nhanh thời gian (Time Lapse), Góc siêu rộng (Ultrawide), Zoom kỹ thuật số, Góc rộng (Wide), FlexCam, Quay chậm (Slow Motion), Xóa phông, Toàn cảnh (Panorama), Chống rung quang học (OIS), Ban đêm (Night Mode), Chuyên nghiệp (Pro), HDR, Zoom quang học, Quay Siêu chậm (Super Slow Motion), Làm đẹp, Hiệu ứng Bokeh, Bộ lọc màu', N'Android 13', N'Snapdragon 8 Gen 2 for Galaxy', N'1 nhân 3.36 GHz, 4 nhân 2.8 GHz & 3 nhân 2 GHz', N'Adreno 740', N'12 GB', N'512 GB', N'Hỗ trợ 5G', N'2 Nano SIM hoặc 1 Nano SIM + 1 eSIM', N'Dual-band (2.4 GHz/5 GHz), Wi-Fi MIMO, Wi-Fi 802.11 a/b/g/n/ac/ax', N'Type-C', N'4400 mAh', N'Li-Po', N'25 W', N'Mở khoá vân tay cạnh viền, Mở khoá khuôn mặt', N'Chế độ đơn giản (Giao diện đơn giản), Chặn cuộc gọi, Chặn tin nhắn, Chạm 2 lần tắt/sáng màn hình, Trợ lý ảo Google Assistant', N'IPX8', N'Nguyên khối', N'Khung nhôm & Mặt lưng kính cường lực', N'Dài 154.9 mm - Ngang 129.9 mm - Dày 6.1 mm - Nặng 253 g', 18, '2023-07-01'),
(18, N'Chính 7.6" & Phụ 6.2"', N'Dynamic AMOLED 2X', N'Chính: QXGA+ (2176 x 1812 Pixels) & Phụ: HD+ (2316 x 904 Pixels)', N'Chính: Ultra Thin Glass & Phụ: Corning Gorilla Glass Victus 2', N'120 Hz', N'Chính 50 MP & Phụ 12 MP, 10 MP', N'HD 720p@30fps, FullHD 1080p@30fps, HD 720p@60fps, 4K 2160p@30fps, 4K 2160p@60fps, 8K 4320p@30fps', N'10 MP & 4 MPP', N'Trôi nhanh thời gian (Time Lapse), Góc siêu rộng (Ultrawide), Zoom kỹ thuật số, Góc rộng (Wide), FlexCam, Quay chậm (Slow Motion), Xóa phông, Toàn cảnh (Panorama), Chống rung quang học (OIS), Ban đêm (Night Mode), Chuyên nghiệp (Pro), HDR, Zoom quang học, Quay Siêu chậm (Super Slow Motion), Làm đẹp, Hiệu ứng Bokeh, Bộ lọc màu', N'Android 13', N'Snapdragon 8 Gen 2 for Galaxy', N'1 nhân 3.36 GHz, 4 nhân 2.8 GHz & 3 nhân 2 GHz', N'Adreno 740', N'12 GB', N'1TB', N'Hỗ trợ 5G', N'2 Nano SIM hoặc 1 Nano SIM + 1 eSIM', N'Dual-band (2.4 GHz/5 GHz), Wi-Fi MIMO, Wi-Fi 802.11 a/b/g/n/ac/ax', N'Type-C', N'4400 mAh', N'Li-Po', N'25 W', N'Mở khoá vân tay cạnh viền, Mở khoá khuôn mặt', N'Chế độ đơn giản (Giao diện đơn giản), Chặn cuộc gọi, Chặn tin nhắn, Chạm 2 lần tắt/sáng màn hình, Trợ lý ảo Google Assistant', N'IPX8', N'Nguyên khối', N'Khung nhôm & Mặt lưng kính cường lực', N'Dài 154.9 mm - Ngang 129.9 mm - Dày 6.1 mm - Nặng 253 g', 18, '2023-07-01'),
(19, N'Chính 6.7" & Phụ 1.9"', N'Chính: Dynamic AMOLED 2X, Phụ: Super AMOLED', N'Chính: FHD+ (2640 x 1080 Pixels) x Phụ: (260 x 512 Pixels)', N'Chính: Ultra Thin Glass & Phụ: Corning Gorilla Glass Victus+', N'120 Hz', N'2 camera 12 MP', N'HD 720p@30fps, FullHD 1080p@30fps, HD 720p@60fps, 4K 2160p@30fps, 4K 2160p@60fps', N'10 MP', N'Trôi nhanh thời gian (Time Lapse), Góc siêu rộng (Ultrawide), Zoom kỹ thuật số, Góc rộng (Wide), FlexCam, Quay chậm (Slow Motion), Xóa phông, Toàn cảnh (Panorama), Chống rung quang học (OIS), Ban đêm (Night Mode), Chuyên nghiệp (Pro), HDR, Zoom quang học, Quay Siêu chậm (Super Slow Motion), Làm đẹp, Hiệu ứng Bokeh, Bộ lọc màu', N'Android 12', N'Snapdragon 8+ Gen 1 8 nhân', N'1 nhân 3.18 GHz, 3 nhân 2.7 GHz & 4 nhân 2 GHz', N'Adreno 670', N'8 GB', N'128 GB', N'Hỗ trợ 5G', N'1 Nano SIM & 1 eSIM', N'Dual-band (2.4 GHz/5 GHz), Wi-Fi MIMO, Wi-Fi 802.11 a/b/g/n/ac/ax', N'Type-C', N'3700 mAh', N'Li-Ion', N'25 W', N'Mở khoá vân tay cạnh viền, Mở khoá khuôn mặt', N'Chế độ đơn giản (Giao diện đơn giản), Chặn cuộc gọi, Chặn tin nhắn, Chạm 2 lần tắt/sáng màn hình, Trợ lý ảo Google Assistant', N'IPX8', N'Nguyên khối', N'Khung nhôm & Mặt lưng kính cường lực', N'Dài 165.2 mm - Ngang 71.9 mm - Dày 6.9 mm - Nặng 187 g', 12, '2022-08-01'),
(20, N'Chính 6.7" & Phụ 1.9"', N'Chính: Dynamic AMOLED 2X, Phụ: Super AMOLED', N'Chính: FHD+ (2640 x 1080 Pixels) x Phụ: (260 x 512 Pixels)', N'Chính: Ultra Thin Glass & Phụ: Corning Gorilla Glass Victus+', N'120 Hz', N'2 camera 12 MP', N'HD 720p@30fps, FullHD 1080p@30fps, HD 720p@60fps, 4K 2160p@30fps, 4K 2160p@60fps', N'10 MP', N'Trôi nhanh thời gian (Time Lapse), Góc siêu rộng (Ultrawide), Zoom kỹ thuật số, Góc rộng (Wide), FlexCam, Quay chậm (Slow Motion), Xóa phông, Toàn cảnh (Panorama), Chống rung quang học (OIS), Ban đêm (Night Mode), Chuyên nghiệp (Pro), HDR, Zoom quang học, Quay Siêu chậm (Super Slow Motion), Làm đẹp, Hiệu ứng Bokeh, Bộ lọc màu', N'Android 12', N'Snapdragon 8+ Gen 1 8 nhân', N'1 nhân 3.18 GHz, 3 nhân 2.7 GHz & 4 nhân 2 GHz', N'Adreno 670', N'8 GB', N'256 GB', N'Hỗ trợ 5G', N'1 Nano SIM & 1 eSIM', N'Dual-band (2.4 GHz/5 GHz), Wi-Fi MIMO, Wi-Fi 802.11 a/b/g/n/ac/ax', N'Type-C', N'3700 mAh', N'Li-Ion', N'25 W', N'Mở khoá vân tay cạnh viền, Mở khoá khuôn mặt', N'Chế độ đơn giản (Giao diện đơn giản), Chặn cuộc gọi, Chặn tin nhắn, Chạm 2 lần tắt/sáng màn hình, Trợ lý ảo Google Assistant', N'IPX8', N'Nguyên khối', N'Khung nhôm & Mặt lưng kính cường lực', N'Dài 165.2 mm - Ngang 71.9 mm - Dày 6.9 mm - Nặng 187 g', 12, '2022-08-01'),
(21, N'Chính 6.7" & Phụ 1.9"', N'Chính: Dynamic AMOLED 2X, Phụ: Super AMOLED', N'Chính: FHD+ (2640 x 1080 Pixels) x Phụ: (260 x 512 Pixels)', N'Chính: Ultra Thin Glass & Phụ: Corning Gorilla Glass Victus+', N'120 Hz', N'2 camera 12 MP', N'HD 720p@30fps, FullHD 1080p@30fps, HD 720p@60fps, 4K 2160p@30fps, 4K 2160p@60fps', N'10 MP', N'Trôi nhanh thời gian (Time Lapse), Góc siêu rộng (Ultrawide), Zoom kỹ thuật số, Góc rộng (Wide), FlexCam, Quay chậm (Slow Motion), Xóa phông, Toàn cảnh (Panorama), Chống rung quang học (OIS), Ban đêm (Night Mode), Chuyên nghiệp (Pro), HDR, Zoom quang học, Quay Siêu chậm (Super Slow Motion), Làm đẹp, Hiệu ứng Bokeh, Bộ lọc màu', N'Android 12', N'Snapdragon 8+ Gen 1 8 nhân', N'1 nhân 3.18 GHz, 3 nhân 2.7 GHz & 4 nhân 2 GHz', N'Adreno 670', N'8 GB', N'512 GB', N'Hỗ trợ 5G', N'1 Nano SIM & 1 eSIM', N'Dual-band (2.4 GHz/5 GHz), Wi-Fi MIMO, Wi-Fi 802.11 a/b/g/n/ac/ax', N'Type-C', N'3700 mAh', N'Li-Ion', N'25 W', N'Mở khoá vân tay cạnh viền, Mở khoá khuôn mặt', N'Chế độ đơn giản (Giao diện đơn giản), Chặn cuộc gọi, Chặn tin nhắn, Chạm 2 lần tắt/sáng màn hình, Trợ lý ảo Google Assistant', N'IPX8', N'Nguyên khối', N'Khung nhôm & Mặt lưng kính cường lực', N'Dài 165.2 mm - Ngang 71.9 mm - Dày 6.9 mm - Nặng 187 g', 12, '2022-08-01'),
(22, N'6.28"', N'AMOLED', N'Full HD+ (1080 x 2400 Pixels)', N'Kính cường lực Corning Gorilla Glass Victus', N'120 Hz', N'Chính 50 MP & Phụ 13 MP, 5 MP', N'HD 720p@30fps, FullHD 1080p@30fps, HD 720p@60fps, 4K 2160p@30fps, 4K 2160p@60fps, 8K 4320p@24fps', N'32 MP', N'Trôi nhanh thời gian (Time Lapse), Góc siêu rộng (Ultrawide), Zoom kỹ thuật số, Góc rộng (Wide), FlexCam, Quay chậm (Slow Motion), Xóa phông, Toàn cảnh (Panorama), Chống rung quang học (OIS), Ban đêm (Night Mode), Chuyên nghiệp (Pro), HDR, Zoom quang học, Quay Siêu chậm (Super Slow Motion), Làm đẹp, Hiệu ứng Bokeh, Bộ lọc màu', N'Android 12', N'Snapdragon 8+ Gen 1 8 nhân', N'1 nhân 3 GHz, 3 nhân 2.5 GHz & 4 nhân 1.79 GHz', N'Adreno 730', N'8 GB', N'256 GB', N'Hỗ trợ 5G', N'2 Nano SIM', N'Dual-band (2.4 GHz/5 GHz), Wi-Fi MIMO, Wi-Fi 802.11 a/b/g/n/ac/ax', N'Type-C', N'4500 mAh', N'Li-Ion', N'67 W', N'Mở khoá vân tay cạnh viền, Mở khoá khuôn mặt', N'Công nghệ tản nhiệt LiquidCool, Màn hình luôn hiển thị AOD, Âm thanh Dolby Atmos, Chạm 2 lần tắt/sáng màn hình, Đa cửa sổ (chia đôi màn hình), Âm thanh bởi Harman Kardon, Loa kép', N'Không có', N'Nguyên khối', N'Khung kim loại & Mặt lưng kính', N'Dài 152.7 mm - Ngang 69.9 mm - Dày 8.2 mm - Nặng 180 g', 12, '2022-03-01'),
(23, N'6.43"', N'AMOLED', N'Full HD+ (1080 x 2400 Pixels)', N'Kính cường lực Corning Gorilla Glass 3', N'90 Hz', N'Chính 108 MP & Phụ 8 MP, 2 MP', N'HD 720p@30fpsFullHD 1080p@30fps', N'16 MP', N'Trôi nhanh thời gian (Time Lapse), Góc siêu rộng (Ultrawide), Zoom kỹ thuật số, Góc rộng (Wide), FlexCam, Quay chậm (Slow Motion), Xóa phông, Toàn cảnh (Panorama), Chống rung quang học (OIS), Ban đêm (Night Mode), Quay Siêu chậm (Super Slow Motion), Làm đẹp, Hiệu ứng Bokeh, Bộ lọc màu', N'Android 13', N'MediaTek Helio G96 8 nhân', N'2 nhân 2.05 GHz & 6 nhân 2.0 GHz', N'Mali-G57 MC2', N'8 GB', N'256 GB', N'Hỗ trợ 4G', N'2 Nano SIM', N'Dual-band (2.4 GHz/5 GHz), Wi-Fi MIMO, Wi-Fi 802.11 a/b/g/n/ac/ax', N'Type-C', N'5000 mAh', N'Li-Po', N'33 W', N'Mở khoá vân tay cạnh viền, Mở khoá khuôn mặt', N'Công nghệ tản nhiệt LiquidCool, Màn hình luôn hiển thị AOD, Âm thanh Dolby Atmos, Chạm 2 lần tắt/sáng màn hình, Đa cửa sổ (chia đôi màn hình), Âm thanh bởi Harman Kardon, Loa kép', N'Không có', N'Nguyên khối', N'Khung nhựa & Mặt lưng kính', N'Dài 159.87 mm - Ngang 73.87 mm - Dày 8.09 mm - Nặng 176 g', 12, '2023-05-01'),
(24, N'6.67"', N'AMOLED', N'Full HD+ (1080 x 2400 Pixels)', N'Kính cường lực Corning Gorilla Glass 5', N'120 Hz', N'Chính 108 MP & Phụ 8 MP, 2 MP, 2 MP', N'HD 720p@30fpsFullHD 1080p@30fps, 4K 2160p@30fps', N'16 MP', N'Trôi nhanh thời gian (Time Lapse), Góc siêu rộng (Ultrawide), Zoom kỹ thuật số, Góc rộng (Wide), FlexCam, Quay chậm (Slow Motion), Xóa phông, Toàn cảnh (Panorama), Chống rung quang học (OIS), Ban đêm (Night Mode), Quay Siêu chậm (Super Slow Motion), Làm đẹp, Hiệu ứng Bokeh, Bộ lọc màu', N'Android 11', N'Snapdragon 732G 8 nhân', N'2.3 GHz', N'Adreno 618', N'8 GB', N'128 GB', N'Hỗ trợ 4G', N'2 Nano SIM (SIM 2 chung khe thẻ nhớ)', N'Dual-band (2.4 GHz/5 GHz), Wi-Fi MIMO, Wi-Fi 802.11 a/b/g/n/ac/ax', N'Type-C', N'5000 mAh', N'Li-Po', N'67 W', N'Mở khoá vân tay cạnh viền, Mở khoá khuôn mặt', N'Công nghệ tản nhiệt LiquidCool, Màn hình luôn hiển thị AOD, Âm thanh Dolby Atmos, Chạm 2 lần tắt/sáng màn hình, Đa cửa sổ (chia đôi màn hình), Âm thanh bởi Harman Kardon, Loa kép', N'IP53', N'Nguyên khối', N'Khung nhựa & Mặt lưng kính', N'Dài 164.2 mm - Ngang 76.1 mm - Dày 8.12 mm - Nặng 201.8 g', 12, '2023-05-01');

INSERT INTO MAU(TenMau) VALUES
(N'Vàng'),
(N'Bạc'),
(N'Đen'),
(N'Trắng'),
(N'Tím'),
(N'Đỏ'),
(N'Xanh'),
(N'Xám'), 
(N'Hồng'),
(N'Cam');

INSERT INTO SANPHAM_MAU(MaSP, SoLuongTon, MaMau) VALUES
(1, 10, 5), 
(1,10, 1),
(2,10, 5),
(2,10, 1),
(3,10, 5),
(3,10, 1),
(4,10, 5),
(4,10, 1),
(5,10, 1),
(5,10, 4),
(6,10, 1),
(6,10, 4),
(7,10, 1),
(7,10, 4),
(8,10, 1),
(8,10, 2),
(9,10, 1),
(9,10, 2),
(10,10, 5),
(10,10, 3),
(11,10, 8),
(11,10, 5),
(12,10, 3),
(12,10, 7),
(13,10, 7),
(13,10, 3),
(14,10, 3),
(14,10, 5),
(15,10, 5),
(15,10, 3),
(16,10, 7),
(16,10, 3),
(17,10, 7),
(17,10, 3),
(18,10, 7),
(18,10, 3),
(19,10, 5),
(19,10, 3),
(20,10, 5),
(20,10, 3),
(21,10, 5),
(21,10, 3),
(22,10, 8),
(22,10, 5),
(23,10, 3),
(23,10, 7),
(24,10, 8),
(24,10, 7);
