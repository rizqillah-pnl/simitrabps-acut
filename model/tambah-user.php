
<?php
include '../controller/config.php';
include '../controller/validateText.php';
session_start();


// tambah user oleh admin dan koseka
if (isset($_POST['tambah-user'])) {
    $kode = $_SESSION['id'];

    $sql = mysqli_query($conn, "SELECT a.Kode_petugas, a.Username, a.Email, a.Password, a.Old_password, a.Last_login, a.Status, a.Created_at, a.Updated_at, b.Nama, b.NIK, b.Alamat, b.Foto, b.NoHP, b.Tanggal_lahir, b.Tempat_lahir, c.Jabatan, c.Id_jabatan FROM auth a, petugas b, jabatan c WHERE a.Kode_petugas=b.Kode_petugas AND b.Jabatan=c.Id_jabatan AND a.Kode_petugas='$kode' AND a.deleted=0");
    $result = mysqli_fetch_assoc($sql);


    $nama = validasi($_POST['nama']);
    $pass = htmlspecialchars($_POST['password']);
    $jabatan = "";

    $username = strtolower($nama);
    $username = str_replace(' ', '', $username);

    $passhash = md5($pass);
    date_default_timezone_set('Asia/Jakarta');
    $now = date("Y-m-d H:i:s");


    $query = mysqli_query($conn, "SELECT * FROM auth WHERE  deleted=0 AND (Kode_petugas='$kode_petugas' OR Username='$username' OR Email='$username')");
    $cek = mysqli_num_rows($query);

    if ($cek == 1) {
        $_SESSION['pesan'] = "gagal";
        header("Location: ../page/user.php");
    } else {
        $query2 = mysqli_query($conn, "INSERT INTO auth (Kode_petugas, Username, Password, Last_login, Created_at, deleted) VALUES ('$kode_petugas', '$username', '$passhash', '$now', '$now', 0)");

        $cari = mysqli_query($conn, "SELECT * FROM auth WHERE  deleted=0 AND (Username='$username' OR Email='$username')");
        $data = mysqli_fetch_assoc($cari);
        $kode_petugas = $data['Kode_petugas'];


        $query3 = mysqli_query($conn, "INSERT INTO petugas (Kode_petugas, Nama, Foto, Jabatan) VALUES ('$kode_petugas', '$nama', '1.jpg', '$jabatan')");

        if ($query2 && $query3) {
            $_SESSION['pesan'] = "berhasil";
            header("Location: ../page/user.php");
        } else {
            $_SESSION['pesan'] = "error";
            header("Location: ../page/user.php");
        }
    }
}


// registrasi akun sebagai petugas atau kortim
if (isset($_POST['register'])) {
    // $kode_petugas = htmlspecialchars($_POST['kode_petugas']);
    // $username = htmlspecialchars($_POST['nama']);
    $nama = validasi($_POST['nama']);
    $pass = htmlspecialchars($_POST['password']);
    $jabatan = "2";
    $nik = validasi($_POST['nik']);
    $email = validasi($_POST['email']);


    $username = strtolower(validasi($_POST['username']));
    $username = htmlspecialchars(str_replace(' ', '', $username));

    $passhash = md5($pass);
    date_default_timezone_set('Asia/Jakarta');
    $now = date("Y-m-d H:i:s");



    $query = mysqli_query($conn, "SELECT * FROM auth WHERE  deleted=0 AND (Username='$username' OR Email='$username')");
    $cek = mysqli_num_rows($query);

    if ($cek == 1) {
        $_SESSION['pesan'] = "gagal";
        header("Location: ../page/login.php");
    } else {
        $query2 = mysqli_query($conn, "INSERT INTO auth (Username, Email, Password, Last_login, Created_at, deleted) VALUES ('$username', '$email', '$passhash', '$now', '$now', 0)");

        $cari = mysqli_query($conn, "SELECT * FROM auth WHERE deleted=0 AND (Username='$username' OR Email='$username')");
        $data = mysqli_fetch_assoc($cari);
        $kode_petugas = $data['Kode_petugas'];


        $query3 = mysqli_query($conn, "INSERT INTO petugas (Kode_petugas, NIK, Nama, Foto, Jabatan) VALUES ('$kode_petugas', '$nik', '$nama', '1.jpg', '$jabatan')");

        if ($query2 && $query3) {
            $_SESSION['username'] = $username;
            $_SESSION['pesan'] = "berhasil";
            header("Location: ../page/login.php");
        } else {
            $_SESSION['pesan'] = "error";
            header("Location: ../page/login.php");
        }
    }
}
