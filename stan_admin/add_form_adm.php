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

<div class="container">
    
	<p class="text-warning" align="center" id="topName"><strong>Добавить позицию</strong></p>
    
    <form method="post" action="add.php" enctype = "multipart/form-data">
        <div class="form-group foreditnames">
           <label for="longName"><span class="glyphicon glyphicon-question-sign" title="Будет видна когда открыта позиция"></span> Полное Имя:</label>
           <input id="longName" type="text" name="name" class="form-control" value="">
        </div>
         <div class="form-group">
           <label for="shortName">
           <span class="glyphicon glyphicon-question-sign" title="Основное, будет видна в таблице прайс-лист, до 40 символов!"></span> 
           Короткое Имя:</label>
           <input id="shortName" type="text" name="short_name" class="form-control" value="">
        </div>

        <div class="row">
      
          <div class="col-xs-6 col-sm-5 col-md-5 sect-headr" id="picts">
			  <a class="btn btn-default" id="add_img" role="button">
                <span class="glyphicon glyphicon-picture"></span> Добавить картинку</a>
          </div>
          <div class="col-xs-6 col-sm-7 col-md-7 sect-headr">
		    <label for="descr">Описание:</label>
            <textarea id="descr" class="form-control" rows="18" name="description"></textarea>
          </div>
          
        </div><!--row-->
        <hr />
        <a class="btn btn-default" role="button" href="index_adm.php">
        <span class="glyphicon glyphicon-triangle-left"></span> Назад</a>
	    <button class="btn btn-default" type="reset" >Очистить</button>
        <input class="btn btn-warning" type="button" name="makehot" id="makeHot" value="Сделать HOT" />
        <input type="hidden" name="hot" id="hot" value="0" />
        <input class="btn btn-danger" type="button" name="makesold" id="makeSold" value="Сделать SOLD" />
        <input type="hidden" name="sold" id="sold" value="0" />
	    <button class="btn btn-default" type="submit" name="save">
        <span class="glyphicon glyphicon-floppy-disk"></span> Сохранить</button>
		<input type="hidden" name="img_count" id="img_count" value="0" />
		<input type="hidden" name="views" value="0" />
	    <input type="hidden" name="date" value="<?php echo date('Y-m-d'); ?>" />
    </form>
</div><!--container-->

<div id="img_" class="image_row_proto" >
    <input class="load_image_form" type="file" name="upload_file_img" accept="image/jpeg,image/png,image/gif"/>
    <img src="<?php echo $uploaddir."/default.jpg"; ?>" width="200px" />
	<input type="hidden" name="img_row_id_" value="" />
	<hr />
</div>

<script src="../js/add_img.js?ver=102"></script>
<?php
	include('bottomScripts_adm.php');
?>
</body>
</html>
<?php } ?>