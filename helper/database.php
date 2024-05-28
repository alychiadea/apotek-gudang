<?php

// fungsi query untuk menampilkan data dari tabel obat
function get_jumlah_data_obat()
{
    global $mysqli;
    $query = mysqli_query($mysqli, "SELECT COUNT(kode_obat) as jumlah FROM obat")
        or die('Ada kesalahan pada query tampil Data Obat: ' . mysqli_error($mysqli));
    $data = mysqli_fetch_assoc($query);
    return $data['jumlah'];
}

// fungsi query untuk menampilkan data dari tabel obat masuk
function get_jumlah_data_obat_masuk()
{
    global $mysqli;
    $query = mysqli_query($mysqli, "SELECT COUNT(kode_transaksi) as jumlah FROM obat_masuk")
        or die('Ada kesalahan pada query tampil Data obat Masuk: ' . mysqli_error($mysqli));
    $data = mysqli_fetch_assoc($query);
    return $data['jumlah'];
}

// fungsi query untuk menampilkan data dari tabel obat keluar
function get_jumlah_data_obat_keluar()
{
    global $mysqli;
    $query = mysqli_query($mysqli, "SELECT COUNT(kode_transaksi) as jumlah FROM obat_keluar")
        or die('Ada kesalahan pada query tampil Data obat Masuk: ' . mysqli_error($mysqli));
    $data = mysqli_fetch_assoc($query);
    return $data['jumlah'];
}

function get_all_obat()
{
    global $mysqli;
    // fungsi query untuk menampilkan data dari tabel obat
    $query = mysqli_query($mysqli, "SELECT kode_obat,nama_obat,harga_beli,harga_jual,satuan,stok FROM obat ORDER BY nama_obat ASC")
        or die('Ada kesalahan pada query tampil Data Obat: ' . mysqli_error($mysqli));
    $rows = [];
    while ($row = mysqli_fetch_assoc($query)) {
        $rows[] = $row;
    }
    return $rows;
}

function get_all_obat_kosong()
{
    global $mysqli;
    // fungsi query untuk menampilkan data dari tabel obat
    $query = mysqli_query($mysqli, "SELECT kode_obat,nama_obat,harga_beli,harga_jual,satuan,stok FROM obat WHERE stok < 3 ORDER BY nama_obat ASC")
        or die('Ada kesalahan pada query tampil Data Obat: ' . mysqli_error($mysqli));
    $rows = [];
    while ($row = mysqli_fetch_assoc($query)) {
        $rows[] = $row;
    }
    return $rows;
}

function generate_kode_obat()
{
    global $mysqli;
    // fungsi untuk membuat kode
    $query_id = mysqli_query($mysqli, "SELECT RIGHT(kode_obat,6) as kode FROM obat ORDER BY kode_obat DESC LIMIT 1")
        or die('Ada kesalahan pada query tampil kode_obat : ' . mysqli_error($mysqli));

    $count = mysqli_num_rows($query_id);

    if ($count <> 0) {
        $data_id = mysqli_fetch_assoc($query_id);
        $kode    = $data_id['kode'] + 1;
    } else {
        $kode = 1;
    }

    $buat_id = str_pad($kode, 6, "0", STR_PAD_LEFT);
    
    return "B$buat_id";
}
