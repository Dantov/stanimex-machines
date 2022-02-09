<nav class="navbar navbar-fixed-top cpnav">
    <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">
		   <!-- <img src="css/img/logo_gear.png" class="brand-gear">-->
		    <div class="stanimex">
			  <span>Stanimex</span>
			  <p>станки и оборудование</p>
			</div>
		  </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a onClick="$('.slidr').animatescroll({scrollSpeed:2000, padding:80});" href="index.php#">Домой</a></li>
            <li><a onClick="$('.about').animatescroll({scrollSpeed:2000, padding:80});" href="index.php#about">О Нас</a></li>
			<li><a href="price.php">Прайс-Лист</a></li>
			<li><a onClick="$('.hotsell').animatescroll({scrollSpeed:2000, padding:80});" class="hot" href="index.php#hotsell"><strong>Срочно!</strong></a></li>
            <li><a onClick="$('.webuy').animatescroll({scrollSpeed:2000, padding:80});" href="index.php#webuy">Мы Покупаем</a></li>
            <li><a onClick="$('.contact').animatescroll({scrollSpeed:2000, padding:80});" href="index.php#contact">E-mail</a></li>
          </ul>
            <ul class="loginBtn nav">
                <li>
                    <a href="stanadmin.php" style="font-size: x-large;">
                        <span class="glyphicon glyphicon-log-in"></span>
                    </a>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
    </div><!--container-->   
</nav>