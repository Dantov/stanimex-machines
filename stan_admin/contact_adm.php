<?php
session_start();

if( !isset( $_SESSION['access'] ) || $_SESSION['access'] != true ){
header("location: ../stanadmin.php");
}
else{ ?>
<!DOCTYPE HTML>
<html>

<head>
  <?php include('head_adm.php'); ?>
</head>

<body>
<?php
  include('navBar_adm.php');
?>
<script>
"use strict"
document.getElementById('navnav').children[2].setAttribute('class','active');
</script>

<div class="container">
  <div class="row">
<?php
if( isset($_POST['save']) ) {
    $text = trim($_POST['contacts']);
    include('../db.php');
	$quertext = mysqli_query($connection, " UPDATE aboutus SET text='$text' WHERE id='5' ");

    if ( $quertext ) {?>
       <div class="col-xs-12 sect-headr">
        <div class="alert alert-info" role="alert">
	      <h4>
            Изменения внесены.
          </h4>
          <a href="contact_adm.php" type="button" class="btn btn-warning">OK</a>
        </div>
       </div>
<?php   
	 } else { ?>
	   <div class="col-xs-12 sect-headr">
        <div class="alert alert-danger" role="alert">
	      <h4>
           Проблемы с подключением к базе данных. Информация не внесена.<br />
           Свяжитесь с разработчиком. 
          </h4>
          <a href="contact_adm.php" type="button" class="btn btn-warning">OK</a>
        </div>
       </div>
     <?php }
     
     mysqli_close($connection);
  }
?>

<?php 

include('../db.php');

$result = mysqli_query($connection, " SELECT * FROM aboutus WHERE id='5' ");

$row = mysqli_fetch_assoc($result);

mysqli_close($connection);

?>
    <center><p class="lead text-info" align="center" >Редактировать: <strong>Контакты</strong></p></center>

    <form method="post" action="contact_adm.php" enctype = "multipart/form-data">
          <div class="col-xs-12 sect-headr">
            <p><textarea id="descr" class="form-control" rows="10" name="contacts"><?php echo $row['text']; ?></textarea></p>
          </div>
        <a class="btn btn-default" type="button" href="index_adm.php">
        <span class="glyphicon glyphicon-triangle-left"></span> Назад</a> 
        <button class="btn btn-default" type="submit" name="save">
        <span class="glyphicon glyphicon-floppy-disk"></span> Сохранить</button>
	</form>
<hr />
</div>
</div><!--container-->
<?php
	include('bottomScripts_adm.php');
?>
</body>

</html>
<?php } ?>