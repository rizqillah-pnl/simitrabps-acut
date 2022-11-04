<?php
include '../controller/config.php';
session_start();

if (!isset($_SESSION['id'])) {
  header("location:../logout.php");
}


$kode = $_SESSION['id'];
date_default_timezone_set('Asia/Jakarta');
$now = date("Y-m-d H-i-s");
$insert = mysqli_query($conn, "UPDATE auth SET Last_login='$now' WHERE Kode_petugas='$kode'");

$sql = mysqli_query($conn, "SELECT a.Kode_petugas, a.Username, a.Email, a.Password, a.Old_password, a.Last_login, a.Created_at, a.Updated_at, b.Nama, b.NIK, b.Alamat, b.Foto, b.NoHP, b.Tanggal_lahir, b.Tempat_lahir, c.Jabatan, c.Id_jabatan FROM auth a, petugas b, jabatan c WHERE a.Kode_petugas=b.Kode_petugas AND b.Jabatan=c.Id_jabatan AND a.Kode_petugas='$kode' ORDER BY c.Id_jabatan");

$result1 = mysqli_fetch_assoc($sql);

if ($result1['Id_jabatan'] == "1") :
  $kec = 0;

  if (isset($_POST['kec'])) {
    $kec = $_POST['kec'];
    $data = mysqli_query($conn, "SELECT ptg.Nama, tlu.id_lowongan, tlu.L_action, tlu.tanggal_daftar, tlu.tanggal_konfirmasi, lw.jenis_lowongan FROM tb_lowongan_user tlu, petugas ptg, tb_kecamatan kec, lowongan lw WHERE ptg.Kode_petugas=tlu.id_petugas AND tlu.id_lowongan=lw.id AND tlu.id_kec=kec.id AND kec.id='$kec'");
  }



?>

  <!DOCTYPE html>
  <html dir="ltr" lang="en">

  <head>
    <title>Laporan Survei | Simitra</title>
    <?php include 'meta.php'; ?>

    <link rel="stylesheet" href="http://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">

  </head>

  <body>
    <?php $url = "../"; ?>
    <?php include 'header.php'; ?>

    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <aside class="left-sidebar" data-sidebarbg="skin6">
      <!-- Sidebar scroll-->
      <div class="scroll-sidebar" id="navbar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
          <ul id="sidebarnav">
            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="index.php" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>

            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="profile.php" aria-expanded="false"><i class="fa-solid fa-circle-user"></i><span class="hide-menu">Profile</span></a></li>

            <?php if ($result1['Id_jabatan'] == 2) :  ?>
              <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="lowongan-user.php" aria-expanded="false"><i class="mdi mdi-worker"></i><span class="hide-menu">Lowongan Terdaftar</span></a></li>
            <?php endif; ?>

            <?php if ($result1['Id_jabatan'] == 1) {  ?>
              <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="lowongan.php" aria-expanded="false"><i class="mdi mdi-file-document-box"></i><span class="hide-menu">Daftar Survei</span></a></li>

              <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="seleksi-daftar.php" aria-expanded="false"><i class='far fa-handshake'></i><span class="hide-menu ">Seleksi
                    Pendaftar</span></a></li>

              <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="user.php" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">Account</span></a></li>

              <li class="sidebar-item" style="background-color: #1a9bfc; border-radius: 9px">
                <div class="dropdown">
                  <a class="sidebar-link waves-effect waves-dark sidebar-link dropdown-toggle text-white" href="profile.php" ole="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-note-text text-white"></i><span class="hide-menu text-white">Laporan</span></a>

                  <ul class="dropdown-menu" style="width: 215px;">
                    <li><a class="dropdown-item waves-effect waves-dark active" href="cetak-survei.php"><i class="mdi mdi-chart-bubble"></i> Survei</a></li>
                    <li><a class="dropdown-item waves-effect waves-dark" href="pelamar.php"><i class="mdi mdi-human-male-female"></i> Pelamar</a></li>
                  </ul>
                </div>
              </li>
            <?php } ?>

            <li class="sidebar-item logout-item" style="position: fixed; bottom: 0; width: 220px">
              <button class="dropdown-item border-0 btn btn-link" data-bs-toggle="modal" data-bs-target="#Logout"><i class="m-r-10 mdi mdi-logout">
                </i><span class="hide-menu">
                  Logout</span></button>
              <!-- <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../logout.php" aria-expanded="false"><i class="m-r-10 mdi mdi-logout">
                            </i><span class="hide-menu">Logout</span>
                        </a> -->
            </li>
          </ul>

        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!-- ============================================================== -->
    <!-- End Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
      <!-- ============================================================== -->
      <!-- Bread crumb and right sidebar toggle -->
      <!-- ============================================================== -->
      <div class="page-breadcrumb" style="padding-bottom: 0; padding-top: 0;">
        <div class="row align-items-center">
          <div class="col-6">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb mb-0 d-flex align-items-center">
                <li class="breadcrumb-item"><a href="index.php" class="link"><i class="mdi mdi-home-outline fs-4"></i></a></li>
                <li class="breadcrumb-item">Laporan</li>
                <li class="breadcrumb-item active" aria-current="page">Survei</li>
              </ol>
            </nav>
            <h1 class="mb-0 fw-bold">Cetak Survei</h1>
          </div>
          <div class="col-6">

          </div>
        </div>
      </div>
      <!-- ============================================================== -->
      <!-- End Bread crumb and right sidebar toggle -->
      <!-- ============================================================== -->
      <!-- ============================================================== -->
      <!-- Container fluid  -->
      <!-- ============================================================== -->
      <div class="container-fluid">
        <form action="" method="post">
          <span>Kecamatan :</span>
          <?php $dataKec = mysqli_query($conn, "SELECT * FROM tb_kecamatan"); ?>
          <select class="form-select mb-2" aria-label="Default select example" name="kec">
            <?php foreach ($dataKec as $row) : ?>
              <?php if (isset($_POST['kec'])) {
                if ($_POST['kec'] == $row['id']) : ?>
                  <option value="<?= $row['id']; ?>" selected><?= $row['nama_kec']; ?></option>
                  <?php continue; ?>
                <?php endif; ?>
              <?php } ?>
              <option value="<?= $row['id']; ?>"><?= $row['nama_kec']; ?></option>
            <?php endforeach; ?>
          </select>
          <div class="d-grid gap-2 mb-3">
            <button type="submit" name="submit" class="btn btn-primary"><i class="mdi mdi-magnify"></i> Pilih</button>
          </div>
        </form>

        <?php if (isset($_POST['kec'])) : ?>
          <div class="table-responsive" id="container">
            <table class="table align-middle text-nowrap" id="tabelku">
              <thead class="table-dark">
                <tr class="fw-semibold text-center">
                  <td>#</td>
                  <td>Nama Survei</td>
                  <td>Jumlah Pendaftar</td>
                  <td>Nama Pendaftar</td>
                  <td>Status</td>
                  <td>Tanggal Daftar</td>
                  <td>Tanggal Konfirmasi</td>
                </tr>
              </thead>
              <tbody>
                <?php if (mysqli_num_rows($data) != 0) : ?>
                  <?php if ($kec != 0) : ?>
                    <?php while ($row = mysqli_fetch_assoc($data)) : ?>
                      <?php
                      $idLowongan = $row['id_lowongan'];
                      $jumDaftar = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM petugas LEFT JOIN tb_lowongan_user ON tb_lowongan_user.id_petugas=petugas.Kode_petugas WHERE tb_lowongan_user.id_kec='$kec' AND tb_lowongan_user.id_lowongan='$idLowongan'")); ?>

                      <tr class="text-center">
                        <td scope="text-center text-dark" style="padding-bottom: 8px; padding-top: 8px;">
                          <span class="text-dark"><?= $row['id_lowongan']; ?></span>
                        </td>
                        <td class="text-center text-dark" style="padding-bottom: 8px; padding-top: 8px;">
                          <?= $row['jenis_lowongan']; ?>
                        </td>
                        <td class="text-center text-dark" style="padding-bottom: 8px; padding-top: 8px;">
                          <?= $jumDaftar; ?>
                        </td>
                        <td class="text-center text-dark" style="padding-bottom: 8px; padding-top: 8px;">
                          <?= $row['Nama']; ?>
                        </td>
                        <td class="text-center text-dark" style="padding-bottom: 8px; padding-top: 8px;">
                          <?php if ($row['L_action'] != null) : ?>
                            <?= ($row['L_action'] == 1) ? "Diterima" : "Ditolak"; ?>
                          <?php else : ?>
                            Pending
                          <?php endif; ?>
                        </td>
                        <td class="text-center text-dark" style="padding-bottom: 8px; padding-top: 8px;">
                          <?= date('d F Y', strtotime($row['tanggal_daftar'])); ?>
                        </td>
                        <td class="text-center text-dark" style="padding-bottom: 8px; padding-top: 8px;">
                          <?= ($row['tanggal_konfirmasi'] != null) ? date('d F Y', strtotime($row['tanggal_konfirmasi'])) : "<i class='text-secondary'>-</i>"; ?>
                        </td>
                      </tr>
                    <?php endwhile; ?>
                  <?php endif; ?>
                <?php else : ?>
                  <tr class="text-center fw-bold">
                    <td colspan="7">DATA TIDAK ADA!</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>


          <?php if (mysqli_num_rows($data) != 0) : ?>
            <div class="d-grid gap-2 mb-3">
              <a href="print.php?id=<?= $kec; ?>" target="_blank" class="btn btn-success text-white"><i class="mdi mdi-printer"></i> Cetak</a>
            </div>
          <?php endif; ?>

        <?php endif; ?>

        <script>
          $(document).ready(function() {
            $('#tabelku').margetable({
              type: 2,
              colindex: [0, 1, 2] // column 1, 2
            });

          })
        </script>
        <?php include 'footer.php'; ?>
      <?php else : ?>
        <?php header("Location: ../index.php"); ?>
      <?php endif; ?>