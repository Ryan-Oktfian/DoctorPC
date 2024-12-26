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
