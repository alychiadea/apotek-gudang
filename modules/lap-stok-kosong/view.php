<?php $data_obat = get_all_obat_kosong() ?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-file-text-o icon-title"></i> Laporan Stok Obat Kosong
    <a class="btn btn-primary btn-social pull-right" href="modules/lap-stok-kosong/cetak.php" target="_blank">
      <i class="fa fa-print"></i> Cetak
    </a>
  </h1>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-body">
          <table id="dataTables1" class="table table-bordered table-striped table-hover">
            <thead>
              <tr>
                <th class="center">No.</th>
                <th class="center">Kode Obat</th>
                <th class="center">Nama Obat</th>
                <th class="center">Harga Beli (Rp.)</th>
                <th class="center">Harga Jual (Rp.)</th>
                <th class="center">Stok</th>
                <th class="center">Satuan</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($data_obat as $no => $data) : ?>
                <tr>
                  <td width='30' class='center'><?= $no + 1 ?></td>
                  <td width='80' class='center'><?= $data['kode_obat'] ?></td>
                  <td width='180'><?= $data['nama_obat'] ?></td>
                  <td width='100' class='right'><?= format_angka($data['harga_beli']) ?></td>
                  <td width='100' class='right'><?= format_angka($data['harga_jual']) ?></td>
                  <td width='80' class='right'><?= format_angka($data['stok']) ?></td>
                  <td width='80' class='center'><?= $data['satuan'] ?></td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!--/.col -->
  </div> <!-- /.row -->
</section><!-- /.content