<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Koleksi Buku</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="wrapper form-container">
        <div class="top-bar">
            <h1>Perbarui Data Buku</h1>
        </div>

        <?php if (!empty($pesan)): ?>
            <div class="notification notif-<?= htmlspecialchars($pesan['tipe']) ?>">
                <?= htmlspecialchars($pesan['konten']) ?>
            </div>
        <?php endif; ?>

        <form method="post" action="index.php?page=buku&action=update">
            <input type="hidden" name="id" value="<?= $buku['id'] ?>">

            <div class="form-item">
                <label>Nomor ISBN</label>
                <input type="text" name="isbn" class="form-input" value="<?= htmlspecialchars($buku['isbn']) ?>" required>
            </div>
            <div class="form-item">
                <label>Judul Buku</label>
                <input type="text" name="judul" class="form-input" value="<?= htmlspecialchars($buku['judul']) ?>" required>
            </div>
            <div class="form-item">
                <label>Nama Pengarang</label>
                <input type="text" name="pengarang" class="form-input" value="<?= htmlspecialchars($buku['pengarang']) ?>" required>
            </div>
            <div class="form-item">
                <label>Kategori</label>
                <select name="kategori" class="form-input" required>
                    <?php 
                    $kategoris = ['Teknologi', 'Sains', 'Sejarah', 'Fiksi', 'Bisnis'];
                    foreach ($kategoris as $kat):
                    ?>
                        <option value="<?= $kat ?>" <?= $buku['kategori'] === $kat ? 'selected' : '' ?>><?= $kat ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-item">
                <label>Tahun Terbit</label>
                <input type="number" name="tahun_terbit" class="form-input" min="1900" max="2099" value="<?= htmlspecialchars((string)$buku['tahun_terbit']) ?>" required>
            </div>
            <div class="form-item">
                <label>Harga Buku (Rp)</label>
                <input type="number" name="harga" class="form-input" min="0" step="1000" value="<?= htmlspecialchars((string)$buku['harga']) ?>" required>
            </div>
            <div class="form-buttons">
                <button type="submit" class="btn-action btn-primary">Perbarui Data</button>
                <a href="index.php?page=buku" class="btn-action btn-cancel">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>