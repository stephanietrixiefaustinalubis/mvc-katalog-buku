<?php
class Database
{
    private string $host = 'localhost';
    private string $db   = 'db_katalog_buku';
    private string $user = 'root';
    private string $pass = ''; // Isi jika MySQL lokalmu memiliki password

    public function getConnection(): PDO
    {
        $dsn = "mysql:host={$this->host};dbname={$this->db};charset=utf8mb4";
        return new PDO($dsn, $this->user, $this->pass, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }
}