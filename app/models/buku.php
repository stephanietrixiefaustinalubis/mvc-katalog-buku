<?php
class Buku
{
    public function __construct(private PDO $db) {}

    public function findAll(): array
    {
        $stmt = $this->db->query('SELECT * FROM buku ORDER BY id DESC');
        return $stmt->fetchAll();
    }

    public function findById(int $id): array|false
    {
        $stmt = $this->db->prepare('SELECT * FROM buku WHERE id = :id');
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function create(array $data): bool
    {
        $sql = 'INSERT INTO buku (isbn, judul, pengarang, kategori, tahun_terbit, harga)
                VALUES (:isbn, :judul, :pengarang, :kategori, :tahun_terbit, :harga)';
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':isbn'         => $data['isbn'],
            ':judul'        => $data['judul'],
            ':pengarang'    => $data['pengarang'],
            ':kategori'     => $data['kategori'],
            ':tahun_terbit' => $data['tahun_terbit'],
            ':harga'        => $data['harga']
        ]);
    }

    public function update(int $id, array $data): bool
    {
        $sql = 'UPDATE buku 
                SET isbn = :isbn, judul = :judul, pengarang = :pengarang, 
                    kategori = :kategori, tahun_terbit = :tahun_terbit, harga = :harga 
                WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':id'           => $id,
            ':isbn'         => $data['isbn'],
            ':judul'        => $data['judul'],
            ':pengarang'    => $data['pengarang'],
            ':kategori'     => $data['kategori'],
            ':tahun_terbit' => $data['tahun_terbit'],
            ':harga'        => $data['harga']
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM buku WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }
}