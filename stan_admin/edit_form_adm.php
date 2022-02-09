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
<?php
$id = $_GET['id'];
include_once('../db.php');

$result = mysqli_query($connection, " SELECT * FROM stock WHERE id='$id' ");
$img = mysqli_query($connection, "  SELECT * FROM images WHERE pos_id='$id' ");

$row = mysqli_fetch_assoc($result);

mysqli_close($connection);

$uplF = 0;

?>
<div class="container">
	   
    <p id="topName" class="text-warning" align="center">Редактировать: <strong><?php echo $row['short_name'];?></strong></p>

    <form method="post" action="edit.php?id=<?php echo $id;?>" enctype = "multipart/form-data">
        <div class="form-group foreditnames">
           <label for="longName">
           <span class="glyphicon glyphicon-question-sign" title="Будет видна когда открыта позиция"></span> Полное Имя:</label>
           <input id="longName" type="text" name="name" class="form-control" value="<?php echo $row['name'];?>">
        </div>
         <div class="form-group">
           <label for="shortName">
           <span class="glyphicon glyphicon-question-sign" title="Основное, будет видна в таблице прайс-лист, до 40 символов!"></span> Короткое Имя:</label>
           <input id="shortName" type="text" name="short_name" class="form-control" value="<?php echo $row['short_name'];?>">
        </div>
		<hr />
        <div class="row">
          <div class="col-xs-6 col-sm-5 col-md-5 sect-headr" id="picts">
              <?php while( $row_img = mysqli_fetch_array($img) ) {?>
                <div id="img_<?php echo $uplF;?>" class="image_row">
				  <input class="dopImg" type="file" name="upload_file_img<?php echo $uplF++; ?>" />
                  <img src="<?php echo $uploaddir."/".$row_img['img_name'];?>" width="200px" class="dopImg"/>
				  <input type="hidden" name="img_row_id_<?php echo $uplF;?>" value="<?php echo $row_img['id'];?>" />
				  <a class="btn btn-default" role="button" href="delete.php?id=<?php echo $id;?>&imgname=<?php echo $row_img['img_name'];?>">
                  <span class="glyphicon glyphicon-trash"></span> удалить</a>
				  <hr />
                </div>
              <?php }?>
			  <a class="btn btn-default" id="add_img" role="button">
                <span class="glyphicon glyphicon-picture"></span> Добавить картинку</a>
          </div>
          <div class="col-xs-6 col-sm-7 col-md-7 sect-headr">
		    <label for="descr">Описание:</label>
            <textarea id="descr" class="form-control" rows="18" name="description"><?php echo $row['description']; ?></textarea>
          </div>
        </div><!--row-->
		
        <hr />
	    <p>
           Просмотры: <input type="text" name="views" value="<?php echo $row['view']; ?>" /> &#160;
           <span class="glyphicon glyphicon-calendar"></span>
            Дата создания: <span><?php echo date_create( $row['date'] )->Format('d.m.Y'); ?></span>
           <input type="hidden" name="date" id="date" value="<?php echo $row['date']; ?>" />&#160;
           <input class="btn btn-default btn-xs" type="button" name="renewdate" id="renewdate" value="Обновить дату" />
        </p>
        
        <input type="hidden" name="img_count" id="img_count" value="<?php echo $uplF; ?>" />
	    <a class="btn btn-default" role="button" href="index_adm.php">
        <span class="glyphicon glyphicon-triangle-left"></span> Назад</a>
	    <button class="btn btn-default" type="submit" name="save">
        <span class="glyphicon glyphicon-floppy-disk"></span> Сохранить</button>
        <input class="btn btn-warning" type="button" name="makehot" id="makeHot" value="Сделать HOT" />
        <input type="hidden" name="hot" id="hot" value="<?php echo $row['hot']; ?>" />
        <input class="btn btn-danger" type="button" name="makesold" id="makeSold" value="Сделать SOLD" />
        <input type="hidden" name="sold" id="sold" value="<?php echo $row['sold']; ?>" />
        <a class="btn btn-danger mrgnLeft" role="button" href="delete.php?id=<?php echo $id;?>&dellpos=1">
        <span class="glyphicon glyphicon-remove"></span> Удалить позицию</a>
	</form>
<hr />
</div><!--container-->

<div id="img_" class="image_row_proto" >
    <input class="load_image_form" type="file" name="upload_file_img" accept="image/jpeg,image/png,image/gif"/>
    <img src="<?php echo $uploaddir."/default.jpg"; ?>" width="200px" />
	<input type="hidden" name="img_row_id_" value="" />
	<hr />
</div>

<script src="../js/add_img.js?ver=105"></script>
<?php
	include('bottomScripts_adm.php');
?>
</body>
</html>
<?php
	}
?>