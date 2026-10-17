<?php
class BukuController
{
    public function __construct(private Buku $model) {}

    public function index(): void
    {
        $daftarBuku = $this->model->findAll();
        $pesan = $_SESSION['feedback'] ?? null;
        unset($_SESSION['feedback']);
        require __DIR__ . '/../views/buku/index.php';
    }

    public function create(): void
    {
        $pesan = $_SESSION['feedback'] ?? null;
        unset($_SESSION['feedback']);
        require __DIR__ . '/../views/buku/create.php';
    }

    public function store(): void
    {
        try {
            $input = $this->sanitizeAndValidate($_POST);
            $this->model->create($input);
            $_SESSION['feedback'] = ['tipe' => 'sukses', 'konten' => 'Buku baru berhasil didaftarkan!'];
            header('Location: index.php?page=buku');
            exit;
        } catch (Exception $e) {
            $_SESSION['feedback'] = ['tipe' => 'gagal', 'konten' => $e->getMessage()];
            header('Location: index.php?page=buku&action=create');
            exit;
        }
    }

    public function edit(): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        $buku = $this->model->findById($id);
        if (!$buku) {
            http_response_code(404);
            exit('Buku tidak ditemukan.');
        }

        $pesan = $_SESSION['feedback'] ?? null;
        unset($_SESSION['feedback']);
        require __DIR__ . '/../views/buku/edit.php';
    }

    public function update(): void
    {
        $id = (int) ($_POST['id'] ?? 0);
        try {
            $input = $this->sanitizeAndValidate($_POST);
            $this->model->update($id, $input);
            $_SESSION['feedback'] = ['tipe' => 'sukses', 'konten' => 'Data buku sukses diperbarui!'];
            header('Location: index.php?page=buku');
            exit;
        } catch (Exception $e) {
            $_SESSION['feedback'] = ['tipe' => 'gagal', 'konten' => $e->getMessage()];
            header('Location: index.php?page=buku&action=edit&id=' . $id);
            exit;
        }
    }

    public function delete(): void
    {
        $id = (int) ($_POST['id'] ?? 0);
        if ($this->model->delete($id)) {
            $_SESSION['feedback'] = ['tipe' => 'sukses', 'konten' => 'Buku berhasil dihapus dari sistem.'];
        } else {
            $_SESSION['feedback'] = ['tipe' => 'gagal', 'konten' => 'Terjadi kesalahan saat menghapus buku.'];
        }
        header('Location: index.php?page=buku');
        exit;
    }

    private function sanitizeAndValidate(array $src): array
    {
        $clean = [
            'isbn'         => trim($src['isbn'] ?? ''),
            'judul'        => trim($src['judul'] ?? ''),
            'pengarang'    => trim($src['pengarang'] ?? ''),
            'kategori'     => trim($src['kategori'] ?? ''),
            'tahun_terbit' => (int) ($src['tahun_terbit'] ?? 0),
            'harga'        => (int) ($src['harga'] ?? 0)
        ];

        if (empty($clean['isbn']) || empty($clean['judul']) || empty($clean['pengarang']) || empty($clean['kategori'])) {
            throw new Exception('Harap melengkapi seluruh formulir buku.');
        }
        if ($clean['tahun_terbit'] < 1900 || $clean['tahun_terbit'] > (int)date('Y') + 1) {
            throw new Exception('Tahun terbit tidak masuk akal.');
        }
        if ($clean['harga'] < 0) {
            throw new Exception('Harga buku tidak boleh negatif.');
        }

        return $clean;
    }
}