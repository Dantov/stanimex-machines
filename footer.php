<div class="container">
   <div class="row">

	  <span style="position:relative; top: 0; left: 0; display: block;">
        <img src="css/img/S.png" class="footer-logo">
      </span>

    <div class="col-md-4 copy col-sm-6">
	 <p>
	 <?php
	    
		include('db.php');
		$result = mysqli_query($connection, " SELECT * FROM aboutus WHERE id='5' ");
        $row = mysqli_fetch_assoc($result);
        mysqli_close($connection);
		
		echo $row['text']; 
		
     ?> 
	 </p>
    </div><!--contacts-->
	
    <div class="col-md-6 ftnav col-md-offset-2 col-sm-6">
     <ul>
      <li><a onClick="$('.slidr').animatescroll({scrollSpeed:2000, padding:80});" href="index.php">Домой</a></li>
      <li><a onClick="$('.about').animatescroll({scrollSpeed:2000, padding:80});" href="index.php#about">О Нас</a></li>
	  <li><a onClick="$('.about').animatescroll({scrollSpeed:2000, padding:80});" href="price.php">Прайс-Лист</a></li>
	  <li><a onClick="$('.hotsell').animatescroll({scrollSpeed:2000, padding:80});" href="index.php#hotsell">Срочно</a></li>
      <li><a onClick="$('.projects').animatescroll({scrollSpeed:2000, padding:80});" href="index.php#webuy">Мы Покупаем</a></li>
      <li><a onClick="$('.contact').animatescroll({scrollSpeed:2000, padding:80});" href="index.php#contact">E-mail</a></li>
     </ul>
    </div><!--ftnav-->
	
    <div class="col-xs-12 copy padd-bott-copy">
       <span><center>&copy; Stanimex 2017. Все права защищены</center></span>
    </div><!--copy-->
   </div><!--row-->
</div><!--container-->