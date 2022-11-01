<?php

// fungsi upload gambar
function upload($name, $path)
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

    move_uploaded_file($tmpName, '../public/data/' . $path . '/' . $namaFileBaru);

    return $namaFileBaru;
}
