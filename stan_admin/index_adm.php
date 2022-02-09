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
document.getElementById('navnav').children[0].setAttribute('class','active');
</script>
<div class="container">
    <div class="dropdown btn-group pull-right" id="sortmenu">
      <button class="btn btn-default" id="dropdownMenu" type="button" title="Метод сортировки будет сохранен!">
      <span class="glyphicon glyphicon-question-sign"></span> Сортировка</button>
      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        <span class="caret"></span>
      </button>
      <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
       <li role="presentation"><a role="menuitem" href="index_adm.php?sort=def" id="sortdef">Обычная</a></li>
       <li role="presentation" class="divider"></li>
       <li role="presentation"><a role="menuitem" href="index_adm.php?sort=hot" id="sorthot">Горячие вверху</a></li>
       <li role="presentation"><a role="menuitem" href="index_adm.php?sort=sold" id="sortsold">Продано вверху</a></li>
       <li role="presentation"><a role="menuitem" href="index_adm.php?sort=solddown" id="sortsolddown">Продано внизу</a></li>
       <li role="presentation"><a role="menuitem" href="index_adm.php?sort=date" id="sortdate">Дата</a></li>
      </ul>
    </div>
    <div class="clearfix"></div>
    <hr/>
   <div class="row">
<?php
$sort = $_GET['sort'];

include('../db.php');

if ( $sort == 'date' ) {
    $sort_query = " SELECT * FROM stock ORDER BY date DESC ";
    mysqli_query($connection, " UPDATE sort SET sort_Method='$sort_query' ");
};
if ( $sort == 'def' ) {
    $sort_query = " SELECT * FROM stock ORDER BY id ASC ";
    mysqli_query($connection, " UPDATE sort SET sort_Method='$sort_query' ");
};
if ( $sort == 'hot' ) {
    $sort_query = " SELECT * FROM stock ORDER BY hot DESC ";
    mysqli_query($connection, " UPDATE sort SET sort_Method='$sort_query' ");
};
if ( $sort == 'sold' ) {
    $sort_query = " SELECT * FROM stock ORDER BY sold ASC ";
    mysqli_query($connection, " UPDATE sort SET sort_Method='$sort_query' ");
};
if ( $sort == 'solddown' ) {
    $sort_query = " SELECT * FROM stock ORDER BY sold DESC ";
    mysqli_query($connection, " UPDATE sort SET sort_Method='$sort_query' ");
};

$result_sort = mysqli_query($connection, " SELECT * FROM sort ");
$row_sort = mysqli_fetch_assoc($result_sort);

$result = mysqli_query($connection, $row_sort['sort_Method'] );

while($row = mysqli_fetch_assoc($result))
{?>
<div id="<?php echo $row['id'];?>" class="col-md-3 prj-item col-sm-6">
	    <div class="ratio">
          <div class="ratio-inner ratio-4-3">
             <div class="ratio-content">
			   <a href="show_pos_adm.php?id=<?php echo $row['id'];?>">
			    <div class="text-primary"><strong><?php echo $row['short_name'];?></strong>
                </div>
                <img src="<?php 
                  $rid = $row['id'];
	              $img_res = mysqli_query($connection, "  SELECT img_name FROM images WHERE pos_id='$rid' ");
	              $images = mysqli_fetch_assoc($img_res);
	              if ( empty($images) ) {
		             echo $uploaddir."/".$row['default_img'];
	              } else {
		              echo $uploaddir."/".$images['img_name'];
	                };?>" class="img-responsive">
			  </a>
             </div>
          </div>
          <input type="hidden" name="hot" id="hot" value="<?php echo $row['hot']; ?>" />
          <input type="hidden" name="sold" id="sold" value="<?php echo $row['sold']; ?>" />
		  <a href="show_pos_adm.php?id=<?php echo $row['id'];?>">
		  <div class="text-muted margtop">
            <small class="glyphicon glyphicon-calendar pull-left"> <?php echo date_create( $row['date'] )->Format('d.m.Y'); ?></small>
            <small class="glyphicon glyphicon-eye-open pull-right"> <?php echo $row['view'];?></small>
          </div>
		  <div class="clearfix"></div>
		  </a><br/>
		  <a href="edit_form_adm.php?id=<?php echo $row['id'];?>" class="btn btn-default">
            <span class="glyphicon glyphicon-pencil"></span> Edit</a>
          <a href="delete.php?id=<?php echo $row['id'];?>&dellpos=1" class="btn btn-default">
            <span class="glyphicon glyphicon-remove"></span> Delete</a>
          <?php 
                  if ( $row['sold'] < 0 ) {?>
                    <span class="label label-danger hotLable">Sold</span>
                 <?php } else if ( $row['hot'] > 0 ) {?>
                    <span class="label label-success hotLable"><span class="glyphicon glyphicon-fire"></span> ХОТ</span>
                 <?php } ?>
		  <hr/>
        </div>
    </div><!--item-->
<?php } mysqli_close($connection);?>

   </div>
    <h4><hr/><p><a href="add_form_adm.php" class="btn btn-primary"><span class="glyphicon glyphicon-file"></span><strong> Добавить позицию</strong></a></p></h4>
</div>
<input type="hidden" id="sorttype" value="<?php echo $row_sort['sort_Method']; ?>" />
<?php
	include('bottomScripts_adm.php');
?>
<script src="../js/putsort.js?ver=101"></script>
</body>
</html>
<?php
	}
?>