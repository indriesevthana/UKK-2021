<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include 'koneksi.php';

	// membuat variabel untuk menampung data dari form
  $judul = $_POST['judul'];
  $pengarang = $_POST['pengarang'];
  $penerbit = $_POST['penerbit'];
  $persediaan = $_POST['persediaan'];
  $tahun = $_POST['tahun'];
  $gambar = $_FILES['gambar']['name'];


//cek dulu jika merubah gambar produk jalankan coding ini
if($gambar != "") {
  $ekstensi_diperbolehkan = array('jpeg','jpg'); //ekstensi file gambar yang bisa diupload 
  $x = explode('.', $gambar); //memisahkan nama file dengan ekstensi yang diupload
  $ekstensi = strtolower(end($x));
  $file_tmp = $_FILES['gambar']['tmp_name'];   
  $angka_acak     = rand(1,999);
  $gambar = $angka_acak.'-'.$gambar; //menggabungkan angka acak dengan nama file sebenarnya
  if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)  {
                move_uploaded_file($file_tmp, '../gambar'.$gambar); //memindah file gambar ke folder gambar
                  // jalankan query INSERT untuk menambah data ke database pastikan sesuai urutan (id tidak perlu karena dibikin otomatis)
                  $query = "INSERT INTO data (judul, pengarang, penerbit, persediaan, tahun, gambar) VALUES ('$judul', '$pengarang', '$penerbit', '$persediaan', '$tahun', '$gambar')";
                  $result = mysqli_query($koneksi, $query);
                  // periska query apakah ada error
                  if(!$result){
                      die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                           " - ".mysqli_error($koneksi));
                  } else {
                    //tampil alert dan akan redirect ke halaman index.php
                    //silahkan ganti index.php sesuai halaman yang akan dituju
                    echo "<script>alert('Data berhasil ditambah.');window.location='index.php';</script>";
                  }

            } else {     
             //jika file ekstensi tidak JPEG dan jpg maka alert ini yang tampil
                echo "<script>alert('Ekstensi gambar yang boleh hanya JPEG atau jpg.');window.location='tambah_buku.php';</script>";
            }
} else {
   $query = "INSERT INTO data (judul, pengarang, penerbit, tahun, gambar) VALUES ('$judul', '$pengarang', '$penerbit', '$persediaan', '$tahun', null)";
                  $result = mysqli_query($koneksi, $query);
                  // periska query apakah ada error
                  if(!$result){
                      die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                           " - ".mysqli_error($koneksi));
                  } else {
                    //tampil alert dan akan redirect ke halaman index.php
                    //silahkan ganti index.php sesuai halaman yang akan dituju
                    echo "<script>alert('Data berhasil ditambah.');window.location='index.php';</script>";
                  }
}