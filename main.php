<?php

require_once '_init.php';

// jika user sudah login, maka jalankan perintah untuk pemanggilan file halaman konten
$content = '';
switch ($_GET['module']) {
  case 'beranda': $content = 'beranda/view'; break;
  case 'obat': $content = 'obat/view'; break;
  case 'form_obat': $content = 'obat/form'; break;
  case 'obat_masuk': $content = 'obat-masuk/view'; break;
  case 'form_obat_masuk': $content = 'obat-masuk/form'; break;
  case 'obat_keluar': $content = 'obat-keluar/view'; break;
  case 'form_obat_keluar': $content = 'obat-keluar/form'; break;
  case 'lap_stok_kosong': $content = 'lap-stok-kosong/view'; break;
  case 'lap_stok': $content = 'lap-stok/view'; break;
  case 'lap_obat_masuk': $content = 'lap-obat-masuk/view'; break;
  case 'lap_obat_keluar': $content = 'lap-obat-keluar/view'; break;
  case 'user': $content = 'user/view'; break;
  case 'form_user': $content = 'user/form'; break;
  case 'profil': $content = 'profil/view'; break;
  case 'form_profil': $content = 'profil/form'; break;
  case 'password': $content = 'password/view'; break;
}
$content_path = 'modules/' . $content . '.php';

ob_start(); ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Admin Panel | Aplikasi Persediaan Obat</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="description" content="Aplikasi Persediaan Obat pada Apotek">
  <meta name="author" content="" />
  <link rel="shortcut icon" href="assets/img/favicon.png" />
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/plugins/font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
  <link href="assets/plugins/datepicker/datepicker.min.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" type="text/css" href="assets/plugins/chosen/css/chosen.min.css" />
  <link href="assets/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/css/skins/skin-blue.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
  <link href="assets/css/style.css" rel="stylesheet" type="text/css" />

  <!-- Fungsi untuk membatasi karakter yang diinputkan -->
  <script language="javascript">
    function getkey(e) {
      if (window.event)
        return window.event.keyCode;
      else if (e)
        return e.which;
      else
        return null;
    }

    function goodchars(e, goods, field) {
      var key, keychar;
      key = getkey(e);
      if (key == null) return true;

      keychar = String.fromCharCode(key);
      keychar = keychar.toLowerCase();
      goods = goods.toLowerCase();

      // check goodkeys
      if (goods.indexOf(keychar) != -1)
        return true;
      // control keys
      if (key == null || key == 0 || key == 8 || key == 9 || key == 27)
        return true;

      if (key == 13) {
        var i;
        for (i = 0; i < field.form.elements.length; i++)
          if (field == field.form.elements[i])
            break;
        i = (i + 1) % field.form.elements.length;
        field.form.elements[i].focus();
        return false;
      };

      return false;
    }
  </script>
</head>

<body class="skin-blue fixed">
  <div class="wrapper">
    <header class="main-header">
      <a href="?module=beranda" class="logo">
        <!-- <img style="margin-top:-15px;margin-right:5px" src="assets/img/logo-blue.png" alt="Logo"> -->
        <span style="font-size:15px">Enggal Waras</span>
      </a>
      <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <?php include "top-menu.php" ?>
          </ul>
        </div>
      </nav>
    </header>
    <aside class="main-sidebar">
      <section class="sidebar">
        <?php include "sidebar-menu.php" ?>
      </section>
    </aside>
    <div class="content-wrapper">
      <?php include $content_path ?>
      <div class="modal fade" id="logout">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><i class="fa fa-sign-out"> Logout</i></h4>
            </div>
            <div class="modal-body">
              <p>Apakah Anda yakin ingin logout? </p>
            </div>
            <div class="modal-footer">
              <a type="button" class="btn btn-danger" href="logout.php">Ya, Logout</a>
              <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
    </div><!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2024 - Apotek Enggal Waras.</strong>
    </footer>
  </div><!-- ./wrapper -->
  <script src="assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
  <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="assets/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
  <script src="assets/plugins/chosen/js/chosen.jquery.min.js"></script>
  <script src="assets/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
  <script src="assets/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
  <script src="assets/plugins/datepicker/bootstrap-datepicker.min.js" type="text/javascript"></script>
  <script src="assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
  <script src='assets/plugins/fastclick/fastclick.min.js'></script>
  <script src="assets/js/jquery.maskMoney.min.js"></script>
  <script src="assets/js/app.min.js" type="text/javascript"></script>
  <script type="text/javascript">
    $(function() {
      // datepicker plugin
      $('.date-picker').datepicker({
        autoclose: true,
        todayHighlight: true
      });

      // chosen select
      $('.chosen-select').chosen({
        allow_single_deselect: true
      });
      //resize the chosen on window resize

      // mask money
      $('#harga_beli').maskMoney({
        thousands: '.',
        decimal: ',',
        precision: 0
      });
      $('#harga_jual').maskMoney({
        thousands: '.',
        decimal: ',',
        precision: 0
      });

      $(window)
        .off('resize.chosen')
        .on('resize.chosen', function() {
          $('.chosen-select').each(function() {
            var $this = $(this);
            $this.next().css({
              'width': $this.parent().width()
            });
          })
        }).trigger('resize.chosen');
      //resize chosen on sidebar collapse/expand
      $(document).on('settings.ace.chosen', function(e, event_name, event_val) {
        if (event_name != 'sidebar_collapsed') return;
        $('.chosen-select').each(function() {
          var $this = $(this);
          $this.next().css({
            'width': $this.parent().width()
          });
        })
      });

      $('#chosen-multiple-style .btn').on('click', function(e) {
        var target = $(this).find('input[type=radio]');
        var which = parseInt(target.val());
        if (which == 2) $('#form-field-select-4').addClass('tag-input-style');
        else $('#form-field-select-4').removeClass('tag-input-style');
      });

      // DataTables
      $("#dataTables1").dataTable();
      $('#dataTables2').dataTable({
        "bPaginate": true,
        "bLengthChange": false,
        "bFilter": false,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth": false
      });
    });
  </script>

</body>

</html>
<?php echo ob_get_clean() ?>