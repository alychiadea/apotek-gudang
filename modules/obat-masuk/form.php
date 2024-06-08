<?php
$query_obat = mysqli_query($mysqli, "SELECT * FROM obat ORDER BY nama_obat ASC") or die('Ada kesalahan pada query tampil obat: ' . mysqli_error($mysqli));
$obat_by_codes = [];
while ($data_obat = mysqli_fetch_object($query_obat)) {
  $obat_by_codes[$data_obat->kode_obat] = $data_obat;
}
?>

<?php
// fungsi untuk pengecekan tampilan form
// jika form add data yang dipilih
if ($_GET['form'] == 'add') { ?>
  <!-- tampilan form add data -->
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-edit icon-title"></i> Input Data Obat Masuk
    </h1>
    <ol class="breadcrumb">
      <li><a href="?module=beranda"><i class="fa fa-home"></i> Beranda </a></li>
      <li><a href="?module=obat_masuk"> Obat Masuk </a></li>
      <li class="active"> Tambah </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <!-- form start -->
          <form role="form" class="form-horizontal" action="modules/obat-masuk/proses.php?act=insert" method="POST" name="formObatMasuk">
            <div class="box-body">
              <?php
              // fungsi untuk membuat kode transaksi
              $query_id = mysqli_query($mysqli, "SELECT RIGHT(kode_transaksi,7) as kode FROM obat_masuk
                                                ORDER BY kode_transaksi DESC LIMIT 1")
                or die('Ada kesalahan pada query tampil kode_transaksi : ' . mysqli_error($mysqli));

              $count = mysqli_num_rows($query_id);

              if ($count <> 0) {
                // mengambil data kode transaksi
                $data_id = mysqli_fetch_assoc($query_id);
                $kode    = $data_id['kode'] + 1;
              } else {
                $kode = 1;
              }

              // buat kode_transaksi
              $tahun          = date("Y");
              $buat_id        = str_pad($kode, 7, "0", STR_PAD_LEFT);
              $kode_transaksi = "TM-$tahun-$buat_id";
              ?>

              <div class="form-group">
                <label class="col-sm-2 control-label">Kode Transaksi</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="kode_transaksi" value="<?= $kode_transaksi; ?>" readonly required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Tanggal</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control date-picker" data-date-format="dd-mm-yyyy" name="tanggal_masuk" autocomplete="off" value="<?= date("d-m-Y"); ?>" required>
                </div>
              </div>

              <hr>

              <div class="form-group">
                <label class="col-sm-2 control-label">Obat</label>
                <div class="col-sm-5">
                  <select id="id_obat" class="chosen-select" name="kode_obat" data-placeholder="-- Pilih Obat --" autocomplete="off" required>
                    <option value=""></option>
                    <?php foreach ($obat_by_codes as $obat) : ?>
                      <option value="<?= $obat->kode_obat ?>"><?= $obat->kode_obat . ' | ' . $obat->nama_obat ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
              </div>

              <span>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Stok</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" id="stok" name="stok" readonly required>
                  </div>
                </div>
              </span>
              <div class="form-group">
                <label class="col-sm-2 control-label">Harga Beli</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="harga_beli" name="harga_beli" autocomplete="off" required readonly>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Harga Jual</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="harga_jual" name="harga_jual" autocomplete="off" required readonly>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Jumlah Masuk</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="jumlah_masuk" name="jumlah_masuk" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Total Stok</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="total_stok" name="total_stok" readonly required>
                </div>
              </div>

            </div><!-- /.box body -->

            <div class="box-footer">
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <input type="submit" class="btn btn-primary btn-submit" name="simpan" value="Simpan">
                  <a href="?module=obat_masuk" class="btn btn-default btn-reset">Batal</a>
                </div>
              </div>
            </div><!-- /.box footer -->
          </form>
        </div><!-- /.box -->
      </div><!--/.col -->
    </div> <!-- /.row -->
  </section><!-- /.content -->
<?php
}
?>
<?php ob_start() ?>
<script>
  var obat_by_codes = <?= json_encode($obat_by_codes) ?>;

  $(document).ready(function() {
    let allowSubmit = false;

    $('#form').submit(function(e) {
      if (!allowSubmit) {
        alert('stok tidak boleh nol');
        $('#jumlah_masuk').focus();
        $('#jumlah_masuk').select();
        e.preventDefault();
        return false;
      }

      return true;
    });

    function update_total_stok() {
      let stok_baru = parseInt($('#stok').val()) + parseInt($('#jumlah_masuk').val());
      $('#total_stok').val(stok_baru);

      if (stok_baru < 0) {
        allowSubmit = false;
      } else {
        allowSubmit = true;
      }
    }
    $('#jumlah_masuk').keyup(function() {
      update_total_stok();
    });
    $('#id_obat').change(function() {
      const kode = $(this).val()
      let obat = obat_by_codes[kode];

      if (!obat) {
        $('#stok').val(0);
        $('#total_stok').val(0);
        $('#harga_beli').val(0);
        $('#harga_jual').val(0);
        allowSubmit = false;
        // reset
        return;
      }

      $('#stok').val(obat.stok);
      $('#harga_beli').val(obat.harga_beli);
      $('#harga_jual').val(obat.harga_jual);
      update_total_stok();
    });
  });
</script>
<?php $footscript = ob_get_clean() ?>