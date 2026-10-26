<?php
// Koneksi database
require_once __DIR__ . "/connect.php";

// Mengambil data dari form
$nim_lama = mysqli_real_escape_string($conn, $_POST['nim_lama']);
$nim = mysqli_real_escape_string($conn, $_POST['nim']);
$nama = mysqli_real_escape_string($conn, $_POST['nama']);
$nilai = $_POST['nilai'];

// Validasi nilai
if (!is_numeric($nilai) || $nilai < 0 || $nilai > 100) {
    echo "Nilai tidak valid! Masukkan nilai 0 - 100";
    exit;
}

// Menentukan nilai huruf dan predikat
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

// 1. CEK APAKAH ADA FOTO BARU YANG DI-UPLOAD
$update_foto_sql = "";

if (isset($_FILES["foto_profil"]) && $_FILES["foto_profil"]["error"] != UPLOAD_ERR_NO_FILE) {
    $target_dir = "uploads/";
    
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $imageFileType = strtolower(pathinfo($_FILES["foto_profil"]["name"], PATHINFO_EXTENSION));
    $nama_file_unik = time() . "_" . basename($_FILES["foto_profil"]["name"]);
    $target_file = $target_dir . $nama_file_unik;
    $uploadOk = 1;

    // Validasi gambar
    $check = getimagesize($_FILES["foto_profil"]["tmp_name"]);
    if ($check === false) {
        echo "File bukan gambar.";
        exit;
    }

    if ($_FILES["foto_profil"]["size"] > 5000000) {
        echo "Ukuran file terlalu besar (Maksimal 5 MB).";
        exit;
    }

    if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif") {
        echo "Hanya format JPG, JPEG, PNG & GIF yang diperbolehkan.";
        exit;
    }

    if (move_uploaded_file($_FILES["foto_profil"]["tmp_name"], $target_file)) {
        // 2. AMBIL FOTO LAMA DARI DATABASE UNTUK DIHAPUS DARI FOLDER
        $query_old = mysqli_query($conn, "SELECT foto_profil FROM nilai_mahasiswa WHERE nim = '$nim_lama'");
        $data_old = mysqli_fetch_assoc($query_old);
        if ($data_old && !empty($data_old['foto_profil']) && file_exists($data_old['foto_profil'])) {
            unlink($data_old['foto_profil']); // Hapus file foto lama
        }

        // Siapkan potongan query untuk update foto
        $update_foto_sql = ", foto_profil = '$target_file'";
    } else {
        echo "Terjadi kesalahan saat mengunggah foto.";
        exit;
    }
}

// 3. QUERY UPDATE DATA (Menyertakan update foto jika ada foto baru)
$sql = "UPDATE nilai_mahasiswa SET
        nim = '$nim',
        nama_mhsw = '$nama',
        nilai_akhir = '$nilai',
        nilai_huruf = '$nilai_huruf',
        predikat = '$predikat'
        $update_foto_sql
        WHERE nim = '$nim_lama'";

if (mysqli_query($conn, $sql)) {
    header("Location: users.php");
    exit;
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>