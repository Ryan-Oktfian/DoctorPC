CREATE TABLE SERVICEIT.CATEGORY (
  ID_CATEGORY smallint(6) NOT NULL,
  NAMA_CATEGORY varchar(255) NOT NULL
);

-- Menambahkan data pada tabel CATEGORY
INSERT INTO SERVICEIT.category (NAMA_CATEGORY) VALUES
('Laptop'),
('PC Desktop'),
('Gadget');

-- Menambahkan data pada tabel SUPPLY
INSERT INTO SERVICEIT.supply (NAMA_SUPPLY, STOK_SUPPLY, HARGA_SUPPLY, ID_CATEGORY) VALUES
('Keyboard', 50, 250000, 2),
('Mouse', 75, 150000, 2),
('Monitor', 20, 1500000, 2),
('Printer', 30, 800000, 3),
('Headset', 40, 30000, 3),
('Laptop Sleeve', 50, 200000, 1),
('Cooling Pad', 75, 175000, 1),
('Screen Protector', 20, 100000, 1),
('Keyboard Skin Cover', 30, 80000, 1),
('Battery', 40, 750000, 1),
('Tempered Glass', 50, 60000, 3),
('Case', 30, 100000, 3),
('Power Bank', 20, 250000, 3),
('Phone Holder', 30, 75000, 3),
('SSD 512GB', 30, 450000, 1),
('RAM 4GB DDR4', 75, 400000, 2),
('PC Case', 20, 1500000, 2),
('Power Supply', 30, 700000, 2),
('Processor Intel i9', 40, 10000000, 2),
('Processor AMD Ryzen 9', 30, 700000, 2);

-- Menambahkan column ID_CATEGORY pada tabel SUPPLY
ALTER TABLE SUPPLY ADD ID_CATEGORY SMALLINT;

-- Menambahkan foreign key ID_CATEGORY pada tabel SUPPLY
ALTER TABLE SUPPLY ADD FOREIGN KEY (ID_CATEGORY) REFERENCES SERVICEIT.CATEGORY(ID_CATEGORY);
