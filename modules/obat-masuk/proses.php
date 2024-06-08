<?php

require_once '../../_init.php';

if ($_GET['act'] == 'insert') {
    if (isset($_POST['simpan'])) {
        // ambil data hasil submit dari form
        $kode_transaksi = mysqli_real_escape_string($mysqli, trim($_POST['kode_transaksi']));

        $tanggal         = mysqli_real_escape_string($mysqli, trim($_POST['tanggal_masuk']));
        $exp             = explode('-', $tanggal);
        $tanggal_masuk   = $exp[2] . "-" . $exp[1] . "-" . $exp[0];

        $kode_obat       = mysqli_real_escape_string($mysqli, trim($_POST['kode_obat']));
        $jumlah_masuk    = mysqli_real_escape_string($mysqli, trim($_POST['jumlah_masuk']));
        $total_stok      = mysqli_real_escape_string($mysqli, trim($_POST['total_stok']));

        $created_user    = $_SESSION['id_user'];
        $obat = mysqli_query($mysqli, "select * from obat where kode_obat='$kode_obat'")->fetch_object();
        $harga_beli = $obat->harga_beli;
        $harga_jual = $obat->harga_jual;
        
        // perintah query untuk menyimpan data ke tabel obat masuk
        $query = mysqli_query($mysqli, "INSERT INTO obat_masuk(kode_transaksi,tanggal_masuk,kode_obat,jumlah_masuk,harga_beli,harga_jual,created_user) 
                                            VALUES('$kode_transaksi','$tanggal_masuk','$kode_obat','$jumlah_masuk','$harga_beli','$harga_jual','$created_user')")
            or die('Ada kesalahan pada query insert : ' . mysqli_error($mysqli));

        // cek query
        if ($query) {
            // perintah query untuk mengubah data pada tabel obat
            $query1 = mysqli_query($mysqli, "UPDATE obat SET stok        = '$total_stok'
                                                              WHERE kode_obat   = '$kode_obat'")
                or die('Ada kesalahan pada query update : ' . mysqli_error($mysqli));

            // cek query
            if ($query1) {
                // jika berhasil tampilkan pesan berhasil simpan data
                header("location: ../../main.php?module=obat_masuk&alert=1");
            }
        }
    }
} else if ($_GET['act'] == 'delete') {
    $kode_transaksi = mysqli_real_escape_string($mysqli, trim($_GET['kode_transaksi']));

    $query = mysqli_query($mysqli, "SELECT * FROM obat_masuk WHERE kode_transaksi='$kode_transaksi'")
        or die('Ada kesalahan pada query delete : ' . mysqli_error($mysqli));
    $obat_masuk = mysqli_fetch_assoc($query);
    $kode_obat = $obat_masuk['kode_obat'];
    $query = mysqli_query($mysqli, "SELECT * FROM obat WHERE kode_obat='$kode_obat'")
        or die('Ada kesalahan pada query delete : ' . mysqli_error($mysqli));
    $obat = mysqli_fetch_assoc($query);
    $stok_sebelumnya = $obat['stok'] - $obat_masuk['jumlah_masuk'];

    mysqli_begin_transaction($mysqli);
    // perintah query untuk mengembalikan stok pada tabel obat
    $query = mysqli_query($mysqli, "UPDATE obat SET stok='$stok_sebelumnya' WHERE kode_obat='$kode_obat'")
        or die('Ada kesalahan pada query update : ' . mysqli_error($mysqli));
    // perintah query untuk menghapus data pada tabel obat masuk
    $query = mysqli_query($mysqli, "DELETE FROM obat_masuk WHERE kode_transaksi='$kode_transaksi'")
        or die('Ada kesalahan pada query delete : ' . mysqli_error($mysqli));
    mysqli_commit($mysqli);

    header("location: ../../main.php?module=obat_masuk&alert=2");
}
