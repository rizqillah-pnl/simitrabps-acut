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
$sql = mysqli_query($conn, "SELECT a.Kode_petugas, a.Username, a.Email, a.Password, a.Old_password, a.Last_login, a.Created_at, a.Updated_at, b.Nama, b.NIK, b.Alamat, b.Foto, b.NoHP, b.Tanggal_lahir, b.Tempat_lahir, c.Jabatan, c.Id_jabatan FROM auth a, petugas b, jabatan c WHERE a.Kode_petugas=b.Kode_petugas AND b.Jabatan=c.Id_jabatan AND a.Kode_petugas='$kode' AND a.deleted=0 ORDER BY c.Id_jabatan");

$result1 = mysqli_fetch_assoc($sql);

// ini adalah cek id jabatannya admin atau bukan!
if ($result1['Id_jabatan'] == "1") :

    $jumlahDataPerHalaman = 5;
    $jumData = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_lowongan_user WHERE L_action is NULL"));
    $jumlahHalaman = ceil($jumData / $jumlahDataPerHalaman);
    $halamanAktif = (isset($_GET['page'])) ? $_GET['page'] : 1;
    $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;
?>

    <!DOCTYPE html>
    <html dir="ltr" lang="en">

    <head>
        <title>Seleksi Daftar | Simitra</title>
        <?php include 'meta.php'; ?>
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
                            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="lowongan.php" aria-expanded="false"><i class="mdi mdi-file-document-box"></i><span class="hide-menu ">Daftar Survei</span></a></li>

                            <li class="sidebar-item" style="background-color: #1a9bfc; border-radius: 9px"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="seleksi-daftar.php" aria-expanded="false"><i class='far fa-handshake'></i><span class="hide-menu text-white">Seleksi Pendaftar</span></a></li>

                            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="user.php" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">Account</span></a></li>

                            <li class="sidebar-item">
                                <div class="dropdown">
                                    <a class="sidebar-link waves-effect waves-dark sidebar-link dropdown-toggle" href="profile.php" ole="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-note-text"></i><span class="hide-menu">Laporan</span></a>

                                    <ul class="dropdown-menu" style="width: 215px;">
                                        <li><a class="dropdown-item waves-effect waves-dark" href="cetak-survei.php"><i class="mdi mdi-chart-bubble"></i> Survei</a></li>
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
                                <li class="breadcrumb-item active" aria-current="page">Seleksi Pendaftar</li>
                            </ol>
                        </nav>
                        <h1 class="mb-0 fw-bold">Seleksi Pendaftar</h1>
                    </div>
                    <div class="col-6">

                    </div>
                </div>
            </div>

            <?php
            if (isset($_SESSION['pesan'])) :
                $pesan =  $_SESSION['pesan'];
            ?>
                <?php if ($pesan == 200) : ?>
                    <script>
                        swal("Berhasil!", "Data Lowongan Telah Ditambahkan!", "success");
                    </script>
                <?php elseif ($pesan == 300) : ?>
                    <script>
                        swal("Gagal!", "Data Lowongan Gagal Ditambahkan!", "error");
                    </script>
                <?php elseif ($pesan == 201) : ?>
                    <script>
                        swal("Berhasil!", "Update Data Lowongan Berhasil Dilakukan!", "success");
                    </script>
                <?php elseif ($pesan == 301) : ?>
                    <script>
                        swal("Gagal!", "Data Lowongan Gagal Diupdate!", "warning");
                    </script>
                <?php elseif ($pesan == 202) : ?>
                    <script>
                        swal("Berhasil!", "Hapus Data Lowongan Berhasil Dilakukan!", "success");
                    </script>
                <?php elseif ($pesan == 302) : ?>
                    <script>
                        swal("Gagal!", "Data Lowongan Gagal Dihapus!", "error");
                    </script>
                <?php endif; ?>
            <?php endif;
            unset($_SESSION['pesan']);
            ?>

            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid mb-5">
                <div class="table-responsive" id="container">
                    <table class="table table-hover align-middle text-nowrap table-striped">
                        <thead class="table-dark">
                            <tr class="fw-semibold text-center">
                                <td>No</td>
                                <td>Nama Survei</td>
                                <td>Nama Pendaftar</td>
                                <td>Kecamatan</td>
                                <td>Tanggal Pekerjaan</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <?php $no = $awalData; ?>
                        <tbody>
                            <?php $pendaftar = mysqli_query($conn, "SELECT tb_lowongan_user.id, tb_lowongan_user.id_lowongan, 
                        tb_lowongan_user.id_petugas, tb_lowongan_user.tanggal_daftar, tb_lowongan_user.id_kec, tb_lowongan_user.umur, tb_lowongan_user.cv, tb_lowongan_user.ktp, tb_lowongan_user.ijazah, tb_lowongan_user.suratLamaran, tb_lowongan_user.suratDomisili, lowongan.jenis_lowongan,
                        lowongan.tanggal_mulai, lowongan.tanggal_akhir, lowongan.persyaratan, lowongan.deskripsi, lowongan.gambar, petugas.nama, petugas.Foto, tb_kecamatan.nama_kec FROM 
                        tb_lowongan_user LEFT JOIN lowongan ON lowongan.id=tb_lowongan_user.id_lowongan LEFT JOIN petugas ON 
                        petugas.kode_petugas=tb_lowongan_user.id_petugas LEFT JOIN tb_kecamatan ON tb_kecamatan.id=tb_lowongan_user.id_kec LEFT JOIN auth ON petugas.Kode_petugas=auth.Kode_petugas
                        WHERE tb_lowongan_user.L_action IS NULL AND auth.deleted=0 ORDER BY tb_lowongan_user.id DESC LIMIT $awalData, $jumlahDataPerHalaman"); ?>
                            <?php if (mysqli_num_rows($pendaftar) != 0) : ?>
                                <?php foreach ($pendaftar as $row) : ?>
                                    <tr class="text-start">
                                        <td scope="row" style="padding-bottom: 0; padding-top: 0;">
                                            <p class="text-dark"><?= $no = $no + 1; ?></p>
                                        </td>

                                        <td class="text-start text-dark text-wrap text-break" style="padding-bottom: 0; padding-top: 0; width: 10rem;">
                                            <?= $row['jenis_lowongan']; ?>

                                        <td class="text-center text-dark" style="padding-bottom: 0; padding-top: 0;">
                                            <?= $row['nama']; ?>
                                        </td>

                                        <td class="text-center text-dark" style="padding-bottom: 0; padding-top: 0;">
                                            <?= $row['nama_kec']; ?>
                                        </td>
                                        </td>
                                        <td class="text-center text-dark" style="padding-bottom: 0; padding-top: 0;">
                                            <?= date('d M Y', strtotime($row['tanggal_mulai'])); ?> &#8594;
                                            <?= date('d M Y', strtotime($row['tanggal_akhir'])); ?>
                                        </td>

                                        <td class="text-center">
                                            <button class="btn btn-success m-1 p- m-auto  text-center  text-white" data-bs-toggle="modal" data-bs-target="#Terima<?= $row['id']; ?>"><i class="mdi mdi-check"></i></button>
                                            <button class="btn btn-danger m-1 p- m-auto  text-center  text-white" data-bs-toggle="modal" data-bs-target="#Tolak<?= $row['id']; ?>"><i class="mdi mdi-close-outline"></i></button>
                                            <button class="btn btn-primary m-1 p- m-auto  text-center  text-white" data-bs-toggle="modal" data-bs-target="#detail<?= $row['id']; ?>">Detail</button>

                                        </td>
                                    </tr>

                                    <!-- Terima Lowongan -->
                                    <div class="modal fade " id="Terima<?= $row['id']; ?>" tabindex="-1" aria-labelledby="TerimaLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="TerimaLabel">Terima Pekerjaan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Anda yakin ingin Menerima Permohonan dari <strong><?= $row['nama']; ?></strong>?
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="../model/delete-lowongan-user.php" method="POST">
                                                        <input type="hidden" name="url" value="seleksi-daftar.php">
                                                        <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                                        <button type="submit" name="submit1" class="btn btn-success  text-white">Terima</button>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Tolak Lowongan -->
                                    <div class="modal fade " id="Tolak<?= $row['id']; ?>" tabindex="-1" aria-labelledby="TolakLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="TolakLabel">Tolak Pekerjaan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Anda yakin ingin Menolak Permohonan dari <strong><?= $row['nama']; ?></strong>?
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="../model/delete-lowongan-user.php" method="POST">
                                                        <input type="hidden" name="url" value="seleksi-daftar.php">
                                                        <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                                        <button type="submit" name="submit2" class="btn btn-danger text-white text-center ">Tolak</button>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal Detail -->
                                    <div class="modal fade" id="detail<?= $row['id']; ?>" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"><?= $row['jenis_lowongan']; ?></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="text-center">
                                                        <?php if ($row['Foto'] != null) : ?>
                                                            <a href="../public/img/user/<?= $row['Foto']; ?>" target="_blank"><img src="../public/img/user/<?= $row['Foto']; ?>" alt="<?= $row['Nama']; ?>" width="200" height="200" class="rounded-circle">
                                                            </a>
                                                        <?php else : ?>
                                                            <img src="../public/img/user/1.jpg" alt="<?= $row['Nama']; ?>" width="200" height="200" class="rounded-circle">
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col-5">Nama</div>
                                                        <div class="col-7"><?= $row['nama']; ?></div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col-5">Umur</div>
                                                        <div class="col-7"><?= $row['umur']; ?> Tahun</div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col-5">Kecamatan</div>
                                                        <div class="col-7"><?= $row['nama_kec']; ?></div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col-5">CV</div>
                                                        <div class="col-7"><a href="../public/data/<?= $row['cv']; ?>" target="_blank">Download</a></div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col-5">KTP</div>
                                                        <div class="col-7"><a href="../public/data/<?= $row['ktp']; ?>" target="_blank">Download</a></div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col-5">Ijazah</div>
                                                        <div class="col-7"><a href="../public/data/<?= $row['ijazah']; ?>" target="_blank">Download</a></div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col-5">Surat Lamaran</div>
                                                        <div class="col-7"><a href="../public/data/<?= $row['suratLamaran']; ?>" target="_blank">Download</a></div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col-5">Surat Domisili</div>
                                                        <div class="col-7"><a href="../public/data/<?= $row['suratDomisili']; ?>" target="_blank">Download</a></div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col-5">Persyaratan</div>
                                                        <div class="col-7"><?= $row['persyaratan']; ?></div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col-5">Deskripsi</div>
                                                        <div class="col-7"><?= $row['deskripsi']; ?></div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col-5">Tanggal Mulai</div>
                                                        <div class="col-7"><?= date('d F Y', strtotime($row['tanggal_mulai'])); ?></div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col-5">Tanggal Berakhir</div>
                                                        <div class="col-7"><?= date('d F Y', strtotime($row['tanggal_akhir'])); ?></div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <td colspan="6" class="text-center fw-bold">BELUM ADA PERMOHONAN</td>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="col mt-2" style="position: absolute; right: 150px">
                    <nav aria-label="...">
                        <ul class="pagination">

                            <?php if ($halamanAktif > 1) : ?>
                                <li class="page-item">
                                    <span class="page-link"><a href="?page=<?= $halamanAktif - 1; ?>" style="text-decoration: none;">Previous</a></span>
                                </li>
                            <?php else : ?>
                                <li class="page-item disabled">
                                    <span class="page-link">Previous</span>
                                </li>
                            <?php endif; ?>

                            <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                                <?php if ($i == $halamanAktif) : ?>
                                    <li class="page-item active" aria-current="page">
                                        <span class="page-link"><a href="?page=<?= $i; ?>" class="text-white" style="text-decoration: none;"><?= $i; ?></a></span>
                                    </li>
                                <?php else : ?>
                                    <li class="page-item"><a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a></li>
                                <?php endif; ?>
                            <?php endfor; ?>

                            <?php if ($halamanAktif < $jumlahHalaman) : ?>
                                <li class="page-item">
                                    <span class="page-link"><a href="?page=<?= $halamanAktif + 1; ?>" style="text-decoration: none;">Next</a></span>
                                </li>
                            <?php else : ?>
                                <li class="page-item disabled">
                                    <span class="page-link">Next</span>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
            </div>


            <!-- Modal Tambah User -->
            <div class="modal fade " id="TambahLowongan" tabindex="-1" aria-labelledby="TambahLowonganLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="TambahLowonganLabel">Tambah Akun</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="../model/tambah-lowongan.php" method="POST" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="mb-3 row">
                                    <label for="gambar" class="col-md-4 col-form-label">Gambar Lowongan</label>
                                    <div class="col-sm-8">
                                        <input type="file" name="foto" class="form-control" id="gambar" required accept="image/*">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="Jenis" class="col-md-4 col-form-label">Jenis Lowongan</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="jenis" class="form-control" id="Jenis" required maxlength="200">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="syarat" class="col-md-4 col-form-label">Persyaratan</label>
                                    <div class="col-sm-8">
                                        <textarea name="syarat" id="syarat" cols="37" class="form-control" rows="5" required></textarea>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="deskripsi" class="col-md-4 col-form-label">Deskripsi</label>
                                    <div class="col-sm-8">
                                        <textarea name="deskripsi" id="deskripsi" cols="37" class="form-control" rows="5" required></textarea>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="tglmulai" class="col-md-4 col-form-label">Tanggal Mulai</label>
                                    <div class="col-sm-8">
                                        <input type="date" name="tglmulai" class="form-control" id="tglmulai" required maxlength="50">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="tglakhir" class="col-md-4 col-form-label">Tanggal Akhir</label>
                                    <div class="col-sm-8">
                                        <input type="date" name="tglakhir" class="form-control" id="tglakhir" required maxlength="50">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" name="tambah-lowongan" class="btn btn-primary">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

            <?php include 'footer.php'; ?>

        <?php else : ?>
            <?php header("Location: index.php"); ?>
        <?php endif; ?>