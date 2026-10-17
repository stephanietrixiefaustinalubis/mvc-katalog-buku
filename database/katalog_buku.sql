CREATE DATABASE IF NOT EXISTS db_katalog_buku
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE db_katalog_buku;

CREATE TABLE IF NOT EXISTS buku (
    id INT AUTO_INCREMENT PRIMARY KEY,
    isbn VARCHAR(25) NOT NULL UNIQUE,
    judul VARCHAR(200) NOT NULL,
    pengarang VARCHAR(120) NOT NULL,
    kategori VARCHAR(50) NOT NULL,
    tahun_terbit INT NOT NULL,
    harga INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Data Sampel Berbeda
INSERT INTO buku (isbn, judul, pengarang, kategori, tahun_terbit, harga) VALUES
('978-623-010', 'Struktur Logika & Algoritma', 'Bambang Wijaya', 'Teknologi', 2022, 95000),
('978-623-020', 'Jejak Langkah Nusantara', 'Ratna Sari', 'Sejarah', 2020, 85000),
('978-623-030', 'Kecerdasan Artifisial Terapan', 'Hendra Kusuma', 'Teknologi', 2024, 120000);