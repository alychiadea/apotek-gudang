<?php

require_once '../../_init.php';

if(isset($_POST['dataidobat'])) {
	$kode_obat = $_POST['dataidobat'];

  // fungsi query untuk menampilkan data dari tabel obat
  $query = mysqli_query($mysqli, "SELECT kode_obat,nama_obat,satuan,stok FROM obat WHERE kode_obat='$kode_obat'")
                                  or die('Ada kesalahan pada query tampil data obat: '.mysqli_error($mysqli));

  // tampilkan data
  $data = mysqli_fetch_assoc($query);

  $stok   = $data['stok'];
  $satuan = $data['satuan'];

	if($stok != '') {
		echo "<div class='form-group'>
                <label class='col-sm-2 control-label'>Stok</label>
                <div class='col-sm-5'>
                  <div class='input-group'>
                    <input type='text' class='form-control' id='stok' name='stok' value='$stok' readonly>
                    <span class='input-group-addon'>$satuan</span>
                  </div>
                </div>
              </div>";
	} else {
		echo "<div class='form-group'>
                <label class='col-sm-2 control-label'>Stok</label>
                <div class='col-sm-5'>
                  <div class='input-group'>
                    <input type='text' class='form-control' id='stok' name='stok' value='Stok obat tidak ditemukan' readonly>
                    <span class='input-group-addon'>Satuan obat tidak ditemukan</span>
                  </div>
                </div>
              </div>";
	}		
}
?> 