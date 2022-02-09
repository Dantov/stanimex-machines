<!DOCTYPE html>
<html lang="ru">
  <head>
    <?php
	  include('head.php');  
	?>
  </head>
  <body>
<div class="container-fluid p0">
   <?php
	  include('navbar-top.php');  
	?>
 <div class="clearfix"></div>
 
 <div class="topprices">
  <div class="container">
  </div><!--container-->
 </div>

 <div class="about">
  <div class="container">
	<br />
    <div class="row">
    <?php 
    
        $id = $_GET['id'];
        
        $uploaddir = "Stockimages/";
        $num = 0;
        include('db.php');
        
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
     
     // проверка на уникальный ip, добавляем посещение
     
     include('inc/db_.php');
     $current_ip = mysqli_query($db_stats, " SELECT * FROM ips WHERE ip_address='$visitor_ip' ");
     $row_ips = mysqli_fetch_assoc($current_ip);
     
     $string_counter = $row_ips['string_counter'];
     $pieces = explode(";", $string_counter);
     
     if ( !in_array($id, $pieces) ) {
        
       $incr_view = $row['view'] + 1;
       $string_counter = $string_counter . $id . ";";
       mysqli_query($db_stats, " UPDATE ips SET string_counter='$string_counter' WHERE ip_address='$visitor_ip' ");
       mysqli_query($connection, " UPDATE stock SET view='$incr_view' WHERE id='$id' ");
       
       mysqli_query($db_stats, " UPDATE posviews SET pos_string='$string_counter' WHERE ip='$visitor_ip' ");
       
     } else {
       $incr_view = $row['view'];
     }
     mysqli_close($db_stats);
     mysqli_close($connection);
     //

     ?>
	    <a class="text-info pull-left" href="<?php if ( !empty($prev_id) ) { 
            echo "showpos.php?id=$prev_id";
            } else {
             echo 'price.php';  
            }
            ?>" id="topprev"><h4><?php 
            if ( isset( $row_prev['short_name'] ) ) {
                echo "←".$row_prev['short_name'];
            } else {
                echo "";
            }
            ?></h4></a>
		<a class="text-info pull-right" href="<?php if ( !empty($next_id) ) { 
            echo "showpos.php?id=$next_id";
            } else {
             echo 'price.php';  
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
				  <center><img src="<?php echo "$uploaddir".$row_img['img_name'];?>" class="img-responsive image" num="<?php echo $num++; ?>"></center>
                  <span class="fa fa-search-plus fa-2x zoom" aria-hidden="true"></span>
                </div>
		</div>
     <?php while( $row_img_dop = mysqli_fetch_array($img) ) {?>
        <div class="col-xs-12 col-sm-6 col-md-4 image">
		  <div class="ratio">
            <div class="ratio-inner ratio-4-3">
              <div class="ratio-content">
			    <div class="image-zoom responsive">
                  <img src="<?php echo "$uploaddir".$row_img_dop['img_name'];?>" class="img-responsive image" num="<?php echo $num++; ?>">
				  <span class="fa fa-search-plus fa-2x zoom" aria-hidden="true"></span>
				</div>
				</div>
              </div>
            </div>
		</div><!-- small img end -->
     <?php }?>
      </div>
    </div><!-- images block -->
	
    <div class="col-xs-6 col-sm-5 col-sm-offset-1 descr">
      <p>
        <strong>Описание:</strong>
      </p>
      <?php echo $row['description'];?>
    </div>

</div><!--row-->

  <div class="row bg-info butt-inf">
      <input type="hidden" name="hot" id="hot" value="<?php echo $row['hot']; ?>" />
      <input type="hidden" name="sold" id="sold" value="<?php echo $row['sold']; ?>" />
      <small class="glyphicon glyphicon-calendar pull-left" title="Дата">&#160;<?php echo date_create( $row['date'] )->Format('d.m.Y'); ?></small>
	  <small class="glyphicon glyphicon-eye-open pull-right" title="Просмотры">&#160;<?php echo $incr_view;?></small> 
	  <div class="clearfix"></div>
  </div><!--section header-->
    
 <div class="clearfix"></div>
 
 <div class="row">
    <hr />
    <a class="btn btn-primary" role="button" href="price.php">
        <span class="glyphicon glyphicon-triangle-left"></span> Назад в Прайс
    </a>
 </div><!--row-->	
 </div><!--container-->
 </div><!--about-->
 
 <div class="ftbg">
    <?php
	  include('footer.php');
	?>
 </div><!--footerbg-->
 
</div><!--container fluid-->

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
<script src="js/gethotsold.js?ver=103"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/imageViewer.js?ver=108"></script>
</body>
</html>