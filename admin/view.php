
<?php include '../koneksi.php';

/*
$idku=$_POST['idku'];
echo "$id";
echo "$_GET[id]";
cek kelas sebelumnya
$cek=mysqli_query($conn,"SELECT siswa.*, angkatan.*, jurusan.*, kelas.* FROM siswa, angkatan, jurusan, kelas WHERE siswa.id_angkatan = angkatan.id_angkatan AND siswa.id_jurusan = jurusan.id_jurusan AND siswa.id_kelas = kelas.id_kelas AND siswa.id_siswa = $idku");
$res = mysqli_fetch_assoc($cek);

$hasil = implode(" ", array_slice(explode(" ", $res['nama_kelas']), 0, $jumlah));
                if($hasil == 'XII'){
                  echo "kelas 12";
                }

                if($hasil == 'XI'){
                  //maka pilihan hanya kelas 12
                  echo "kelas 11";
                }
                if($hasil == 'X'){
                  echo "kelas 10";
                }

*/
?>
<?php
// Mengambil data siswa berdasarkan id_siswa yang dikirim
if (isset($_POST['id_siswa'])) {
    $id_siswa = $_POST['id_siswa'];
    $query = "SELECT siswa.*, angkatan.*, jurusan.*, kelas.* 
              FROM siswa, angkatan, jurusan, kelas 
              WHERE siswa.id_siswa = $id_siswa";
    $exec = mysqli_query($conn, $query);
    $res = mysqli_fetch_assoc($exec);
}
?>

<form action="dt_siswa.php" method="post">
    <!-- Hidden field untuk menyimpan id_siswa dan nisn -->
    <input type="hidden" name="id_siswa" value="<?=$res['id_siswa']?>">
    <input type="hidden" name="nisn" value="<?= $res['nisn'] ?>">
    <input type="hidden" name="id_kelas" value="<?= $res['id_kelas'] ?>">



    <!-- Input untuk menampilkan nisn -->
    <input type="text" class="form-control mb-2" readonly value="<?= $res['nisn'] ?>" disabled>
    <input type="text" class="form-control mb-2" readonly value="<?= $res['nama_angkatan'] ?>" disabled>
    <input type="text" class="form-control mb-2" readonly name="" value="<?= $res['nama_kelas'] ?>" disabled>
    <input type="text" class="form-control mb-2" readonly name="" value="<?= $res['nama_jurusan'] ?>" disabled>
    <input type="text" class="form-control mb-2" required name="nama" value="<?= $res['nama'] ?>">
    <input type="text" class="form-control mb-2" required name="ttl" value="<?= $res['ttl'] ?>">
    <SELECT class="form-control mb-2" name="jenis_kelamin">
      <option selected=""><?= empty($res['jenis_kelamin']) ? 'Jenis Kelamin' : $res['jenis_kelamin']; ?></option>
      <option value="laki-laki">Laki-Laki</option>
      <option value="perempuan">Perempuan</option>
    </SELECT>
    <textarea class="form-control mb-2" required name="alamat" placeholder="Alamat Siswa"><?= $res['alamat'] ?></textarea>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="edit" class="btn btn-primary">Simpan</button>
    </div>
</form>


<?php

if(isset($_POST['kenaikan'])){
  $id_siswa= $_POST['kenaikan'];
  $query   = "SELECT siswa.*, angkatan.*, jurusan.*, kelas.* FROM siswa, angkatan, jurusan, kelas WHERE siswa.id_angkatan = angkatan.id_angkatan AND siswa.id_jurusan = jurusan.id_jurusan AND siswa.id_kelas = kelas.id_kelas AND siswa.id_siswa = $id_siswa";
  $exec = mysqli_query($conn, $query);
  $res = mysqli_fetch_assoc($exec);
  ?>

  <form action="kenaikankelas.php" method="post">
   <input type="hidden" name="id_siswa" value="<?=$res['id_siswa'] ?>">
   <select class="form-control mb-2" name="id_angkatan">
    <option selected="" > Pilih Angkatan </option>
    <?php
    $selected ="";
    $exec = mysqli_query($conn, "SELECT * FROM angkatan order by id_angkatan");
    while ($angkatan = mysqli_fetch_assoc($exec)):
      if($res['id_angkatan'] == $angkatan['id_angkatan']){
       $selected = 'selected';
     }  else{
       $selected="";
     }
     echo "<option $selected value=".$angkatan['id_angkatan'].">" .$angkatan['nama_angkatan']."</option>";
   endwhile;
   ?>
 </select>
 <select class="form-control mb-2" name="id_kelas">
  <option selected="">Pilih Kelas</option>
  <?php
  $exec = mysqli_query($conn, "SELECT * FROM kelas order by id_kelas");
  while ($angkatan = mysqli_fetch_assoc($exec)):
   if ($res['id_kelas'] == $angkatan['id_kelas']) {
    $selected = 'selected';
  }else{
    $selected = "";
    
  }
  echo "<option $selected value=".$angkatan['id_kelas'].">" .$angkatan['nama_kelas']."</option>";
endwhile; 
?>
</select>

<div class="modal-footer">
 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
 <button type="Submit" name="naik" class="btn btn-primary">Simpan</button>
</form>

<?php }?>

<?php

if(isset($_POST['id_kelas'])){
 $id_kelas	= $_POST['id_kelas'];
 $exec		= mysqli_query($conn, "SELECT * FROM kelas WHERE id_kelas='$id_kelas'");
 $res 		= mysqli_fetch_assoc ($exec);
 ?>

 <form action="editdatakelas.php" method="POST">
  <input type="hidden" name="id_kelas" value="<?= $res['id_kelas']?>">
  <input type="text" required name="nama_kelas" class="form-control" value="<?= $res['nama_kelas']?>">
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="Submit" name="edit" class="btn btn-primary">Simpan</button>
  </form>
<?php }


if(isset($_POST['id_jurusan'])){
 $id_jurusan 	= $_POST['id_jurusan'];
 $exec 		= mysqli_query($conn, "SELECT * FROM jurusan WHERE id_jurusan ='$id_jurusan'");
 $res 		= mysqli_fetch_assoc ($exec);
 ?>

 <form action="editdatajurusan.php" method="POST">
  <input type="hidden" name="id_jurusan" value="<?= $res['id_jurusan']?>">
  <input type="text" required name="nama_jurusan" class="form-control" value="<?= $res['nama_jurusan']?>">
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="Submit" name="edit" class="btn btn-primary">Simpan</button>
  </form>
<?php }

if(isset($_POST['id_angkatan'])){
 $id_angkatan 	= $_POST['id_angkatan'];
 $exec 		= mysqli_query($conn, "SELECT * FROM angkatan WHERE id_angkatan ='$id_angkatan'");
 $res 		= mysqli_fetch_assoc ($exec);
 ?>

 <form action="editdataangkatan.php" method="POST">
  <input type="hidden" name="id_angkatan" value="<?= $res['id_angkatan']?>">
  <input type="text" required name="nama_angkatan" class="form-control mb-2" value="<?= $res['nama_angkatan']?>">
  <input type="text" required name="biaya" class="form-control" value="<?= $res['biaya']?>">
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="Submit" name="edit" class="btn btn-primary">Simpan</button>
  </form>
<?php }

if(isset($_POST['id_admin'])){
 $id_admin 	= $_POST['id_admin'];
 $exec 		= mysqli_query($conn, "SELECT * FROM admin WHERE id_admin ='$id_admin'");
 $res 		= mysqli_fetch_assoc ($exec);
 ?>

 <form action="editdataadmin.php" method="POST">
  <input type="hidden" name="id_admin" value="<?= $res['id_admin']?>">
  <input type="text" required name="nama_admin" class="form-control mb-2" value="<?= $res['nama_admin']?>">
  <input type="text" required name="user_admin" class="form-control mb-2" value="<?= $res['user_admin']?>">
  <input type="text" required name="pass_admin" class="form-control mb-2" value="<?= $res['pass_admin']?>">
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="Submit" name="edit" class="btn btn-primary">Simpan</button>
  </form>
  <?php }

if(isset($_POST['id_kepsek'])){
 $id_kepsek  = $_POST['id_kepsek'];
 $exec    = mysqli_query($conn, "SELECT * FROM kepala_sekolah WHERE id_kepsek ='$id_kepsek'");
 $res     = mysqli_fetch_assoc ($exec);
 ?>

 <form action="editdatakepsek.php" method="POST">
  <input type="hidden" name="id_kepsek" value="<?= $res['id_kepsek']?>">
  <input type="text" required name="nama_kepsek" class="form-control mb-2" value="<?= $res['nama_kepsek']?>">
  <input type="text" required name="periode" class="form-control mb-2" value="<?= $res['periode']?>">
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="Submit" name="edit" class="btn btn-primary">Simpan</button>
  </form>
<?php }


?>


