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

$id = $_GET['id'];
include_once('../db.php');

if( isset($_POST['save']) ) {
	
	$name = strip_tags(trim($_POST['name']));
    $short_name = strip_tags(trim($_POST['short_name']));
    $description = trim($_POST['description']);
    $views = $_POST['views'];
	$img_count = $_POST['img_count'];
	$hot = $_POST['hot'];
    $sold = $_POST['sold'];
    $date = $_POST['date'];
    
	/*$создание массива с Id элементов в таблице images, */
	for ( $i = 1; $i <= $img_count; $i++ ) {
		$aa = "img_row_id_".$i;
		$arr[] = $_POST[$aa];
	}
    
	$quertext = mysqli_query($connection, " UPDATE stock SET name='$name', 
                                                 short_name='$short_name', 
                                                 description='$description', 
                                                 view='$views',
                                                 hot='$hot',
                                                 sold='$sold',
                                                 date='$date'
                                            WHERE id='$id' ");
	if ( $quertext ) {
		echo "Изменения внесены<br/>";
	}
	
	for ( $i = 0; $i < $img_count; $i++ ) {
		
		$input_name = "upload_file_img".$i;
		$uploading_img_name = basename($_FILES[$input_name]['name']);
		
        if ( !empty($uploading_img_name) ) {
        move_uploaded_file($_FILES[$input_name]['tmp_name'], "$uploaddir/$uploading_img_name");
		//если файл есть то обновляем существующую запись
		$find = mysqli_query($connection, "  SELECT * FROM images WHERE id='$arr[$i]' ");
		$row123 = mysqli_fetch_assoc($find);
		
		    if ( !$row123 ) {
				$quer = mysqli_query($connection, " INSERT INTO images (img_name, pos_id) VALUES ('$uploading_img_name', '$id') ");
				echo "Добавлена картинка ".$uploading_img_name."<br/>";
		    } else {
			    $quer = mysqli_query($connection, " UPDATE images SET img_name='$uploading_img_name' WHERE id='$arr[$i]' ");
		        if ( $quer ) {
			    echo "Поменял картинку ".$uploading_img_name."<br/>";
		        } 
		    }
		}
	};
    mysqli_close($connection);
	
}

?>
      </h4>
      </div>
      <a href="edit_form_adm.php?id=<?php echo $id;?>" type="button" class="btn btn-success">OK</a>
     </div>
  </div>
</div>

<?php
	include('bottomScripts_adm.php');
?>
</body>
</html>
<?php
	}
?>