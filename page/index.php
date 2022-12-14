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

$data = mysqli_query($conn, "SELECT a.Kode_petugas, a.Username, a.Email, a.Password, a.Old_password, a.Last_login, a.Created_at, a.Updated_at, b.Nama, b.NIK, b.Alamat, b.Foto, b.NoHP, b.Tanggal_lahir, b.Tempat_lahir, b.Jkel, c.Jabatan, c.Id_jabatan FROM auth a, petugas b, jabatan c WHERE a.Kode_petugas=b.Kode_petugas AND b.Jabatan=c.Id_jabatan AND a.Kode_petugas='$kode' AND a.deleted=0 ORDER BY c.Id_jabatan");


$result1 = mysqli_fetch_assoc($data);



?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <title>Dashboard | Simitra</title>
    <?php include 'meta.php'; ?>
</head>

<body>

    <?php $url = "../"; ?>
    <?php include 'header.php'; ?>


    <!-- Alert Selamat Datang -->
    <?php $login = ""; ?>
    <?php if (isset($_SESSION['welcome'])) {
        $login = $_SESSION['welcome'];
    } else {
        $login = "";
    } ?>

    <script>
        let login = "<?= $login ?>";

        console.log(login);

        if (login != "") {
            swal("Selamat Datang", "@" + login, "success");
        }
    </script>
    <?php if (isset($_SESSION['pesan'])) :
        $pesan = $_SESSION['pesan'];
    ?>
        <?php if ($pesan == "berhasil") : ?>
            <script>
                swal("Berhasil!", "Berhasil Mendaftar Sebagai Petugas!", "success");
            </script>

        <?php elseif ($pesan == "gagal") : ?>
            <script>
                swal("Gagal!", "Gagal Mendaftar Sebagai Petugas!", "warning");
            </script>

        <?php elseif ($pesan == "already") : ?>
            <script>
                swal("Gagal!", "Sudah Mendaftar Sebagai Petugas!", "warning");
            </script>
        <?php elseif ($pesan == 205) : ?>
            <script>
                swal("Berhasil!", "Lowongan Berhasil Dibatalkan!", "success");
            </script>

        <?php elseif ($pesan == 305) : ?>
            <script>
                swal("Gagal!", "Lowongan Gagal Dibatalkan!", "warning");
            </script>
        <?php endif; ?>
    <?php endif; ?>


    <?php unset($_SESSION['welcome']);
    unset($_SESSION['pesan']);
    ?>


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
                    <li class="sidebar-item" style="background-color: #1a9bfc; border-radius: 9px"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="index.php" aria-expanded="false"><i class="mdi mdi-view-dashboard text-white"></i><span class="hide-menu text-white">Dashboard</span></a></li>

                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="profile.php" aria-expanded="false"><i class="fa-solid fa-circle-user"></i><span class="hide-menu">Profile</span></a></li>

                    <?php if ($result1['Id_jabatan'] == 2) :  ?>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="lowongan-user.php" aria-expanded="false"><i class="mdi mdi-worker"></i><span class="hide-menu">Survei Terdaftar</span></a></li>
                    <?php endif; ?>

                    <?php if ($result1['Id_jabatan'] == 1) {  ?>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="lowongan.php" aria-expanded="false"><i class="mdi mdi-file-document-box"></i><span class="hide-menu">Daftar Survei</span></a></li>

                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="seleksi-daftar.php" aria-expanded="false"><i class='far fa-handshake'></i><span class="hide-menu ">Seleksi
                                    Pendaftar</span></a></li>

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

                        <!-- <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown link
                        </a> -->


                    <?php } ?>

                    <li class="sidebar-item logout-item" style="position: fixed; bottom: 0; width: 220px">
                        <button class="dropdown-item border-0 btn btn-link" data-bs-toggle="modal" data-bs-target="#Logout">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i><span class="hide-menu">
                                Logout</span>
                        </button>
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
                            <li class="breadcrumb-item"><a href="#" class="link"><i class="mdi mdi-home-outline fs-4"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </nav>
                    <h1 class="mb-0 fw-bold">Dashboard</h1>
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
            <!-- ============================================================== -->
            <!-- Sales chart -->
            <!-- ============================================================== -->
            <div class="row">

                <!-- column daftar bangunan terbaru -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body" style="padding-bottom: 15px; padding-top: 25px;">
                            <!-- title -->
                            <div class="d-md-flex">
                                <div>
                                    <h4 class="card-title">Daftar Survei</h4>
                                    <h6 class="card-subtitle">Daftar Survei Badan Pusat Statistik Aceh Utara</h6>

                                    <div class="row">
                                        <?php $dataLowongan = mysqli_query($conn, "SELECT * FROM lowongan WHERE deleted=0"); ?>

                                        <?php foreach ($dataLowongan as $row) : ?>
                                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mx-auto">
                                                <div class="card-group">
                                                    <div class="card" style="width: 18rem;">
                                                        <img src="../public/img/assets/<?= $row['gambar']; ?>" class="card-img-top" alt="Image" height="230" width="200">
                                                        <div class="card-body">
                                                            <h5 class="card-title"><?= $row['jenis_lowongan']; ?></h5>
                                                            <p class="card-text"><?= $row['deskripsi']; ?></p>
                                                            <?php
                                                            $tanggalMulai = date('d M', strtotime($row['tanggal_mulai']));
                                                            $tanggalAkhir = date('d M Y', strtotime($row['tanggal_akhir']));

                                                            ?>

                                                            <div class="card-text mb-3">Tanggal : <?= $tanggalMulai; ?> -
                                                                <?= $tanggalAkhir; ?></div>

                                                            <?php $idLowongan = $row['id']; ?>
                                                            <?php $idPetugas = $result1['Kode_petugas']; ?>
                                                            <?php $cekDaftar = mysqli_query($conn, "SELECT * FROM tb_lowongan_user WHERE id_lowongan='$idLowongan' AND id_petugas='$idPetugas'");
                                                            $btnType = "btn-success ";
                                                            ?>

                                                            <?php if (mysqli_num_rows($cekDaftar) != 0) : ?>
                                                                <?php $dataLw = mysqli_fetch_assoc($cekDaftar); ?>
                                                                <?php $idTbLw = $dataLw['id']; ?>

                                                                <?php
                                                                $dataLowong = mysqli_fetch_assoc($cekDaftar);
                                                                $lulus = $dataLw['L_action'];

                                                                if ($lulus == "1") {
                                                                    $disable = "text-white disabled";
                                                                    $text = "Anda Dinyatakan Lulus";
                                                                    $batal = "";
                                                                } else if ($lulus == "2") {
                                                                    $disable = "text-white disabled";
                                                                    $text = "Anda Dinyatakan Tidak Diterima!";
                                                                    $batal = "";
                                                                    $btnType = "btn-danger ";
                                                                } else if (mysqli_num_rows($cekDaftar) == 1) {
                                                                    $disable = "text-white disabled";
                                                                    $text = "Sudah Mendaftar";
                                                                    $batal = "<button type='button' class='btn btn-danger mt-1 text-white text-center mb-2'
                                                                    data-bs-toggle='modal' data-bs-target='#Delete$idTbLw'> <i
                                                                        class='mdi mdi-trash'></i> Batal Daftar</button>";
                                                                } ?>
                                                            <?php else : ?>
                                                                <?php
                                                                $disable = "";
                                                                $text = "Daftar";
                                                                $batal = "";
                                                                ?>
                                                            <?php endif; ?>

                                                            <div class="text-center text-xl-end text-lg-end">
                                                                <?php if ($result1['Id_jabatan'] != "1") : ?>
                                                                    <?= $batal; ?>

                                                                    <button class="btn <?= $btnType; ?> mt-2 text-white <?= $disable; ?>" data-bs-toggle="modal" data-bs-target="#modal<?= $row['id']; ?>"><?= $text; ?></button>
                                                                <?php endif; ?>
                                                                <button class="btn btn-primary text-white mt-2" data-bs-toggle="modal" data-bs-target="#detail<?= $row['id']; ?>">Detail</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal -->
                                            <div class="modal fade" id="modal<?= $row['id']; ?>" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalLabel">
                                                                <?= ucwords($row['jenis_lowongan']); ?></h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="../model/lowongan.php" method="post" enctype="multipart/form-data">
                                                                <input type="hidden" name="idLowongan" value="<?= $row['id']; ?>">
                                                                <div class="modal-body">
                                                                    <div class="mb-3 row">
                                                                        <label for="Kabupaten" class="col-md-4 ">Kabupaten
                                                                        </label>
                                                                        <div class="col sm-8">
                                                                            <input type="text" value="Aceh Utara" disabled class="form-control">
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3 row">
                                                                        <div class="col-md-4">Kecamatan</div>
                                                                        <div class="col-md-8">
                                                                            <select name="kecamatan" class="form-select" id="select_boxx">
                                                                                <!-- <option>Pilih Kecamatan</option> -->
                                                                                <?php $kec = mysqli_query($conn, "SELECT * FROM tb_kecamatan"); ?>
                                                                                <?php foreach ($kec as $row) : ?>
                                                                                    <option value="<?= $row['id']; ?>">
                                                                                        <?= $row['nama_kec']; ?></option>
                                                                                <?php endforeach; ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3 row">
                                                                        <div class="col-md-4">Umur</div>
                                                                        <div class="col-md-4">
                                                                            <input type="number" class="form-control" name="umur" id="umur" min="15" max="50" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3 row">
                                                                        <div class="col-md-4">CV</div>
                                                                        <div class="col-md-8">
                                                                            <input type="file" class="form-control" name="cv" id="cv" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3 row">
                                                                        <div class="col-md-4">KTP</div>
                                                                        <div class="col-md-8">
                                                                            <input type="file" class="form-control" name="ktp" id="ktp" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3 row">
                                                                        <div class="col-md-4">Ijazah</div>
                                                                        <div class="col-md-8">
                                                                            <input type="file" class="form-control" name="ijazah" id="ijazah" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3 row">
                                                                        <div class="col-md-4">Surat Lamaran</div>
                                                                        <div class="col-md-8">
                                                                            <input type="file" class="form-control" name="suratLamaran" id="suratLamaran" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3 row">
                                                                        <div class="col-md-4">Surat Domisili</div>
                                                                        <div class="col-md-8">
                                                                            <input type="file" class="form-control" name="suratDomisili" id="suratDomisili" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-text mt-3">File : PDF, JPG, PNG, JPEG Max 2MB</div>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                    <button type="submit" name="daftarLowongan" class="btn btn-success text-white">Daftar</button>
                                                                </div>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>



                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- Recent comment and chats -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <?php foreach ($dataLowongan as $row) : ?>
            <!-- Modal Detail -->
            <div class="modal fade" id="detail<?= $row['id']; ?>" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><?= $row['jenis_lowongan']; ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
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

        <?php $kode = $result1['Kode_petugas']; ?>
        <?php $dataFull = mysqli_query($conn, "SELECT tb_lowongan_user.id, tb_lowongan_user.tanggal_daftar, lowongan.jenis_lowongan FROM tb_lowongan_user LEFT JOIN lowongan ON lowongan.id=tb_lowongan_user.id_lowongan WHERE id_petugas='$kode'"); ?>
        <?php foreach ($dataFull as $row) : ?>
            <!-- Modal Delete -->
            <div class="modal fade " id="Delete<?= $row['id']; ?>" tabindex="-1" aria-labelledby="DeleteLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="DeleteLabel">Hapus Pekerjaan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Anda yakin ingin Membatalkan Pekerjaan <strong><?= $row['jenis_lowongan']; ?></strong>?
                        </div>
                        <div class="modal-footer">
                            <form action="../model/delete-lowongan-user.php" method="POST">
                                <input type="hidden" name="url" value="index.php">
                                <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" name="submit" class="btn btn-danger text-white">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>


        <?php
        include 'footer.php';
        ?>