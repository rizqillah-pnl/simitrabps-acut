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

if ($result1['Id_jabatan'] == "1" && $_SERVER['REQUEST_METHOD'] == "POST") :
  $data = mysqli_query($conn, "SELECT * FROM petugas LEFT JOIN tb_lowongan_user ON tb_lowongan_user.id_petugas=petugas.Kode_petugas LEFT JOIN lowongan ON lowongan.id=tb_lowongan_user.id_lowongan LEFT JOIN tb_kecamatan ON tb_kecamatan.id=tb_lowongan_user.id_kec LEFT JOIN auth ON petugas.Kode_petugas=auth.Kode_petugas WHERE tb_lowongan_user.id IS NOT NULL AND auth.deleted=0 ORDER BY petugas.Kode_petugas, tb_kecamatan.id, lowongan.id");




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

    <!-- ============================================================== -->
    <!-- End Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
      <!-- ============================================================== -->
      <!-- End Bread crumb and right sidebar toggle -->
      <!-- ============================================================== -->
      <!-- ============================================================== -->
      <!-- Container fluid  -->
      <!-- ============================================================== -->
      <div class="container-fluid">

        <h1 class="text-center mb-4">Data Laporan Pelamar</h1>
        <div class="table-responsive" id="container">
          <table class="table align-middle text-nowrap" id="tabelku">
            <thead class="table-light">
              <tr class="fw-bold text-center">
                <td>#</td>
                <td>Nama</td>
                <td class="text-wrap">Jumlah Daftar</td>
                <td>No</td>
                <td>Nama Survei</td>
                <td>Kecamatan</td>
                <td class="text-wrap">Tanggal Daftar</td>
                <td class="text-wrap">Tanggal Konfirmasi</td>
                <td>Status</td>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1;
              $j = 1;
              $temp = null;
              $temp2 = null;
              ?>
              <?php while ($row = mysqli_fetch_assoc($data)) : ?>
                <?php
                $idPetugas = $row['Kode_petugas'];
                $jumDaftar = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_lowongan_user WHERE id_petugas='$idPetugas'")); ?>

                <tr class="text-center">
                  <td scope="text-center text-dark" style="padding-bottom: 8px; padding-top: 8px;">
                    <span class="text-dark">
                      <?php if ($temp == null) : ?>
                        <?= $i; ?>
                      <?php elseif ($temp != $idPetugas) : ?>
                        <?= $i += 1; ?>
                      <?php else : ?>
                        <?= $i; ?>
                      <?php endif; ?>
                      <?php $temp = $idPetugas; ?>
                    </span>
                  </td>
                  <td class="text-center text-dark" style="padding-bottom: 8px; padding-top: 8px;">
                    <?= $row['Nama']; ?>
                  </td>
                  <td class="text-center text-dark" style="padding-bottom: 8px; padding-top: 8px;">
                    <?= $jumDaftar; ?>
                  </td>
                  <td scope="text-center text-dark" style="padding-bottom: 8px; padding-top: 8px;">
                    <span class="text-secondary">
                      <?php if ($temp2 == null) : ?>
                        <?= $j ?>
                      <?php elseif ($temp2 == $idPetugas) : ?>
                        <?= $j += 1; ?>
                      <?php else : ?>
                        <?php $j = 1;
                        echo $j; ?>
                      <?php endif; ?>
                      <?php $temp2 = $idPetugas; ?>
                    </span>
                  </td>
                  <td class="text-center text-dark text-wrap" style="padding-bottom: 8px; padding-top: 8px;">
                    <?= $row['jenis_lowongan']; ?>
                  </td>
                  <td class="text-center text-dark" style="padding-bottom: 8px; padding-top: 8px;">
                    <?= $row['nama_kec']; ?>
                  </td>
                  <td class="text-center text-dark text-wrap" style="padding-bottom: 8px; padding-top: 8px;">
                    <?= date('d/m/Y', strtotime($row['tanggal_daftar'])); ?>
                  </td>
                  <td class="text-center text-dark text-wrap" style="padding-bottom: 8px; padding-top: 8px;">
                    <?= ($row['tanggal_konfirmasi'] != null) ? date('d/m/Y', strtotime($row['tanggal_konfirmasi'])) : "<i class='text-secondary'>-</i>"; ?>
                  </td>
                  <td class="text-center text-dark" style="padding-bottom: 8px; padding-top: 8px;">
                    <?php if ($row['L_action'] != null) : ?>
                      <?= ($row['L_action'] == 1) ? "<span class='text-success'>Diterima</span>" : "<span class='text-danger'>Ditolak</span>"; ?>
                    <?php else : ?>
                      Pending
                    <?php endif; ?>
                  </td>
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>

        <script>
          $(document).ready(function() {
            $('#tabelku').margetable({
              type: 2,
              colindex: [0, 1, 2] // column 1, 2
            });

            window.print();

          })
        </script>



        <script src="../public/js/rowspanizer/jquery.rowspanizer.min.js"></script>
        <script src="../public/js/mergecells/jquery.table.marge.js"></script>
        <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>

        <script src="../public/js/script.js"></script>
        <!-- Bootstrap tether Core JavaScript -->
        <script src="../public/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="../public/js/app-style-switcher.js"></script>
        <!--Wave Effects -->
        <script src="../public/js/waves.js"></script>
        <!--Menu sidebar -->
        <script src="../public/js/sidebarmenu.js"></script>
        <!--Custom JavaScript -->
        <script src="../public/js/custom.js"></script>
        <!--This page JavaScript -->
        <!--chartis chart-->
        <script src="../public/assets/libs/chartist/dist/chartist.min.js"></script>
        <script src="../public/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
        <script src="../public/js/pages/dashboards/dashboard1.js"></script>


  </body>

  </html>
<?php else : ?>
  <?php header("Location: index.php"); ?>
<?php endif; ?>