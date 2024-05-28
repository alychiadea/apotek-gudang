<?php

require_once "../../_init.php";

$hari_ini = date("Y-m-d");
$list_obat = get_all_obat_kosong();

?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>LAPORAN STOK OBAT</title>
    <link rel="stylesheet" type="text/css" href="../../assets/css/laporan.css" />
</head>

<body>
    <div><img src="../../assets/img/logo.jpg" width="50" height="50" alt=""></div>
    <div id="title">
        <h4>LAPORAN STOK OBAT KOSONG<br>APOTEK ENGGAL WARAS</h4>
        <p><?= tgl_eng_to_ind($hari_ini) ?></p>
    </div>
    <div id="isi">
        <table class="table" width="100%" border="0.3" cellpadding="0" cellspacing="0">
            <thead style="background:#e8ecee">
                <tr class="tr-title">
                    <th height="20" align="center" valign="middle">NO.</th>
                    <th height="20" align="center" valign="middle">KODE OBAT</th>
                    <th height="20" align="center" valign="middle">NAMA OBAT</th>
                    <th height="20" align="center" valign="middle">HARGA BELI (Rp.)</th>
                    <th height="20" align="center" valign="middle">HARGA JUAL (Rp.)</th>
                    <th height="20" align="center" valign="middle">STOK</th>
                    <th height="20" align="center" valign="middle">SATUAN</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($list_obat as $no => $data) : ?>
                    <tr>
                        <td width='40' height='13' align='center'><?= $no + 1 ?></td>
                        <td width='80' height='13' align='left'><?= $data['kode_obat'] ?></td>
                        <td style='padding-left:5px;' width='180' height='13' align='left'><?= strtoupper($data['nama_obat']) ?></td>
                        <td style='padding-right:10px;' width='80' height='13' align='right'><?= format_angka($data['harga_beli']) ?></td>
                        <td style='padding-right:10px;' width='80' height='13' align='right' valign='middle'><?= format_angka($data['harga_jual']) ?></td>
                        <td style='padding-right:10px;' width='80' height='13' align='right' valign='middle'><?= format_angka($data['stok']) ?></td>
                        <td width='80' height='13' align='left' valign='middle'><?= strtoupper($data['satuan']) ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>

        <div id="footer-tanggal">
            Talaga, <?php echo tgl_eng_to_ind("$hari_ini"); ?>
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