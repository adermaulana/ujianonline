<?php

include '../koneksi.php';

session_start();

$id_mahasiswa = $_SESSION['id_mahasiswa'];
$exam_id = $_GET['id'];
if($_SESSION['status'] != 'login'){

    session_unset();
    session_destroy();

    header("location:../");

}

$sql = "SELECT 
          id_221053,
          judul_221053,
          waktu_mulai_221053,
          waktu_selesai_221053
        FROM ujian_221053
        WHERE users_id_221053 = $id_mahasiswa
        ORDER BY waktu_mulai_221053 ASC
        LIMIT 1";
$result = $koneksi->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $exam_id = $row["id_221053"];
    $exam_title = $row["judul_221053"];
    $exam_start_time = $row["waktu_mulai_221053"];
    $exam_end_time = $row["waktu_selesai_221053"];

    // Calculate the exam duration in minutes
    $start_time = strtotime($exam_start_time);
    $end_time = strtotime($exam_end_time);
    $exam_duration = round(($end_time - $start_time) / 60);
} else {
    echo "No exam data found for the user.";
    exit;
}

// Fetch the exam questions
$sql = "SELECT 
          id_221053,
          pertanyaan_221053,
          opsi_a_221053,
          opsi_b_221053,
          opsi_c_221053,
          opsi_d_221053,
          jawaban_benar_221053
        FROM soal_ujian_221053
        WHERE ujian_id_221053 = $exam_id";
$result = $koneksi->query($sql);
$questions = $result->fetch_all(MYSQLI_ASSOC);

$koneksi->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Ujian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body>
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><?php echo $exam_title; ?></h1>
            <div class="card mb-4">
                <div class="card-body">
                    <!-- Timer Ujian -->
                    <h4>Sisa Waktu: <span id="timer"><?php echo sprintf('%02d:%02d', $exam_duration / 60, $exam_duration % 60); ?></span></h4>

                    <!-- Soal Ujian -->
                    <form action="submit_ujian.php" method="POST" onsubmit="localStorage.removeItem('ujianTime_<?= $exam_id ?>')">
                        <input type="hidden" name="id_ujian" value="<?= $exam_id ?>">
                        <?php foreach ($questions as $question): ?>
                        <div class="mb-3">
                            <label class="form-label"><?php echo $question['pertanyaan_221053']; ?></label>
                            <div>
                                <input type="radio" name="soal_<?php echo $question['id_221053']; ?>" value="A" required> A. <?php echo $question['opsi_a_221053']; ?><br>
                                <input type="radio" name="soal_<?php echo $question['id_221053']; ?>" value="B" required> B. <?php echo $question['opsi_b_221053']; ?><br>
                                <input type="radio" name="soal_<?php echo $question['id_221053']; ?>" value="C" required> C. <?php echo $question['opsi_c_221053']; ?><br>
                                <input type="radio" name="soal_<?php echo $question['id_221053']; ?>" value="D" required> D. <?php echo $question['opsi_d_221053']; ?><br>
                            </div>
                        </div>
                        <?php endforeach; ?>

                        <!-- Tombol Submit -->
                        <button type="submit" class="btn btn-primary">Kirim Jawaban</button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script>
        const totalTime = <?php echo $exam_duration * 60; ?>; // Waktu ujian dalam detik
        const timerEl = document.getElementById('timer');
        const ujianKey = 'ujianTime_<?php echo $exam_id; ?>'; // Key untuk menyimpan waktu di localStorage
        let sisaWaktu = totalTime;

        // Cek apakah ada data di localStorage
        if (localStorage.getItem(ujianKey)) {
            const startTime = parseInt(localStorage.getItem(ujianKey), 10);
            const now = Math.floor(Date.now() / 1000);
            sisaWaktu = totalTime - (now - startTime);

            // Jika waktu habis
            if (sisaWaktu <= 0) {
                alert('Waktu habis! Jawaban akan dikirim otomatis.');
                document.forms[0].submit();
            }
        } else {
            // Simpan waktu mulai ujian jika belum ada di localStorage
            localStorage.setItem(ujianKey, Math.floor(Date.now() / 1000));
        }

        function startTimer() {
            const interval = setInterval(function() {
                if (sisaWaktu <= 0) {
                    clearInterval(interval);
                    alert('Waktu habis! Jawaban akan dikirim otomatis.');
                    document.forms[0].submit();
                }

                // Hitung menit dan detik
                const minutes = Math.floor(sisaWaktu / 60);
                let seconds = sisaWaktu % 60;
                seconds = seconds < 10 ? '0' + seconds : seconds;

                // Tampilkan di HTML
                timerEl.textContent = minutes + ":" + seconds;

                // Kurangi sisa waktu
                sisaWaktu--;

                // Simpan kembali waktu ujian yang tersisa setiap detik
                localStorage.setItem(ujianKey, Math.floor(Date.now() / 1000) - (totalTime - sisaWaktu));
            }, 1000);
        }

        // Mulai timer saat halaman dibuka
        startTimer();
    </script>
</body>
</html>
