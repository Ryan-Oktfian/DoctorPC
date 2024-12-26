CREATE SCHEMA SERVICEIT;

CREATE TABLE SERVICEIT.USER
(
    ID_USER INT PRIMARY KEY AUTO_INCREMENT,
    USERNAME VARCHAR(255) NOT NULL,
    PASSWORD VARCHAR(255) NOT NULL
);

CREATE TABLE SERVICEIT.CATEGORY (
  ID_CATEGORY smallint(6) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  NAMA_CATEGORY varchar(255) NOT NULL
);

CREATE TABLE SERVICEIT.SUPPLY
(
    ID_BARANG INT PRIMARY KEY AUTO_INCREMENT,
    NAMA_SUPPLY VARCHAR(255) NOT NULL,
    STOK_SUPPLY INT NOT NULL,
    HARGA_SUPPLY INT NOT NULL,
    ID_CATEGORY SMALLINT,
    GAMBAR_SUPPLY TEXT NOT NULL,
    FOREIGN KEY (ID_CATEGORY) 
    REFERENCES SERVICEIT.CATEGORY(ID_CATEGORY)
);

CREATE TABLE SERVICEIT.MECHANIC
(
    ID_MECHANIC INT PRIMARY KEY AUTO_INCREMENT,
    NAMA_MECHANIC VARCHAR(255) NOT NULL,
    KONTAK_MECHANIC VARCHAR(255) NOT NULL
);

CREATE TABLE SERVICEIT.SERVICE
(
    ID_SERVICE INT PRIMARY KEY AUTO_INCREMENT,
    NAMA_PELANGGAN VARCHAR(255) NOT NULL,
    KONTAK_PELANGGAN VARCHAR(255) NOT NULL,
    MERK_DEVICE VARCHAR(100) NOT NULL,
    STATUS_SERVICE VARCHAR(20) NOT NULL,
    DESKRIPSI VARCHAR(255) NOT NULL,
    ID_MECHANIC INT,
    FOREIGN KEY (ID_MECHANIC) 
    REFERENCES SERVICEIT.MECHANIC(ID_MECHANIC)
);

CREATE TABLE SERVICEIT.TRANSAKSI
(
ID_TRANSAKSI INT PRIMARY KEY AUTO_INCREMENT,
TOTAL_HARGA INT NOT NULL,
ID_SERVICE INT,
FOREIGN KEY (ID_SERVICE)
REFERENCES SERVICEIT.SERVICE(ID_SERVICE)
);

-- MEMBUAT TABEL SPECIALIST
CREATE TABLE serviceit.specialist(
    ID_SPECIALIST smallint(6) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    NAMA_SPECIALIST varchar(255) NOT NULL
);

-- INPUT DATA PADA TABEL SPECIALIST
INSERT INTO serviceit.specialist (NAMA_SPECIALIST)
VALUES ('Laptop Hardware Specialist'),
       ('Desktop Hardware Specialist'),
       ('Windows Software Specialist'),
       ('Mac Software Specialist'),
       ('Linux Software Specialist'),
       ('Gadget Specialist');

-- ADD ID_SPECIALIST DI TABEL MECHANIC
ALTER TABLE serviceit.mechanic ADD ID_SPECIALIST smallint(6);

-- ADD FOREIGN KEY KE ID_SPECIALIST DI TABEL MECHANIC
ALTER TABLE serviceit.mechanic
    ADD FOREIGN KEY (ID_SPECIALIST) REFERENCES serviceit.specialist (ID_SPECIALIST);

-- ADD KOLOM NOTE (buat bedakan yg udah jadi mekanik sama yg masih applicant)
ALTER TABLE serviceit.mechanic ADD NOTE varchar(255);

CREATE TABLE reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    review TEXT,
    FOREIGN KEY (user_id) REFERENCES USER(ID_USER)
);

-- Buat stored procedure untuk menambahkan mekanik baru
DELIMITER //
CREATE PROCEDURE SERVICEIT.TambahMekanik(
    IN namaMekanik VARCHAR(255),
    IN kontakMekanik VARCHAR(255)
)
BEGIN
    INSERT INTO SERVICEIT.MECHANIC (NAMA_MECHANIC, KONTAK_MECHANIC)
    VALUES (namaMekanik, kontakMekanik);
END //
DELIMITER ;


-- Buat stored procedure untuk menambahkan supply baru
DELIMITER //
CREATE PROCEDURE SERVICEIT.TambahSupply(
    IN namaSupply VARCHAR(255),
    IN stokSupply INT,
    IN hargaSupply INT
)
BEGIN
    INSERT INTO SERVICEIT.SUPPLY (NAMA_SUPPLY, STOK_SUPPLY, HARGA_SUPPLY)
    VALUES (namaSupply, stokSupply, hargaSupply);
END //
DELIMITER ;

-- Tambahkan mekanik baru
-- CALL TambahMekanik('John Doe', '123-456-7890');

-- Tambahkan supply baru
-- CALL TambahSupply('Filter Oli', 50, 10);

-- Buat stored procedure untuk menambahkan layanan baru
DELIMITER //
CREATE PROCEDURE SERVICEIT.TambahService(
    IN namaPelanggan VARCHAR(255),
    IN kontakPelanggan VARCHAR(255),
    IN merkDevice VARCHAR(100),
    IN statusService VARCHAR(20),
    IN deskripsi VARCHAR(255),
    IN idMekanik INT
)
BEGIN
    INSERT INTO SERVICEIT.SERVICE (NAMA_PELANGGAN, KONTAK_PELANGGAN, MERK_DEVICE, STATUS_SERVICE, DESKRIPSI, ID_MECHANIC)
    VALUES (namaPelanggan, kontakPelanggan, merkDevice, statusService, deskripsi, idMekanik);
END //
DELIMITER ;

-- Buat stored procedure untuk menambahkan transaksi baru
DELIMITER //
CREATE PROCEDURE SERVICEIT.TambahTransaksi(
    IN totalHarga INT,
    IN idService INT
)
BEGIN
    INSERT INTO SERVICEIT.TRANSAKSI (TOTAL_HARGA, ID_SERVICE)
    VALUES (totalHarga, idService);
END //
DELIMITER ;

-- Tambahkan layanan baru
-- CALL TambahLayanan('Nama Pelanggan', '123-456-7890', 'Merk Device', 'Status Layanan', 'Deskripsi Layanan', 1);
-- Tambahkan transaksi baru
-- CALL TambahTransaksi(100, 1);

-- Stored procedure untuk menghapus transaksi berdasarkan ID_TRANSAKSI
DELIMITER //
CREATE PROCEDURE SERVICEIT.HapusTransaksi(
    IN idTransaksi INT
)
BEGIN
    DELETE FROM SERVICEIT.TRANSAKSI WHERE ID_TRANSAKSI = idTransaksi;
END //
DELIMITER ;

-- Stored procedure untuk menghapus layanan berdasarkan ID_SERVICE
DELIMITER //
CREATE PROCEDURE SERVICEIT.HapusService(
    IN idService INT
)
BEGIN
    DELETE FROM SERVICEIT.SERVICE WHERE ID_SERVICE = idService;
END //
DELIMITER ;

-- Stored procedure untuk menghapus persediaan (supply) berdasarkan ID_BARANG
DELIMITER //
CREATE PROCEDURE SERVICEIT.HapusSupply(
    IN idSupply INT
)
BEGIN
    DELETE FROM SERVICEIT.SUPPLY WHERE ID_BARANG = idSupply;
END //
DELIMITER ;

-- Stored procedure untuk menghapus mekanik berdasarkan ID_MECHANIC
DELIMITER //
CREATE PROCEDURE SERVICEIT.HapusMekanik(
    IN idMekanik INT
)
BEGIN
    DELETE FROM SERVICEIT.MECHANIC WHERE ID_MECHANIC = idMekanik;
END //
DELIMITER ;

-- Hapus transaksi berdasarkan ID_TRANSAKSI
-- CALL HapusTransaksi(1);
-- Hapus layanan berdasarkan ID_SERVICE
-- CALL HapusLayanan(1);
-- Hapus persediaan berdasarkan ID_BARANG
-- CALL HapusPersediaan(1);
-- Hapus mekanik berdasarkan ID_MECHANIC
-- CALL HapusMekanik(1);

-- Stored procedure untuk mengedit transaksi berdasarkan ID_TRANSAKSI
DELIMITER //
CREATE PROCEDURE SERVICEIT.EditTransaksi(
    IN idTransaksi INT,
    IN totalHargaBaru INT
)
BEGIN
    UPDATE SERVICEIT.TRANSAKSI
    SET TOTAL_HARGA = totalHargaBaru
    WHERE ID_TRANSAKSI = idTransaksi;
END //
DELIMITER ;

-- Stored procedure untuk mengedit layanan berdasarkan ID_SERVICE
DELIMITER //
CREATE PROCEDURE SERVICEIT.EditService(
    IN idService INT,
    IN namaPelangganBaru VARCHAR(255),
    IN kontakPelangganBaru VARCHAR(255),
    IN merkDeviceBaru VARCHAR(100),
    IN statusServiceBaru VARCHAR(20),
    IN deskripsiBaru VARCHAR(255),
    IN idMekanikBaru INT
)
BEGIN
    UPDATE SERVICEIT.SERVICE
    SET NAMA_PELANGGAN = namaPelangganBaru,
        KONTAK_PELANGGAN = kontakPelangganBaru,
        MERK_DEVICE = merkDeviceBaru,
        STATUS_SERVICE = statusServiceBaru,
        DESKRIPSI = deskripsiBaru,
        ID_MECHANIC = idMekanikBaru
    WHERE ID_SERVICE = idService;
END //
DELIMITER ;

-- Stored procedure untuk mengedit persediaan (supply) berdasarkan ID_BARANG
DELIMITER //
CREATE PROCEDURE SERVICEIT.EditSupply(
    IN idSupply INT,
    IN namaSupplyBaru VARCHAR(255),
    IN stokSupplyBaru INT,
    IN hargaSupplyBaru INT
)
BEGIN
    UPDATE SERVICEIT.SUPPLY
    SET NAMA_SUPPLY = namaSupplyBaru,
        STOK_SUPPLY = stokSupplyBaru,
        HARGA_SUPPLY = hargaSupplyBaru
    WHERE ID_BARANG = idSupply;
END //
DELIMITER ;

-- Stored procedure untuk mengedit mekanik berdasarkan ID_MECHANIC
DELIMITER //
CREATE PROCEDURE SERVICEIT.EditMekanik(
    IN idMekanik INT,
    IN namaMekanikBaru VARCHAR(255),
    IN kontakMekanikBaru VARCHAR(255)
)
BEGIN
    UPDATE SERVICEIT.MECHANIC
    SET NAMA_MECHANIC = namaMekanikBaru,
        KONTAK_MECHANIC = kontakMekanikBaru
    WHERE ID_MECHANIC = idMekanik;
END //
DELIMITER ;

-- Edit transaksi berdasarkan ID_TRANSAKSI
-- CALL EditTransaksi(1, 150);
-- Edit layanan berdasarkan ID_SERVICE
-- CALL EditLayanan(1, 'Nama Baru', '123-456-7890', 'Merk Baru', 'Status Baru', 'Deskripsi Baru', 2);
-- Edit persediaan berdasarkan ID_BARANG
-- CALL EditPersediaan(1, 'Supply Baru', 20, 15);
-- Edit mekanik berdasarkan ID_MECHANIC
-- CALL EditMekanik(1, 'Mekanik Baru', '987-654-3210');

DELIMITER //
CREATE PROCEDURE SERVICEIT.LihatService()
BEGIN
    SELECT * FROM SERVICEIT.SERVICE;
END //
DELIMITER ;
