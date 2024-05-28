<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-th icon-title"></i> Data Obat
    <?php if ($_SESSION['hak_akses'] == 'Admin' || $_SESSION['hak_akses'] == 'Gudang') : ?>
      <a class="btn btn-primary btn-social pull-right" href="?module=form_obat&form=add" title="Tambah Data" data-toggle="tooltip">
        <i class="fa fa-plus"></i> Tambah
      </a>
    <?php endif ?>
  </h1>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <?php if (isset($_GET['alert'])) : ?>
        <?php if ($_GET['alert'] == 1) : ?>
          <?= alert('Data obat baru berhasil disimpan.') ?>
        <?php elseif ($_GET['alert'] == 2) : ?>
          <?= alert('Data obat baru berhasil diubah.') ?>
        <?php elseif ($_GET['alert'] == 3) : ?>
          <?= alert('Data obat baru berhasil dihapus.') ?>
        <?php endif ?>
      <?php endif ?>
      <div class="box box-primary">
        <div class="box-body">
          <!-- tampilan tabel obat -->
          <table id="dataTables1" class="table table-bordered table-striped table-hover">
            <!-- tampilan tabel header -->
            <thead>
              <tr>
                <th class="center">No.</th>
                <th class="center">Kode Obat</th>
                <th class="center">Nama Obat</th>
                <th class="center">Harga Beli (Rp.)</th>
                <th class="center">Harga Jual (Rp.)</th>
                <th class="center">Stok</th>
                <th class="center">Satuan</th>
                <?php if ($_SESSION['hak_akses'] == 'Admin' || $_SESSION['hak_akses'] == 'Gudang') : ?>
                  <th></th>
                <?php endif ?>
              </tr>
            </thead>
            <!-- tampilan tabel body -->
            <tbody>
              <?php
              $no = 1;
              // fungsi query untuk menampilkan data dari tabel obat
              $query = mysqli_query($mysqli, "SELECT kode_obat,nama_obat,harga_beli,harga_jual,satuan,stok FROM obat ORDER BY kode_obat DESC")
                or die('Ada kesalahan pada query tampil Data Obat: ' . mysqli_error($mysqli));
              ?>
              <?php while ($data = mysqli_fetch_assoc($query)) : ?>
                <tr>
                  <td width='30' class='center'><?= $no++ ?></td>
                  <td width='80' class='center'><?= $data['kode_obat'] ?></td>
                  <td width='180'><?= $data['nama_obat'] ?></td>
                  <td width='100' align='right'><?= format_rupiah($data['harga_beli']) ?></td>
                  <td width='100' align='right'><?= format_rupiah($data['harga_jual']) ?></td>
                  <td width='80' align='right' <?= $data['stok'] < 3 ? 'class="red"' : '' ?>><?= format_angka($data['stok']) ?></td>
                  <td width='80' class='center'><?= $data['satuan'] ?></td>
                  <?php if ($_SESSION['hak_akses'] == 'Admin' || $_SESSION['hak_akses'] == 'Gudang') : ?>
                    <td class='center' width='80'>
                      <div>
                        <a data-toggle='tooltip' data-placement='top' title='Ubah' style='margin-right:5px' class='btn btn-primary btn-sm' href='?module=form_obat&form=edit&id=<?= $data['kode_obat'] ?>'>
                          <i style='color:#fff' class='glyphicon glyphicon-edit'></i>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Hapus" class="btn btn-danger btn-sm" href="modules/obat/proses.php?act=delete&id=<?= $data['kode_obat'] ?>" onclick="return confirm('Anda yakin ingin menghapus obat <?= $data['nama_obat'] ?> ?');">
                          <i style="color:#fff" class="glyphicon glyphicon-trash"></i>
                        </a>
                      </div>
                    </td>
                  <?php endif ?>
                </tr>
              <?php endwhile ?>
            </tbody>
          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!--/.col -->
  </div> <!-- /.row -->
</section><!-- /.content