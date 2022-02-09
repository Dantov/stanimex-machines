<!DOCTYPE html>
<html lang="ru">
  <head>
    <?php
	  include('head.php'); 
      
      include('inc/db_.php');
      
      mysqli_query($db_stats, " UPDATE visits SET price_visited=price_visited+1 WHERE date='$date' ");

      mysqli_close($db_stats);

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
 </div><!--about-->

 <div class="service">
  <div class="container">
   
    <div class="col-md-12 sect-headr pricelist">
     <h2>Прайс-<span>Лист</span></h2>
     <h4 id="date"></h4>
	 <script>
	   var date = new Date();
       var date11 = document.getElementById('date');
	   
	   var strdate = date.toLocaleString("ru", { year: 'numeric', month: 'long' } );
	   var arr = strdate.split('');
	   arr[0] = arr[0].toUpperCase();
	   var strdate1 = arr.join('');
	   
	   date11.innerHTML = strdate1;
	 </script>
    </div><!--section header-->
	
    <div class="clearfix"></div>
    <div class="row">
	<?php
 
      include('db.php');
      
      $result_sort = mysqli_query($connection, " SELECT * FROM sort ");
      $row_sort = mysqli_fetch_assoc($result_sort);

      $result = mysqli_query($connection, $row_sort['sort_Method'] );
      $uploaddir = "Stockimages/";
      
      while($row = mysqli_fetch_assoc($result))
      {?>
    <div class="col-xs-6 col-md-3 prj-item col-sm-4">
	    <div class="ratio img-thumbnail">
		 <a href="showpos.php?id=<?php echo $row['id'];?>">
          <div class="ratio-inner ratio-4-3">
		    <?php   // проверка на хот / продан
                  if ( $row['sold'] < 0 ) {?>
                    <span class="label label-danger hotLable_main">
					  ПРОДАН
					</span>
                 <?php } else if ( $row['hot'] > 0 ) {?>
                    <span class="label label-success hotLable_main">
					  <span class="glyphicon glyphicon-fire"></span>
					  Горячий
					</span>
                 <?php } ?>
             <div class="ratio-content"> 
                <img src="<?php 
                  $rid = $row['id'];
	              $img_res = mysqli_query($connection, "  SELECT img_name FROM images WHERE pos_id='$rid' ");
	              $images = mysqli_fetch_assoc($img_res);
	              if ( empty($images) ) {
		             echo $uploaddir."/".$row['default_img'];
	              } else {
		              echo $uploaddir."/".$images['img_name'];
	                };?>" class="img-responsive">
                <div class="info">
				  <i></i>
                  <h5><?php echo $row['name'];?></h5>
                  <h6>Перейти</h6>
                </div>
             </div>
          </div>
		  <div class="text-muted margtop"><small class="glyphicon glyphicon-calendar pull-left"> <?php echo date_create( $row['date'] )->Format('d.m.Y'); ?></small><small class="glyphicon glyphicon-eye-open pull-right"> <?php echo $row['view'];?></small></div>
		  <div class="clearfix"></div>
		  <span class="text-primary"><strong><?php echo $row['short_name'];?></strong></span>
         </a>
		</div>
    </div><!--item-->
    <?php } mysqli_close($connection); ?>
    
   </div><!--row--> 
  </div><!--container--> 
 </div><!--about-->
 
 <div class="ftbg">
    <?php
	  include('footer.php');
	?>
 </div><!--footerbg-->
 
</div><!--container fluid-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>