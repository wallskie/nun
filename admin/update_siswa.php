<?php
include '../koneksi.php';

// Pastikan `id_siswa` diterima
if (isset($_GET['id_siswa'])) {
    $id_siswa = intval($_GET['id_siswa']); // Sanitasi input

    // Query untuk mengambil data siswa
    $query = "SELECT siswa.*, angkatan.nama_angkatan, jurusan.nama_jurusan, kelas.nama_kelas
              FROM siswa
              JOIN angkatan ON siswa.id_angkatan = angkatan.id_angkatan
              JOIN jurusan ON siswa.id_jurusan = jurusan.id_jurusan
              JOIN kelas ON siswa.id_kelas = kelas.id_kelas
              WHERE siswa.id_siswa = $id_siswa";
    $result = mysqli_query($conn, $query);

    // Periksa apakah data ditemukan
    if ($result && mysqli_num_rows($result) > 0) {
        $res = mysqli_fetch_assoc($result);
    } else {
        echo "Data siswa tidak ditemukan.";
        exit;
    }
} else {
    echo "ID siswa tidak disediakan.";
    exit;
}
?>

<!-- Form Edit -->
<form action="" method="post">
    <input type="hidden" name="id_siswa" value="<?= $res['id_siswa'] ?>">

    <div class="mb-3">
        <input type="text" class="form-control" readonly value="<?= $res['nisn'] ?>" placeholder="NISN">
    </div>
    <div class="mb-3">
        <input type="text" class="form-control" readonly value="<?= $res['nama_angkatan'] ?>" placeholder="Angkatan">
    </div>
    <div class="mb-3">
        <input type="text" class="form-control" readonly value="<?= $res['nama_kelas'] ?>" placeholder="Kelas">
    </div>
    <div class="mb-3">
        <input type="text" class="form-control" readonly value="<?= $res['nama_jurusan'] ?>" placeholder="Jurusan">
    </div>
    <div class="mb-3">
        <input type="text" class="form-control" name="nama" value="<?= $res['nama'] ?>" placeholder="Nama" required>
    </div>
    <div class="mb-3">
        <input type="text" class="form-control" name="ttl" value="<?= $res['ttl'] ?>" placeholder="Tempat, Tanggal Lahir" required>
    </div>
    <div class="mb-3">
        <select class="form-select" name="jenis_kelamin" required>
            <option <?= $res['jenis_kelamin'] == 'laki-laki' ? 'selected' : '' ?> value="laki-laki">Laki-Laki</option>
            <option <?= $res['jenis_kelamin'] == 'perempuan' ? 'selected' : '' ?> value="perempuan">Perempuan</option>
        </select>
    </div>
    <div class="mb-3">
        <textarea class="form-control" name="alamat" placeholder="Alamat" required><?= $res['alamat'] ?></textarea>
    </div>
    <div class="d-grid">
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>
