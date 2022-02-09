<!DOCTYPE html>
<html lang="ru">
  <head>
    <?php

	  include('head.php');
      
      include('inc/db_.php');
      
      mysqli_query($db_stats, " UPDATE visits SET index_visited=index_visited+1 WHERE date='$date' ");

      mysqli_close($db_stats);

	?>
  </head>
  <body>

<div class="container-fluid p0">
    <?php
	  include('navbar-top.php');  
	?>
 <div class="slidr" id="slidr">
  <img src="css/img/mainslidr.gif">
  <div class="buttons">
    <button class="controls" id="previous">&lt;</button>
    <button class="controls" id="pause">&#10074;&#10074;</button>
    <button class="controls" id="next">&gt;</button>
  </div>
 </div><!--slider-->
 
 <div class="col-md-12 call-to-action p0">
   <ul class="nav nav-justified sect-headr">
   <li><a href="price.php"><i><img src="picts/stank_for_price.png" width="45px"></i> Полный Прайс-Лист</a></li>
   </ul>  
   <a name="about"></a>
 </div>
 
 <div class="clearfix"></div>
 
 <div class="about">
  <div class="container">
   
    <div class="col-md-12 sect-headr">
     <h2>О <span>Нас</span></h2>
     <h4>Станимэкс покупает и продает бывшие в эксплуатации металлорежущие станки.</h4>
    </div><!--section header-->
    <div class="clearfix"></div>
    
    <div class="about-text">
	   <?php
	    include('db.php');
        $result = mysqli_query($connection, " SELECT * FROM aboutus ");
        ?>
     <p> 
	   <?php 
	       $row = mysqli_fetch_assoc($result);
	       echo $row['text'];
	   ?>
	 </p>
     <h4></h4><br /><br />
     <p>
	   <?php 
	       $row = mysqli_fetch_assoc($result);
	       echo $row['text'];
	   ?>
	 </p>
     <h4></h4><br /><br />
     <p>
	   <?php 
	       $row = mysqli_fetch_assoc($result);
	       echo $row['text'];
	   ?>
	 </p>
     <p>
	   <?php 
	       $row = mysqli_fetch_assoc($result);
	       echo $row['text'];
	   ?>
	 </p>
     <h4>Контакты</h4>
     <p>
	   <?php 
	       $row = mysqli_fetch_assoc($result);
	       echo $row['text'];
	   ?>
	 </p>
    </div><!--about text-->
	<a name="hotsell"></a>
  </div><!--container-->
 </div><!--about-->
 
 <div class="service hotsell">
  <div class="container">
    <div class="col-md-12 sect-headr">
     <h2>С<span>рочно</span></h2>
     <h4>Наше оборудование для срочной продажи</h4>
    </div><!--section header-->
    <div class="clearfix"></div>
   <div class="row"> 
    <?php 
      $result = mysqli_query($connection, "SELECT * FROM stock WHERE hot='1' OR sold='-1' " );
      $uploaddir = "Stockimages/";
      
      while($row = mysqli_fetch_assoc($result))
      {?>
    <div class="col-md-3 prj-item col-sm-6">
	    <div class="ratio img-thumbnail">
		 <a href="showpos.php?id=<?php echo $row['id'];?>">
          <div class="ratio-inner ratio-4-3">
                 <?php // проверка на хот
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
		  <div class="text-primary"><strong><?php echo $row['short_name'];?></strong></div>
		  </a>
        </div>
    </div><!--item-->
    <?php } ?>
    
   </div><!--row-->
   <a name="webuy"></a>
  </div><!--container-->
 </div><!--projects-->

 <div class="projects webuy">
  <div class="container">
    
    <div class="col-md-12 sect-headr">
     <h2>Мы <span>Покупаем</span></h2>
     <h4>Сегодня мы покупаем</h4>
    </div><!--section header-->
    <div class="clearfix"></div>
	
	<div class="table-responsive">
      <table class="table table-hover">
	    <thead>
          <tr class="">
           <th>№</th><th>Наименование</th>
          </tr>
       </thead>
        <tbody>
         <?php
           
           $result_webuy = mysqli_query($connection, " SELECT * FROM webuy ");
           $amount = mysqli_num_rows($result_webuy);
           
           mysqli_close($connection);
           $idd = 1;
           
           while($row = mysqli_fetch_assoc($result_webuy)) 
           {?>
          <tr>
           <td><?php echo $idd++;?></td><td><?php echo $row['name']; ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    
  </div><!--container-->
 </div><!--projects-->   
 
 <div class="clients">
  <div class="container">
    <div class="morelogos">
     <img src="brand_logos/WMW_logo.JPG">
     <img src="brand_logos/Sedin.JPG">
     <img src="brand_logos/studer_logo.png">
     <img src="brand_logos/Churchill_logo.JPG">
     <img src="brand_logos/hause-bienne_logo.jpg">
     <img src="brand_logos/kellenberger-studer_logo.jpg">
	 <img src="brand_logos/jones-shipman_logo.jpg">
     <img src="brand_logos/sip_logo.png">
     <img src="brand_logos/WMW_Schriftzug_logo.jpg">
     <img src="brand_logos/bwf-logo.jpg">
     <img src="brand_logos/microsa_logo.gif">
     <img src="brand_logos/TOS_logo.JPG">
     <img src="brand_logos/schaudt_logo.jpg">
     <img src="brand_logos/voumard_logo.jpg">
     <img src="brand_logos/elb_logo.gif">
     <img src="brand_logos/blohm_logo.jpg">
     <img src="brand_logos/dixi_logo.jpg">
     <img src="brand_logos/MIKRON-Logo.jpg">
     <img src="brand_logos/htg_logo.jpg">
     <img src="brand_logos/sip_logo-1.jpg">
     <img src="brand_logos/tripet-machines_logo.jpg">
	</div>
  </div>
 </div><!--clients-->
 
 <div class="map">
 <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d906.9315787503408!2d36.2369984398198!3d49.98904947577284!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sru!2sru!4v1508611878073" height="444" style="border-bottom:3px solid #18c08f;width:100%; border-top:0 none; border-left:0 none; border-right:0 none;"></iframe>
 </div><!--map-->
 <a name="contact"></a>
 <div class="contact">
  <div class="container">
   
    <div class="col-md-12 sect-headr">
     <h2>Свяжитесь <span>с Нами</span></h2>
     <h4></h4>
    </div><!--section header-->
    <div class="clearfix"></div>
    
   <div class="row"> 
    <form id="send_mail_form" method="post" action="stan_admin/send_mail.php">
     <div class="col-md-6 col-sm-6">
      <div class="row">
          <div class="form-group col-md-12 connm">
             <label>Ваше Имя <span id="nameValid">*</span></label>
             <input type="text" class="form-control" size="40" value="" name="your-name" id="your-name">
          </div>
          
          <div class="form-group col-md-12 conem">
             <label>Ваш Email <span id="emailValid">*</span></label>
             <input type="email" class="form-control" size="40" value="" name="your-email" id="your-email">
          </div>
          
          <div class="form-group col-md-12 conem">
             <label>Тема <span id="subjectValid">*</span></label>
             <input type="text" class="form-control" size="40" value="" name="your-subject" id="your-subject">
          </div>
       </div><!--row-->   
     </div><!--col-md-6-->
     <div class="col-md-6 col-sm-6">
      <div class="row">
          <div class="form-group col-md-12 conmm">
             <label>Сообщение <span id="messageValid">*</span></label>
             <textarea class="form-control" rows="10" cols="40" name="your-message" id="your-message"></textarea>
          </div>
      </div><!--row-->
     </div><!--col6-->
     <div class="clearfix"></div>
	 <?php
         $sended = $_GET['sended'];
         
         if ( !isset( $sended ) ) {
            ?>
              <div class="col-md-12 text-center"><input type="button" class="subbtn" value="Отправить" onclick="validall(this);"></div>
         <?php 
            }
         if ( $sended == 1 ) {
         ?>
            <div class="col-md-12 text-center">
              <div class="alert alert-info" role="alert">
                <a href="index.php#contact" type="button" class="close"><span class="glyphicon glyphicon-remove"></span></a>
                <h4 class="alert-link">
                   Сообщение отправлено. В ближайшее время мы свяжемся с Вами!
                </h4>
              </div>
            </div>
         <?php
           }
          if ( $sended == -1 ) {
                ?>
                <div class="col-md-12 text-center">
                  <div class="alert alert-danger" role="alert">
                    <a href="index.php#contact" type="button" class="close"><span class="glyphicon glyphicon-remove"></span></a>
                    <h4 class="alert-link">
                      При отправке сообщения произошла ошибка!
                    </h4>
                  </div>
                </div>
           <?php } ?>
    </form>
	
   </div><!--row--> 
  </div><!--container-->
 </div><!--contact-->    
 
 <div class="ftbg">
    <?php
	  include('footer.php');
	?>
 </div><!--footerbg-->
 
</div><!--container fluid-->

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script src="js/mainSlider.js?ver=101"></script>
	<script src="js/send_mail.js"></script>
  </body>
</html>