<?php
session_start();
include "../koneksi.php";


$action = $_POST['action'];
$id_dosen = $_SESSION['id_dosen'];

switch($action) {
    case 'publish':
        $id_ujian = $_POST['id_ujian'];
        
        $query = mysqli_query($koneksi, "
            UPDATE ujian_221053 SET status_221053 = 'aktif'
            WHERE id_221053 = '$id_ujian'
        ");

        if ($query) {
            echo "<script>
            alert('Ujian berhasil dipublish!');
                document.location='lihatujian.php?id_ujian=" . $id_ujian . "';
            </script>";
        } else {
            echo "<script>
            alert('Gagal mempublish ujian!');
                document.location='lihatujian.php?id_ujian=" . $id_ujian . "';
            </script>";
        }
        break;

    case 'delete':
        $id_ujian = $_POST['id_ujian'];
        
        $query = mysqli_query($koneksi, "
            DELETE FROM ujian_221053 WHERE id_221053 = '$id_ujian'
        ");

        if ($query) {
            echo "<script>
                alert('Hapus data sukses!');
                document.location='matakuliah.php';
            </script>";
        } else {
            echo "<script>
                alert('Simpan data Gagal!');
                document.location='lihatujian.php?id_ujian=" . $id_ujian . "';
            </script>";

        }
        break;
}
?>