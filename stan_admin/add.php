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
  <div class="row">
    <div class="col-xs-12 sect-headr">
    <div class="alert alert-info" role="alert">
	<h4>
<?php

include_once('../db.php');
	
if( isset($_POST['save']) ) {
	
	$date = trim($_POST['date']);
    $name = strip_tags(trim($_POST['name']));
    $short_name = strip_tags(trim($_POST['short_name']));
    $description = trim($_POST['description']);
    $views = strip_tags(trim($_POST['views']));
	$img_count = $_POST['img_count'];
    $hot = $_POST['hot'];
    $sold = $_POST['sold'];
	
	$add = mysqli_query($connection, " INSERT INTO stock (name, short_name, description, view, date, hot, sold) 
	                            VALUES('$name','$short_name','$description','$views','$date','$hot','$sold') ");
    if ( $add ) {?>	
		<h4>Позиция <strong><?php echo $short_name; ?></strong> добавлена.</h4>
    <?php
    } else {
        printf( "Ошибка: %s\n", mysqli_error($connection) );
    }
                                
	$res = mysqli_query($connection, " SELECT id FROM stock WHERE short_name='$short_name' ");
	$idtoAdd =  mysqli_fetch_assoc($res);
	$id = $idtoAdd['id'];
	
    for ( $i = 0; $i < $img_count; $i++ ) {
		
		$input_name = "upload_file_img".$i;
		$uploading_img_name = basename($_FILES[$input_name]['name']);
		
        if ( !empty($uploading_img_name) ) { //если файл есть то добавляем запись
            move_uploaded_file($_FILES[$input_name]['tmp_name'], "$uploaddir/$uploading_img_name");
		   $quer = mysqli_query($connection, " INSERT INTO images (img_name, pos_id) VALUES ('$uploading_img_name', '$id' ) ");
		
		    if ( $quer ) {	
				echo "Добавлена картинка ".$uploading_img_name."<br/>";
		    } else {
                printf( "Ошибка: %s\n", mysqli_error($connection) );
            }
		}
	};
    
    mysqli_close($connection);
}

?>
      </h4>
      </div>
      <a href="index_adm.php" type="button" class="btn btn-success">OK</a>
     </div>
  </div>
</div>

<?php
	include('bottomScripts_adm.php');
?>
</body>
</html>
<?php } ?>