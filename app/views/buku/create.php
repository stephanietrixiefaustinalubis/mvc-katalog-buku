<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Entri Buku Baru</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="wrapper form-container">
        <div class="top-bar">
            <h1>Entri Koleksi Buku Baru</h1>
        </div>

        <?php if (!empty($pesan)): ?>
            <div class="notification notif-<?= htmlspecialchars($pesan['tipe']) ?>">
                <?= htmlspecialchars($pesan['konten']) ?>
            </div>
        <?php endif; ?>

        <form method="post" action="index.php?page=buku&action=store">
            <div class="form-item">
                <label>Nomor ISBN</label>
                <input type="text" name="isbn" class="form-input" placeholder="Misal: 978-602-xxx" required>
            </div>
            <div class="form-item">
                <label>Judul Buku</label>
                <input type="text" name="judul" class="form-input" required>
            </div>
            <div class="form-item">
                <label>Nama Pengarang</label>
                <input type="text" name="pengarang" class="form-input" required>
            </div>
            <div class="form-item">
                <label>Kategori</label>
                <select name="kategori" class="form-input" required>
                    <option value="Teknologi">Teknologi</option>
                    <option value="Sains">Sains</option>
                    <option value="Sejarah">Sejarah</option>
                    <option value="Fiksi">Fiksi</option>
                    <option value="Bisnis">Bisnis</option>
                </select>
            </div>
            <div class="form-item">
                <label>Tahun Terbit</label>
                <input type="number" name="tahun_terbit" class="form-input" min="1900" max="2099" value="<?= date('Y') ?>" required>
            </div>
            <div class="form-item">
                <label>Harga Buku (Rp)</label>
                <input type="number" name="harga" class="form-input" min="0" step="1000" placeholder="50000" required>
            </div>
            <div class="form-buttons">
                <button type="submit" class="btn-action btn-primary">Simpan Buku</button>
                <a href="index.php?page=buku" class="btn-action btn-cancel">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>