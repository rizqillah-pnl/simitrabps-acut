<?php
include '../controller/config.php';
include '../controller/validateText.php';

session_start();
$kode = $_SESSION['id'];

$sql = mysqli_query($conn, "SELECT a.Kode_petugas, a.Username, a.Email, a.Password, a.Old_password, a.Last_login, a.Created_at, a.Updated_at, b.Nama, b.NIK, b.Alamat, b.Foto, b.NoHP, b.Tanggal_lahir, b.Tempat_lahir, c.Jabatan, c.Id_jabatan FROM auth a, petugas b, jabatan c WHERE a.Kode_petugas=b.Kode_petugas AND b.Jabatan=c.Id_jabatan AND a.Kode_petugas='$kode'");
$result = mysqli_fetch_assoc($sql);

// var_dump($_FILES);
// die;


if (isset($_POST['daftarLowongan'])) {
    $idLowongan = $_POST['idLowongan'];
    $kec = $_POST['kecamatan'];

    $cari = mysqli_query($conn, "SELECT * FROM tb_lowongan_user WHERE id='$idLowongan' AND id_petugas='$kode'");
    if (mysqli_num_rows($cari) == 0) {

        date_default_timezone_set('Asia/Jakarta');
        $now = date("Y-m-d H-i-s");
        $umur = $_POST['umur'];
        $cv = upload('cv');
        $ktp = upload('ktp');
        $ijazah = upload('ijazah');
        $suratLamaran = upload('suratLamaran');
        $suratDomisili = upload('suratDomisili');

        if (!$cv || !$ktp || !$ijazah || !$suratLamaran || !$suratDomisili) {
            $_SESSION['pesan'] = "gagal";
            header("Location: ../page/index.php");
        } else {
            $daftar = mysqli_query($conn, "INSERT INTO tb_lowongan_user (id_lowongan, id_petugas, id_kec, tanggal_daftar, umur, cv, ktp, ijazah, suratLamaran, suratDomisili) VALUES ('$idLowongan', '$kode', '$kec', '$now', '$umur', '$cv', '$ktp', '$ijazah', '$suratLamaran', '$suratDomisili')");

            if ($daftar) {
                $_SESSION['pesan'] = "berhasil";
                header("Location: ../page/index.php");
            } else {
                $_SESSION['pesan'] = "gagal";
                header("Location: ../page/index.php");
            }
        }
    } else {
        $_SESSION['pesan'] = "already";
        header("Location: ../page/index.php");
    }
}

function upload($name)
{
    $namaFile = $_FILES[$name]['name'];
    $ukuranFile = $_FILES[$name]['size'];
    $error = $_FILES[$name]['error'];
    $tmpName = $_FILES[$name]['tmp_name'];

    // cek apakah tidak ada gambar yang diupload
    if ($error === 4) {
        return false;
    }

    // cek apakah yang diupload adalah gambar
    $ekstensiValid = ['jpg', 'jpeg', 'png', 'pdf'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiValid)) {
        return false;
    }

    // cek jika ukurannya terlalu besar
    if ($ukuranFile > 2000000) {
        return false;
    }

    $namaFileWithoutExt = pathinfo($namaFile, PATHINFO_FILENAME);
    // lolos pengecekan, gambar siap diupload
    // generate nama gambar baru
    date_default_timezone_set('Asia/Jakarta');
    $namaFileBaru = date('d-m-Y H-i-s');
    $namaFileBaru .= $namaFileWithoutExt;
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    if (!file_exists('../public/data')) {
        mkdir('../public/data', 0777, true);
    }
    move_uploaded_file($tmpName, '../public/data/' . $namaFileBaru);

    return $namaFileBaru;
}
