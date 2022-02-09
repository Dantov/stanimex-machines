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
document.getElementById('navnav').children[1].setAttribute('class','active');
</script>

<div class="container">

     <center><p class="lead text-info" align="center" >Редактировать: <strong>О Нас</strong></p></center>

   <div class="row">
   <?php
   
     include_once('../db.php');

    if( isset($_POST['save']) ) {
    
    for ( $i = 1; $i < 5; $i++ ) {
        $name = "description".$i;
        $ff = trim($_POST[$name]);
        
		$quertext = mysqli_query($connection, " UPDATE aboutus SET text='$ff' WHERE id='$i' ");
	}
    if ( $quertext ) { ?>
       <div class="col-xs-12 sect-headr">
        <div class="alert alert-info" role="alert">
	      <h4>
            Изменения внесены.
          </h4>
          <a href="aboutUs_adm.php" type="button" class="btn btn-warning">OK</a>
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
          <a href="aboutUs_adm.php" type="button" class="btn btn-warning">OK</a>
        </div>
       </div>
     <?php }
     }
 ?>
     <form method="post" action="aboutUs_adm.php" enctype = "multipart/form-data">
 <?php
$result = mysqli_query($connection, " SELECT * FROM aboutus ");
mysqli_close($connection);

$iter = 0;
while($row = mysqli_fetch_assoc($result))
{ 
$iter++;
?>
    <div id="<?php echo $row['id'];?>" class="col-xs-12">
      <textarea id="descr" class="form-control" rows="5" name="description<?php echo $row['id'];?>"><?php echo $row['text'];?></textarea><br />
    </div>
<?php 
if ( $iter == 4 ) break;
} 
?>

    <a class="btn btn-default" type="button" href="index_adm.php">
        <span class="glyphicon glyphicon-triangle-left"></span> Назад</a>
    <button class="btn btn-default" type="submit" name="save">
        <span class="glyphicon glyphicon-floppy-disk"></span> Сохранить</button>
   </form>
   </div>
</div>

<?php
	include('bottomScripts_adm.php');
?>
</body>

</html>
<?php } ?>