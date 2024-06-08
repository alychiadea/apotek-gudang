<?php

require_once "../../_init.php";

$hari_ini = date("Y-m-d");
$tgl_awal = date_from_input($_GET['tgl_awal']);
$tgl_akhir = date_from_input($_GET['tgl_akhir']);

// fungsi query untuk menampilkan data dari tabel obat masuk
$query = mysqli_query($mysqli, "SELECT a.kode_transaksi,a.tanggal_masuk,a.kode_obat,a.jumlah_masuk,a.harga_beli,a.harga_jual,b.kode_obat,b.nama_obat,b.satuan
    FROM obat_masuk as a INNER JOIN obat as b ON a.kode_obat=b.kode_obat
    WHERE a.tanggal_masuk BETWEEN '$tgl_awal' AND '$tgl_akhir'
    ORDER BY a.kode_transaksi ASC")
    or die('Ada kesalahan pada query tampil Transaksi : ' . mysqli_error($mysqli));
$rows = [];
while ($row = mysqli_fetch_assoc($query)) {
    $rows[] = $row;
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>LAPORAN DATA OBAT MASUK</title>
    <link rel="stylesheet" type="text/css" href="../../assets/css/laporan.css" />
</head>

<body>
    <table style="margin-bottom: 10px;">
        <tr>
            <td>
                <img src="../../assets/img/logo.jpg" width="70" height="70" alt="">
            </td>
            <td class="title" style="text-align:left;padding-left:10px;">
                <h4>LAPORAN DATA OBAT MASUK<br>APOTEK ENGGAL WARAS</h4>
                <?php if ($tgl_awal == $tgl_akhir) : ?>
                    <div>Tanggal: <?= tgl_eng_to_ind($tgl_awal) ?></div>
                <?php else : ?>
                    <div>Tanggal: <?= tgl_eng_to_ind($tgl_awal) ?> s.d. <?= tgl_eng_to_ind($tgl_akhir) ?></div>
                <?php endif ?>
                <p>Jl. Jendral Ahmad Yani No. 27, Talagawetan</p>
            </td>
        </tr>
    </table>
    <div id="isi">
        <table class="table" width="100%" border="0.3" cellpadding="0" cellspacing="0">
            <thead style="background:#e8ecee">
                <tr class="tr-title">
                    <th height="20" align="center" valign="middle">NO.</th>
                    <th height="20" align="center" valign="middle">KODE TRANSAKSI</th>
                    <th height="20" align="center" valign="middle">TANGGAL</th>
                    <th height="20" align="center" valign="middle">KODE OBAT</th>
                    <th height="20" align="center" valign="middle">NAMA OBAT</th>
                    <th height="20" align="center" valign="middle">JUMLAH MASUK</th>
                    <th height="20" align="center" valign="middle">SATUAN</th>
                    <th height="20" align="center" valign="middle">HARGA BELI</th>
                    <th height="20" align="center" valign="middle">HARGA JUAL</th>
                    <th height="20" align="center" valign="middle">JUMLAH HARGA BELI</th>
                    <th height="20" align="center" valign="middle">JUMLAH HARGA JUAL</th>
                </tr>
            </thead>
            <tbody>
                <?php $total_harga_beli = 0; $total_harga_jual = 0; ?>
                <?php if (count($rows) == 0) : ?>
                    <tr>
                        <td colspan="7">Tidak ada data untuk ditampilkan.</td>
                    </tr>
                <?php else : ?>
                    <?php foreach ($rows as $no => $data) : ?>
                        <tr>
                            <td width='40' height='13' align='center' valign='middle'><?= $no + 1 ?></td>
                            <td width='120' height='13' align='center' valign='middle'><?= $data['kode_transaksi'] ?></td>
                            <td width='80' height='13' align='center' valign='middle'><?= tgl_indo_short($data['tanggal_masuk']) ?></td>
                            <td width='80' height='13' align='center' valign='middle'><?= $data['kode_obat'] ?></td>
                            <td style='padding-left:5px;' width='155' height='13' valign='middle'><?= $data['nama_obat'] ?></td>
                            <td style='padding-right:10px;' width='100' height='13' align='right' valign='middle'><?= format_angka($data['jumlah_masuk']) ?></td>
                            <td width='80' height='13' align='center' valign='middle'><?= $data['satuan'] ?></td>
                            <td style='padding-right:10px;' width='100' height='13' align='right' valign='middle'><?= format_angka($data['harga_beli']) ?></td>
                            <td style='padding-right:10px;' width='100' height='13' align='right' valign='middle'><?= format_angka($data['harga_jual']) ?></td>
                            <td style='padding-right:10px;' width='100' height='13' align='right' valign='middle'><?= format_angka($data['harga_beli'] * $data['jumlah_masuk']) ?></td>
                            <td style='padding-right:10px;' width='100' height='13' align='right' valign='middle'><?= format_angka($data['harga_jual'] * $data['jumlah_masuk']) ?></td>
                        </tr>
                        <?php $total_harga_beli += $data['harga_beli'] * $data['jumlah_masuk'] ?>
                        <?php $total_harga_jual += $data['harga_jual'] * $data['jumlah_masuk'] ?>
                    <?php endforeach ?>
                <?php endif ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="9" align="right">Total</th>
                    <th align="right"><?= format_angka($total_harga_beli) ?></th>
                    <th align="right"><?= format_angka($total_harga_jual) ?></th>
                </tr>
            </tfoot>
        </table>
        <div id="footer-tanggal">
            Talaga, <?= tgl_eng_to_ind("$hari_ini") ?>
        </div>
        <div id="footer-jabatan">
            Pimpinan
        </div>
        <div id="footer-nama">
            Juned
        </div>
    </div>
</body>

</html>