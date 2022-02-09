<?php
if ( !empty($_POST['login']) && !empty($_POST['pass']) ) {
        $login = 'stanimex123';
		$pass = 'stan_admin';
		
	if ( $_POST['login'] == $login && $_POST['pass'] == $pass ) {
	session_start();
	$sid=session_id();
    $_SESSION['access']=true;
    header("location: stan_admin/index_adm.php?".session_name().'='.session_id());
} else {?>

<!DOCTYPE HTML>
<html>
<head>
  <?php include('head.php'); ?>
  <style>
  body {
    background: url('css/img/about-bg.png');
  }
  </style>
</head>
<body>
<div class="container">
<div class="col-xs-12">
<br />
<form id="auth_form" method="post" action="stanadmin.php">
 <fieldset>
  <legend><span class="glyphicon glyphicon-lock"></span> Вход в Stanimex admin-mode</legend>
  <div class="form-group">
   <label for="inputLogin">Логин</label>
   <input type="text" name="login" id="Login" required placeholder="Введите логин" class="form-control">
  </div>
  <div class="form-group">
   <label for="inputPassword">Пароль</label>
   <input type="password" name="pass" id="Pass" required placeholder="Введите пароль" class="form-control">
  </div>
  <p style="color: red;">Логин или пароль не верные!</p>
  <a class="btn btn-default" type="button" href="index.php"><span class="glyphicon glyphicon-triangle-left"></span> Назад</a>
  <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-log-in"></span>&#160; Войти</button>
 </fieldset>
</form>
</div>
</div>
<script src="js/bootstrap.min.js"></script>
</body>
</html>

    <?php }
} else {
?>

<!DOCTYPE HTML>
<html>
<head>
  <?php include('head.php'); ?>
  <style>
  body {
    background: url('css/img/about-bg.png');
  }
  </style>
</head>
<body>
<div class="container">
<div class="col-xs-12">
<br />
<form id="auth_form" method="post" action="stanadmin.php">
 <fieldset>
  <legend><span class="glyphicon glyphicon-lock"></span> Вход в Stanimex admin-mode</legend>
  <div class="form-group">
   <label for="inputLogin">Логин</label>
   <input type="text" name="login" id="Login" required placeholder="Введите логин" class="form-control">
  </div>
  <div class="form-group">
   <label for="inputPassword">Пароль</label>
   <input type="password" name="pass" id="Pass" required placeholder="Введите пароль" class="form-control">
  </div>
  <a class="btn btn-default" type="button" href="index.php"><span class="glyphicon glyphicon-triangle-left"></span> Назад</a>
  <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-log-in"></span>&#160; Войти</button>
 </fieldset>
</form>
</div>
</div>
<?php
	include('stan_admin/bottomScripts_adm.php');
?>
</body>
</html>
<?php
  }
?>