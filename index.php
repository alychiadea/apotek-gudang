<?php
require_once "helper/fungsi.php";
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Login | Aplikasi Persediaan Obat</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="description" content="Aplikasi Persediaan Obat pada Apotek">
  <meta name="author" content="Indra Styawantoro" />
  <link rel="shortcut icon" href="assets/img/favicon.png" />
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/plugins/font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />
  <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
</head>

<body class="login-page bg-login">
  <div class="login-box">
    <div style="color:#3c8dbc" class="login-logo">
      <img style="margin-top:-12px" src="assets/img/apklogo.png" alt="Logo" height="50"> <b>Apotek Enggal Waras</b>
    </div><!-- /.login-logo -->
    <?php if (isset($_GET['alert'])) : ?>
      <?php if ($_GET['alert'] == 1) : ?>
        <?= alert('Username atau Password salah, cek kembali Username dan Password Anda.', 'Gagal Login!', 'danger', 'times') ?>
      <?php elseif ($_GET['alert'] == 2) : ?>
        <?= alert('Anda telah berhasil logout.') ?>
      <?php endif ?>
    <?php endif ?>
    <div class="login-box-body">
      <p class="login-box-msg"><i class="fa fa-user icon-title"></i> Silahkan Login</p>
      <br />
      <form action="login-check.php" method="POST">
        <div class="form-group has-feedback">
          <input type="text" class="form-control" name="username" placeholder="Username" autocomplete="off" required />
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" name="password" placeholder="Password" required />
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <br />
        <div class="row">
          <div class="col-xs-12">
            <input type="submit" class="btn btn-primary btn-lg btn-block btn-flat" name="login" value="Login" />
          </div><!-- /.col -->
        </div>
      </form>
    </div><!-- /.login-box-body -->
  </div><!-- /.login-box -->
  <script src="assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
  <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
</body>

</html>