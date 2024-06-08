<ul class="sidebar-menu">
  <li class="<?= $_GET["module"] == "beranda" ? 'active' : '' ?>">
    <a href="?module=beranda"><i class="fa fa-home"></i> Beranda </a>
  </li>
  <?php if ($_SESSION['hak_akses'] == 'Owner' || $_SESSION['hak_akses'] == 'Admin') : ?>
    <li class="<?= $_GET["module"] == "obat" || $_GET["module"] == "form_obat" ? 'active' : '' ?>">
      <a href="?module=obat"><i class="fa fa-th"></i> Data Obat </a>
    </li>
    <li class="<?= $_GET["module"] == "obat_masuk" || $_GET["module"] == "form_obat_masuk" ? 'active' : '' ?>">
      <a href="?module=obat_masuk"><i class="fa fa-sign-in"></i> Data Obat Masuk </a>
    </li>
    <li class="<?= $_GET["module"] == "obat_keluar" || $_GET["module"] == "form_obat_keluar" ? 'active' : '' ?>">
      <a href="?module=obat_keluar"><i class="fa fa-sign-out"></i> Data Obat Keluar </a>
    </li>
  <?php endif ?>
  <?php if ($_SESSION['hak_akses'] == 'Owner' || $_SESSION['hak_akses'] == 'Admin') : ?>
    <li class="<?= $_GET["module"] == "lap_stok_kosong" || $_GET["module"] == "lap_stok" || $_GET["module"] == "lap_obat_masuk" || $_GET["module"] == "lap_obat_keluar" ? 'active' : '' ?> treeview">
      <a href="javascript:void(0);">
        <i class="fa fa-file-text"></i> <span>Laporan</span> <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li class="<?= $_GET["module"] == "lap_stok_kosong" ? 'active' : '' ?>"><a href="?module=lap_stok_kosong"><i class="fa fa-circle-o"></i> Stok Obat Kosong </a></li>
        <li class="<?= $_GET["module"] == "lap_stok" ? 'active' : '' ?>"><a href="?module=lap_stok"><i class="fa fa-circle-o"></i> Stok Obat </a></li>
        <li class="<?= $_GET["module"] == "lap_obat_masuk" ? 'active' : '' ?>"><a href="?module=lap_obat_masuk"><i class="fa fa-circle-o"></i> Obat Masuk </a></li>
        <li class="<?= $_GET["module"] == "lap_obat_keluar" ? 'active' : '' ?>"><a href="?module=lap_obat_keluar"><i class="fa fa-circle-o"></i> Obat Keluar </a></li>
      </ul>
    </li>
  <?php endif ?>
  <?php if ($_SESSION['hak_akses'] == 'Admin') : ?>
    <li class="<?= $_GET["module"] == "user" || $_GET["module"] == "form_user" ? 'active' : '' ?>">
      <a href="?module=user"><i class="fa fa-user"></i> Manajemen User</a>
    </li>
  <?php endif ?>
  <li class="<?= $_GET["module"] == "password" ? 'active' : '' ?>">
    <a href="?module=password"><i class="fa fa-lock"></i> Ubah Password</a>
  </li>
</ul>