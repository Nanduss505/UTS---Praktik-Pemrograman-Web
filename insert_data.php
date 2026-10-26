<?php
//koneksi
require_once __DIR__ . "/connect.php";

//data yang di isi ke tabel
// $fname = $_POST['fname'];
// $lname = $_POST['lname'];
// $email = $_POST['email'];

$nim = $_POST['nim'];
$nama = $_POST['nama'];
$nilai = $_POST['nilai'];
//$nilai_huruf = $_POST['nilai_huruf'];
//$predikat = $_POST['predikat'];

$cek_nim = mysqli_query($conn, "SELECT nim FROM nilai_mahasiswa WHERE nim = '$nim'");
if (mysqli_num_rows($cek_nim) > 0) {
    echo "<script>alert('Gagal! NIM $nim sudah terdaftar. Gunakan NIM lain.'); window.history.back();</script>";
    exit;
}

if ($nilai < 0 || $nilai > 100) {
    echo "Nilai tidak valid! Masukkan nilai 0 - 100";
    exit;
} else {
    if ($nilai >= 80.51) {
        $nilai_huruf = "A";
        $predikat = "Sangat Memuaskan";
    } elseif ($nilai >= 65.51) {
        $nilai_huruf = "B";
        $predikat = "Memuaskan";
    } elseif ($nilai >= 50.51) {
        $nilai_huruf = "C";
        $predikat = "Cukup";
    } elseif ($nilai >= 34.51) {
        $nilai_huruf = "D";
        $predikat = "Kurang";
    } else {
        $nilai_huruf = "E";
        $predikat = "Tidak Lulus";
    }
};


// Upload Foto Mahasiswa
$foto_profil = NULL;

if (isset($_FILES["foto_profil"]) && $_FILES["foto_profil"]["error"] != UPLOAD_ERR_NO_FILE) {

    $target_dir = "uploads/";
    
    // 1. Buat folder uploads secara otomatis jika belum ada
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $imageFileType = strtolower(pathinfo($_FILES["foto_profil"]["name"], PATHINFO_EXTENSION));
    
    // 2. Berikan nama unik (timestamp) agar tidak pernah bentrok/sama persis namanya
    $nama_file_unik = time() . "_" . basename($_FILES["foto_profil"]["name"]);
    $target_file = $target_dir . $nama_file_unik;

    $uploadOk = 1;

    // 3. Cek apakah file benar-benar gambar SEBELUM di-upload
    $check = getimagesize($_FILES["foto_profil"]["tmp_name"]);
    if ($check === false) {
        echo "File bukan gambar.";
        $uploadOk = 0;
    }

    // 4. Cek ukuran file (Maksimal 5 MB)
    if ($_FILES["foto_profil"]["size"] > 5000000) {
        echo "Ukuran file terlalu besar (Maksimal 5 MB).";
        $uploadOk = 0;
    }

    // 5. Filter format file
    if (
        $imageFileType != "jpg" &&
        $imageFileType != "jpeg" &&
        $imageFileType != "png" &&
        $imageFileType != "gif"
    ) {
        echo "Hanya format JPG, JPEG, PNG & GIF yang diperbolehkan.";
        $uploadOk = 0;
    }

    // 6. JIKA VALIDASI GAGAL, HENTIKAN PROGRAM (File tidak akan masuk ke folder)
    if ($uploadOk == 0) {
        echo "<br>Maaf, foto gagal diunggah.";
        exit;
    } else {
        // 7. FILE HANYA MASUK KESINI JIKA SEMUA VALIDASI DI ATAS LOLOS
        if (move_uploaded_file($_FILES["foto_profil"]["tmp_name"], $target_file)) {
            $foto_profil = $target_file;
        } else {
            echo "Terjadi kesalahan saat mengunggah foto.";
            exit;
        }
    }
}

//$sql = "INSERT INTO nilai_mahasiswa (nim, nama_mhsw, nilai_akhir)
$sql = "INSERT INTO nilai_mahasiswa
        (nim, nama_mhsw, foto_profil, nilai_akhir, nilai_huruf, predikat)
        VALUES
        ('$nim', '$nama', " .
        ($foto_profil === NULL ? "NULL" : "'" . mysqli_real_escape_string($conn, $foto_profil) . "'") .
        ", '$nilai', '$nilai_huruf', '$predikat')";

if (mysqli_query($conn, $sql)) {
    header("Location: users.php");
    exit;
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>