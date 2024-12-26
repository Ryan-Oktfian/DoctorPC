INSERT INTO SERVICEIT.USER (USERNAME, PASSWORD) VALUES
('Naufal', 'naufalarsa'),
('Ryan', 'ryan123'),
('Ryan', 'ryan123'),
('Hal', 'hal123'),
('Arvin', 'arvin123'),
('Alam', 'alam123');

INSERT INTO SERVICEIT.CATEGORY (NAMA_CATEGORY) VALUES
('Laptop'),
('PC Desktop'),
('Gadget');

INSERT INTO SERCVICEIT.SUPPLY (ID_BARANG, NAMA_SUPPLY, STOK_SUPPLY, HARGA_SUPPLY, ID_CATEGORY, GAMBAR_SUPPLY) VALUES
(1, 'Keyboard', 50, 250000, 2, 'https://img.freepik.com/free-photo/top-view-keyboard-mouse-arrangement_23-2149386333.jpg?w=740&t=st=1702389410~exp=1702390010~hmac=a651569ebdf0b29550c2a0510b9d19fa302729155fe67a13c696d2dd0cfd3e68'),
(2, 'Mouse', 75, 150000, 2, 'https://img.freepik.com/free-photo/shiny-blue-computer-mouse-modern-business-generated-by-ai_188544-27391.jpg?t=st=1702389514~exp=1702393114~hmac=1d8ff2d797fd017d9a56aaf995e922365325504b35f60768d29af776ab737543&w=826'),
(3, 'Monitor', 20, 1500000, 2, 'https://img.freepik.com/free-psd/helmet-mock-up_1310-159.jpg?w=740&t=st=1702389981~exp=1702390581~hmac=65eceaa6c7b90b48fbc3f66433de2191921dfe9daa829f16a0927c24ce3e4779'),
(4, 'Printer', 30, 800000, 3, 'https://img.freepik.com/free-photo/printer-with-white-sheets_1232-570.jpg?w=740&t=st=1702391005~exp=1702391605~hmac=ee2c85f1b158db317897a9888d683ba3044f2ef83d460e57a4c6d7f7920a4de5'),
(5, 'Headset', 40, 30000, 3, 'https://img.freepik.com/free-vector/wireless-headphones-set_1284-20423.jpg?w=740&t=st=1702390094~exp=1702390694~hmac=d010d454ffdce568c0b4d796d52e0896086cdb71e275aa850dca4273f460086a'),
(6, 'Laptop Sleeve', 50, 200000, 1, 'https://img.freepik.com/free-photo/mock-up-book_74190-1163.jpg?w=740&t=st=1702382713~exp=1702383313~hmac=67b30df1f4696a0eed631d70d04f74dd0f033a856dce042e71f5f6c7939d15bd'),
(7, 'Cooling Pad', 75, 175000, 1, 'https://s0.bukalapak.com/uploads/attachment/73924/Cooling_Pad_Laptop_-_DeepCool_Multi_Core_X6.jpg'),
(8, 'Screen Protector', 20, 100000, 1, 'https://m.media-amazon.com/images/I/61kv-i0Dv6L._AC_UF894,1000_QL80_.jpg'),
(9, 'Keyboard Skin Cover', 30, 80000, 1, 'https://images.hindustantimes.com/img/2022/02/21/1600x900/keyboard_protector_skin_cover_1645448069841_1645448084625.jpg'),
(10, 'Battery', 40, 750000, 1, 'https://id-media.apjonlinecdn.com/wysiwyg/blog/laptop-battery.jpg'),
(11, 'Tempered Glass', 50, 60000, 3, 'https://cdn.topsellbelanja.com/wp-content/uploads/2022/10/4-Jenis-Tempered-Glass-HP-Wajib-Tahu-Sebelum-Membeli-1536x768-1.webp'),
(12, 'Case', 30, 100000, 3, 'https://asset-2.tstatic.net/shopping/foto/bank/images/melepas-case-hp.jpg'),
(13, 'Power Bank', 20, 250000, 3, 'https://cdn.idntimes.com/content-images/community/2019/03/portable-chargers-update-1-3b14251a75207b1c09d7ca6209bdf0e3.jpg'),
(14, 'Phone Holder', 30, 75000, 3, 'https://hips.hearstapps.com/hmg-prod/images/ghi-carphoneholders-1671783491.png'),
(15, 'SSD 512GB', 30, 450000, 1, 'https://cdn11.bigcommerce.com/s-qfzamxn9kz/images/stencil/1280x1280/products/336108/383295/512GB-2282-SATA-MICRON__64748.1565196924.jpg?c=2'),
(16, 'RAM 4GB DDR4', 75, 400000, 2, 'https://i.pinimg.com/564x/99/83/ef/9983efee6324953d15c4c80fcbc10c8d.jpg'),
(17, 'PC Case', 20, 1500000, 2, 'https://storage-asset.msi.com/global/picture/news/2019/case/case-sizes.jpg'),
(18, 'Power Supply', 30, 700000, 2, 'https://caraguna.com/wp-content/uploads/2022/02/power-supply.jpg'),
(19, 'Processor Intel i9', 40, 10000000, 2, 'https://www.cined.com/content/uploads/2017/05/Intel-core-i9.jpg'),
(20, 'Processor AMD Ryzen 9', 30, 700000, 2, 'https://img.4gamers.com.tw/news-image/cb36b6c0-d54a-4150-9588-26179aa08975.jpg');

INSERT INTO SERVICEIT.MECHANIC (NAMA_MECHANIC, KONTAK_MECHANIC) VALUES
('John Doe', '+62 812-3456-7890'),
('Jane Smith', '+62 878-6543-2109'),
('Bob Johnson', '+62 813-1234-5678'),
('Alice Williams', '+62 899-8887-7776'),
('Charlie Brown', '+62 811-2223-3344');

INSERT INTO SERVICEIT.SERVICE (NAMA_PELANGGAN, KONTAK_PELANGGAN, MERK_DEVICE, STATUS_SERVICE, DESKRIPSI, ID_MECHANIC) VALUES
('Eva Rodriguez', '+62 822-5555-6666', 'Laptop ASUS ROG', 'Selesai', 'Charging problem', 1),
('Ahmad Malik', '+62 877-9876-5432', 'Printer EPSON', 'Selesai', 'Focus calibration', 2),
('Sophie Chen', '+62 888-1111-2222', 'Laptop HP', 'On Progress', 'No sound issue', 3),
('Muhammad Ali', '+62 899-3333-4444', 'Laptop Acer', 'Selesai', 'Display glitch', 1),
('Aisha Gupta', '+62 811-7777-8888', 'Macbook Air M1', 'On Progress', 'Connection stability', 4);

INSERT INTO SERVICEIT.TRANSAKSI (TOTAL_HARGA, ID_SERVICE) VALUES
(150000, 1),
(50000, 2),
(100000, 3),
(75000, 4),
(200000, 5);

