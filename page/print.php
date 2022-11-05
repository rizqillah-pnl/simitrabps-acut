<?php
include '../controller/config.php';
session_start();

if (!isset($_SESSION['id'])) {
  header("location:../logout.php");
}

$kec = 0;
date_default_timezone_set('Asia/Jakarta');
$now = date("Y-m-d H-i-s");
if (isset($_POST['id'])) :
  $kec = $_POST['id'];
  $data = mysqli_query($conn, "SELECT ptg.Nama, tlu.id_lowongan, tlu.L_action, tlu.tanggal_daftar, tlu.tanggal_konfirmasi, lw.jenis_lowongan, kec.nama_kec FROM tb_lowongan_user tlu, petugas ptg, tb_kecamatan kec, lowongan lw WHERE ptg.Kode_petugas=tlu.id_petugas AND tlu.id_lowongan=lw.id AND tlu.id_kec=kec.id AND kec.id='$kec' ORDER BY lw.id, ptg.Kode_petugas");
?>

  <!DOCTYPE html>
  <html dir="ltr" lang="en">

  <head>
    <title>Laporan Survei Kecamatan <?= mysqli_fetch_assoc($data)['nama_kec']; ?></title>
    <?php include 'meta.php'; ?>

    <link rel="stylesheet" href="http://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">

  </head>

  <body onload="window.print()">
    <?php $url = "../"; ?>
    <div class="page-wrapper">
      <!-- ============================================================== -->
      <!-- End Bread crumb and right sidebar toggle -->
      <!-- ============================================================== -->
      <!-- ============================================================== -->
      <!-- Container fluid  -->
      <!-- ============================================================== -->
      <div class="container-fluid">
        <h1 class="text-center mb-4">Data Laporan Survei - <?= mysqli_fetch_assoc($data)['nama_kec']; ?></h1>
        <?php if (isset($_POST['id'])) : ?>
          <div class="table-responsive" id="container">
            <table class="table align-middle text-nowrap" id="tabelku">
              <thead class="table-light">
                <tr class="fw-bold text-center">
                  <td class="text-dark">#</td>
                  <td class="text-dark">Nama Survei</td>
                  <td class="text-dark">Jumlah Pendaftar</td>
                  <td class="text-dark">Nama Pendaftar</td>
                  <td class="text-dark">Status</td>
                  <td class="text-dark">Tanggal Daftar</td>
                  <td class="text-dark">Tanggal Konfirmasi</td>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1;
                $temp = null;
                ?>
                <?php foreach ($data as $row) : ?>
                  <?php
                  $idLowongan = $row['id_lowongan'];
                  $jumDaftar = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM petugas LEFT JOIN tb_lowongan_user ON tb_lowongan_user.id_petugas=petugas.Kode_petugas WHERE tb_lowongan_user.id_kec='$kec' AND tb_lowongan_user.id_lowongan='$idLowongan'")); ?>

                  <tr class="text-center">
                    <td scope="text-center text-dark" style="padding-bottom: 8px; padding-top: 8px;">
                      <span class="text-dark">
                        <?php if ($temp == null) : ?>
                          <?= $i; ?>
                        <?php elseif ($temp != $idLowongan) : ?>
                          <?= $i += 1; ?>
                        <?php else : ?>
                          <?= $i; ?>
                        <?php endif; ?>
                        <?php $temp = $idLowongan; ?>
                      </span>
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
                        <?= ($row['L_action'] == 1) ? "<span class='text-success'>Diterima</span>" : "<span class='text-danger'>Ditolak</span>"; ?>
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
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        <?php endif; ?>

        <script>
          $(document).ready(function() {
            $('#tabelku').margetable({
              type: 2,
              colindex: [0, 1, 2] // column 1, 2
            });

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