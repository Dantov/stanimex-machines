<?php
session_start();

if( !isset( $_SESSION['access'] ) || $_SESSION['access'] != true ){
header("location: ../stanadmin.php");
}
else{ ?>
<!DOCTYPE HTML>
<html>

<head>
  <link rel="stylesheet" href="../css/style.css?ver=106">
  <?php include('head_adm.php'); ?>
</head>

<body>
<?php
  include('navBar_adm.php');
?>
<?php
$id = $_GET['id'];

include_once('../db.php');

// начало опреределения пред и след позиции

$srtt = mysqli_query($connection, " SELECT * FROM sort ");
$sorttype = mysqli_fetch_assoc($srtt);
$srtMethod = $sorttype['sort_Method'];
$srtMethod = substr($srtMethod, 20, (strlen($srtMethod) - 1) );
$srtMethod = "SELECT id FROM stock " . $srtMethod;

$quer = mysqli_query( $connection, $srtMethod );

while ( $quer_stock = mysqli_fetch_assoc($quer) ) {
    $stock_ids[] = $quer_stock['id'];
}

$arr_length = count($stock_ids);

for ($i = 0; $i < $arr_length; $i++ ) {
    if ( $stock_ids[$i] == $id ) {
        $a = $i - 1;
        $b = $i + 1;
        $prev_id = $stock_ids[$a];
        $next_id = $stock_ids[$b];
        break;
    }
}

  $res_prev = mysqli_query( $connection, " SELECT short_name FROM stock WHERE id='$prev_id' " );
  $row_prev = mysqli_fetch_assoc($res_prev);
  
  $res_next = mysqli_query($connection, " SELECT short_name FROM stock WHERE id='$next_id' " );
  $row_next = mysqli_fetch_assoc($res_next);

// конец опреределения пред и след позиции

$result = mysqli_query($connection, "  SELECT * FROM stock WHERE id='$id' ");
$img = mysqli_query($connection, "  SELECT * FROM images WHERE pos_id='$id' ");

$row = mysqli_fetch_assoc($result);
$row_img = mysqli_fetch_assoc($img);

mysqli_close($connection);

?>
	<div class="container" id="id_<?php echo $row['id']?>">
	    <div class="row">
          <a class="text-info" href="<?php if ( !empty($prev_id) ) { 
            echo "show_pos_adm.php?id=$prev_id";
            } else {
             echo 'index_adm.php';  
            }
            ?>" id="topprev"><h4><?php 
            if ( isset( $row_prev['short_name'] ) ) {
                echo "←".$row_prev['short_name'];
            } else {
                echo "";
            }
            ?></h4></a>
			<a class="text-info" href="<?php if ( !empty($next_id) ) { 
            echo "show_pos_adm.php?id=$next_id";
            } else {
             echo 'index_adm.php';  
            }
            ?>" id="topnext"><h4><?php 
            if ( isset( $row_next['short_name'] ) ) {
                echo $row_next['short_name']."→";
            } else {
                echo "";
            } ?></h4></a>
			<hr/>
		<div class="clearfix"></div>
	    
        <h4 id="topName" class="text-primary well well-sm"><strong><?php echo $row['name'];?></strong></h4>
        
		<div class="col-xs-6 col-sm-6" id="images_block">
          <div class="row">
	  
            <div class="col-xs-12 mainImg">
			  <div class="image-zoom responsive">
			    <center><img src="<?php echo $uploaddir."/".$row_img['img_name'];?>" class="img-responsive image" num="<?php echo $num++; ?>"></center>
                <span class="fa fa-search-plus fa-2x zoom" aria-hidden="true"></span>
              </div>
		    </div>
            
            <?php while( $row_img_dop = mysqli_fetch_array($img) ) {?>
        <div class="col-xs-12 col-sm-6 col-md-4 image">
		  <div class="ratio">
            <div class="ratio-inner ratio-4-3">
              <div class="ratio-content">
			    <div class="image-zoom responsive">
                  <img src="<?php echo $uploaddir."/".$row_img_dop['img_name'];?>" class="img-responsive image" num="<?php echo $num++; ?>">
				  <span class="fa fa-search-plus fa-2x zoom" aria-hidden="true"></span>
				</div>
				</div>
              </div>
            </div>
		</div><!-- small img end -->
      <?php }?>
      </div><!-- row end -->
    </div><!-- images block -->
          
		<div class="col-xs-6 col-sm-5 col-sm-offset-1" id="descr">
          <p>
            <strong>Описание:</strong>
          </p>
        <?php echo $row['description'];?></div>
        </div><!--row-->
        
        <div class="row">
        
		<div class="bg-info butt-inf">
          <small class="glyphicon glyphicon-calendar pull-left" title="Дата">&#160;<?php echo date_create( $row['date'] )->Format('d.m.Y'); ?></small>
		  <small class="glyphicon glyphicon-eye-open pull-right" title="Просмотры">&#160;<?php echo $row['view'];?></small> 
		  <div class="clearfix"></div>
        </div><!--section header-->
		<hr/>
		<div class="butt-inf">
		   <a href="index_adm.php" class="btn btn-default"><span class="glyphicon glyphicon-triangle-left"></span> Назад</a>
           <input type="hidden" name="hot" id="hot" value="<?php echo $row['hot']; ?>" />
           <input type="hidden" name="sold" id="sold" value="<?php echo $row['sold']; ?>" />
		   <a href="edit_form_adm.php?id=<?php echo $row['id'];?>" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span> Edit</a>
		   <a href="delete.php?id=<?php echo $id;?>&dellpos=1" class="btn btn-default"><span class="glyphicon glyphicon-remove"></span> Delete</a>
		</div>
        
        </div>

	</div><!--container-->

<div id="popup" class="popup hidden_popup">
  <div id="blackCover"></div>
  
  <div class="toper_popup" id="toper_popup">
    <span id="img_count" class="img_count pull-left"></span>
	<span id="close_popup" class="close_popup pull-right"></span>
  </div>
  
  <div class="arrows" id="arrows">
    <div class="brackets pull-left" id="left-bracket" onclick="prevImg();"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span></div>
    <div class="brackets pull-right" id="right-bracket" onclick="nextImg();"><span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span></div>
  </div>
  
  <div class="popup_img" id="wrapper_img">
	<img src="" class="img-responsive">
  </div>

  <div class="footer_popup" id="footer_popup"><p></p></div>
</div>

<script src="../js/gethotsold.js?ver=102"></script>
<script src="../js/imageViewer.js?ver=104"></script>
<?php
	include('bottomScripts_adm.php');
?>
</body>
</html>
<?php
	}
?>