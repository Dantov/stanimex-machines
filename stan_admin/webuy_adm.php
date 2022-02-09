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
<script>"use strict";document.getElementById('navnav').children[3].setAttribute('class','active');</script>
<div class="container">
  <div class="row">

<?php 

if( isset($_POST['save']) ) {
    include('../db.php');
    $count = $_POST['count'];
    
    for ( $i = 1; $i <= $count; $i++ ) {
        //взяли id 
        $n = "this".$i;
        $this_id = $_POST[$n];
        //взяли текст из поля
        $txtA_name = "webuy".$i;
        $txtA_val = $_POST[$txtA_name];
        
        if ( !empty( $this_id ) ) {
            $res = mysqli_query($connection, "  SELECT * FROM webuy WHERE id='$this_id' ");
            $row = mysqli_fetch_assoc($res);
            
            if ( $txtA_val == $row['name'] ) continue;
            $quertext = mysqli_query($connection, " UPDATE webuy SET name='$txtA_val' WHERE id='$this_id' ");
            ?>
            <div class="col-xs-12 sect-headr">
              <div class="alert alert-info" role="alert">
	           <h4>
                 Обновлена запись: <strong><?php echo $txtA_val; ?></strong>
               </h4>
               <a href="webuy_adm.php" type="button" class="btn btn-warning">OK</a>
              </div>
            </div>
            <?php
        } else {
            $query_add = mysqli_query($connection, " INSERT INTO webuy SET name='$txtA_val' "); 
             ?> 
             <div class="col-xs-12 sect-headr">
              <div class="alert alert-info" role="alert">
	           <h4>
                 Добавлена запись: <strong><?php echo $txtA_val; ?></strong>
               </h4>
               <a href="webuy_adm.php" type="button" class="btn btn-warning">OK</a>
              </div>
            </div>          
            <?php
        }

    }
     mysqli_close($connection);
  }

include('../db.php');

$result = mysqli_query($connection, " SELECT * FROM webuy ");
$amount = mysqli_num_rows($result);


mysqli_close($connection);
$idd = 1;
?>
    <center><p class="lead text-info" align="center" >Редактировать: <strong>Мы Покупаем</strong></p></center>

    <form method="post" action="webuy_adm.php" enctype = "multipart/form-data" id="form_webuy">
         <?php
           while($row = mysqli_fetch_assoc($result)) {
         ?>
          <div class="col-xs-12">
            <p>
              <span><?php echo $idd;?></span>
              <textarea id="descr<?php echo $idd;?>" class="form-control" rows="5" name="webuy<?php echo $idd;?>"><?php echo $row['name']; ?></textarea>
            </p>
            <input type="hidden" name="this<?php echo $idd++;?>" value="<?php echo $row['id'];?>" />
            <a class="btn btn-default" type="button" href="delete.php?id=<?php echo $row['id'];?>&dellwebuy=1">
            <span class="glyphicon glyphicon-trash"></span> Удалить</a>
            <hr />
          </div>
          
          <?php	}?>
          <a id="nxt" class="btn btn-default" type="button" href="index_adm.php">
            <span class="glyphicon glyphicon-triangle-left"></span> Назад</a>
          <input class="btn btn-default" type="button" id="add" value="Добавить" />
          <input type="hidden" name="count" id="count" value="<?php echo $amount;?>" />
          <button class="btn btn-default" type="submit" name="save">
          <span class="glyphicon glyphicon-floppy-disk"></span> Сохранить</button>
	</form>
<hr />
</div>
</div><!--container-->
<script src="../js/addWebuy.js?ver=113"></script>
<?php
	include('bottomScripts_adm.php');
?>
<div class="txtArea_proto" id="txtArea_proto">
  <p><span></span><textarea id="descr" class="form-control" rows="5" name="webuy"></textarea></p>
  <input type="hidden" name="this" value="" />
  <hr />
</div>
</body>
</html>
<?php } ?>