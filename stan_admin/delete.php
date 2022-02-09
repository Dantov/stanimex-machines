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
$imgname = $_GET['imgname'];
$dellpos = $_GET['dellpos'];
$dellwebuy = $_GET['dellwebuy'];
$dell_pos_ok = $_GET['dell_pos_ok'];
$dell_img_ok = $_GET['dell_img_ok'];

include_once('../db.php');

$result = mysqli_query($connection, "  SELECT short_name FROM stock WHERE id='$id' ");
$row = mysqli_fetch_assoc($result);

if ( $dellwebuy ) {
    $result = mysqli_query($connection, "  SELECT * FROM webuy WHERE id='$id' ");
    $row = mysqli_fetch_assoc($result);
    mysqli_query($connection, "  DELETE FROM webuy WHERE id='$id' ");
    echo "Позиция: <strong>".$row['name']."</strong><br/>Удалена!";
    ?>
     </h4>
      </div>
      <a href="webuy_adm.php" type="button" class="btn btn-success">OK</a>
      </div>
     </div>
   </div>
    <?php
    mysqli_close($connection);
    exit();
}

if ( $dellpos && empty( $dell_pos_ok ) ) {
    ?>
    <span>Удалить Позицию - <strong><?php echo $row['short_name']; ?></strong> ?</span>
    </h4>
      </div>
      <a href="index_adm.php" type="button" class="btn btn-default"><span class="glyphicon glyphicon-triangle-left"></span> Нет</a>&#160;
      <a href="delete.php?dellpos=1&dell_pos_ok=1&id=<?php echo $id; ?>" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Удалить</a>
      </div>
     </div>
   </div>
    <?php }
    if ( $dellpos && !empty( $dell_pos_ok ) ) {
    
    $dell = $row['short_name'];
	mysqli_query($connection, "  DELETE FROM stock WHERE id='$id' ");
	$result = mysqli_query($connection, "  SELECT * FROM images WHERE pos_id='$id' ");
	while ($row = mysqli_fetch_assoc($result)) {
		unlink($uploaddir."/".$row[img_name]);
	}
	$query_a = mysqli_query($connection, "SELECT COUNT(1) FROM images WHERE pos_id='$id'");
    $img_count = mysqli_fetch_array( $query_a );

	for ( $i = 0; $i < $img_count[0]; $i++ ) {
		mysqli_query($connection, "  DELETE FROM images WHERE pos_id='$id' ");
	};
	echo "Позиция <strong>".$dell."</strong> удалена!";
    ?>
    </h4>
      </div>
      <a href="index_adm.php" type="button" class="btn btn-success">OK</a>
      </div>
     </div>
   </div>
    <?php
    mysqli_close($connection);
    exit();
    }

if ( $imgname && empty( $dell_img_ok ) ) {
    ?>
    <span>Удалить картинку - <strong><?php echo $imgname; ?></strong> ?</span>
    </h4>
      </div>
      <a href="index_adm.php" type="button" class="btn btn-default"><span class="glyphicon glyphicon-triangle-left"></span> Нет</a>&#160;
      <a href="delete.php?imgname=<?php echo $imgname; ?>&dell_img_ok=1&id=<?php echo $id; ?>" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Удалить</a>
      </div>
     </div>
   </div>
    <?php }
    if ( $imgname && !empty( $dell_img_ok ) ) {
    $result = mysqli_query($connection, " SELECT short_name FROM stock WHERE id='$id' ");
    $row = mysqli_fetch_assoc($result);
    
	mysqli_query($connection, "  DELETE FROM images WHERE img_name='$imgname' ");
	unlink($uploaddir."/".$imgname);
	echo "Из позиции <strong>".$row['short_name']."</strong><br/>";
	echo "Удалена картинка <strong>".$imgname."</strong> !";
    ?>
    </h4>
      </div>
      <a href="edit_form_adm.php?id=<?php echo $id; ?>" type="button" class="btn btn-success">OK</a>
     </div>
    </div>
  </div>
  <?php
    mysqli_close($connection);
    exit();
   }

   ?>

<?php
	include('bottomScripts_adm.php');
?>
</body>
</html>
<?php } ?>