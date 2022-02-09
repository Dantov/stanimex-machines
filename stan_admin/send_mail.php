<?php

if ( isset($_POST['your-name'], $_POST['your-email'], $_POST['your-message'], $_POST['your-subject']) ) {
		$name = $_POST['your-name'];
		$email = $_POST['your-email'];
        $message = $_POST['your-message'];
		$subject  = $_POST['your-subject'];
}

$to  = "Stanimex Ltd. <info@almtradesro.com>";

$c_message = ' 
<html>
    <body>
        <p>
           Новое сообщение от: <strong>'.$name.'</strong><br>
        </p>
        <p>'.$message.'</p>
    </body>
</html>';

$headers  = "Content-type: text/html; charset=utf-8 \r\n";
$headers .= "From: ".$name." <".$email.">";

if ( mail($to, $subject, $c_message, $headers) ) {
    header("location: ../index.php?sended=1#contact");
} else {
	header("location: ../index.php?sended=-1#contact");
};

?>