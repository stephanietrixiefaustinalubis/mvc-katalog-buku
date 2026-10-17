<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Katalog Koleksi Buku</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="wrapper">
        <div class="top-bar">
            <h1>📖 Katalog Inventaris Buku</h1>
            <a href="index.php?page=buku&action=create" class="btn-action btn-primary">+ Tambah Koleksi</a>
        </div>

        <?php if (!empty($pesan)): ?>
            <div class="notification notif-<?= htmlspecialchars($pesan['tipe']) ?>">
                <?= htmlspecialchars($pesan['konten']) ?>
            </div>
        <?php endif; ?>

        <div class="table-box">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ISBN</th>
                        <th>Judul Buku</th>
                        <th>Pengarang</th>
                        <th>Kategori</th>
                        <th>Tahun</th>
                        <th>Harga</th>
                        <th style="text-align: center;">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($daftarBuku)): ?>
                        <tr><td colspan="8" style="text-align: center; color: #94a3b8;">Belum ada koleksi buku.</td></tr>
                    <?php else: ?>
                        <?php foreach ($daftarBuku as $i => $row): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><code><?= htmlspecialchars($row['isbn']) ?></code></td>
                            <td><strong><?= htmlspecialchars($row['judul']) ?></strong></td>
                            <td><?= htmlspecialchars($row['pengarang']) ?></td>
                            <td><span class="category-tag"><?= htmlspecialchars($row['kategori']) ?></span></td>
                            <td><?= htmlspecialchars((string)$row['tahun_terbit']) ?></td>
                            <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                            <td style="text-align: center;">
                                <a href="index.php?page=buku&action=edit&id=<?= $row['id'] ?>" class="btn-action btn-edit">Edit</a>
                                <form method="post" action="index.php?page=buku&action=delete" style="display:inline;" onsubmit="return confirm('Apakah buku ini akan dihapus?')">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <button type="submit" class="btn-action btn-delete">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>