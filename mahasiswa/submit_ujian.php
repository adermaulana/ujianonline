<?php
// Koneksi ke database
include '../koneksi.php';

session_start();
// Dapatkan data dari form
$mahasiswa_id = $_SESSION['id_mahasiswa'];
$id_ujian = $_POST['id_ujian']; 
$answers = array(); 
$correct_answers = array(); 

// Iterate through the submitted answers
foreach ($_POST as $key => $value) {
    if (strpos($key, 'soal_') === 0) {
        $id_soal = substr($key, 5); 
        $answers[$id_soal] = $value;

        // Dapatkan jawaban benar dari database
        $sql = "SELECT jawaban_benar_221053 FROM soal_ujian_221053 WHERE id_221053 = $id_soal";
        $result = $koneksi->query($sql);
        $row = $result->fetch_assoc();
        $correct_answers[$id_soal] = $row['jawaban_benar_221053'];
    }
}

// Hitung jumlah jawaban yang benar
$correct_count = 0;
foreach ($answers as $id_soal => $answer) {
    if ($answer == $correct_answers[$id_soal]) {
        $correct_count++;
    }
}

// Hitung nilai
$nilai = ($correct_count / count($answers)) * 100;

// Simpan hasil ujian ke database
$sql = "INSERT INTO hasil_ujian_221053 (id_221053, ujian_id_221053, mahasiswa_id_221053, nilai_221053, dikumpulkan_pada_221053)
        VALUES (NULL, $id_ujian, $mahasiswa_id, $nilai, NOW())";

if ($koneksi->query($sql) === TRUE) {
    echo "<script>
            alert('Berhasil mengirim ujian!');
            document.location='hasilujian.php';
            </script>";
} else {
    echo "Terjadi kesalahan saat menyimpan hasil ujian: " . $conn->error;
}

$koneksi->close();
?>