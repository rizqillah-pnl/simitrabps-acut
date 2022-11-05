<?php
include '../controller/config.php';
session_start();
$kode = $_SESSION['id'];

if (isset($_POST['submit'])) {
    $kode_petugas = $_POST['kode_petugas'];

    $query2 = mysqli_query($conn, "SELECT * FROM petugas WHERE Kode_petugas='$kode_petugas'");
    $result = mysqli_fetch_assoc($query2);

    $query = mysqli_query($conn, "UPDATE auth SET deleted='1' WHERE Kode_petugas='$kode_petugas'");

    if ($query) {
        $_SESSION['delete-account'] = $result['Nama'];
        header("Location: ../page/user.php");
    } else {
        $_SESSION['pesan'] = "2";
        header("Location: ../page/user.php");
    }
}
