<?php 

include('db_.php');
date_default_timezone_set('Europe/Kiev');

// Получаем IP-адрес посетителя и сохраняем текущую дату	
$visitor_ip = $_SERVER['REMOTE_ADDR'];
$date = date('Y-m-d');
// Узнаем, были ли посещения за сегодня   
$res = mysqli_query($db_stats, " SELECT visit_id FROM visits WHERE date='$date' ") or die ("Проблема при подключении к БД");

if ( mysqli_num_rows($res) == 0 ) {  // Если сегодня еще не было посещений
    
    mysqli_query($db_stats, " DELETE FROM ips ");  // Очищаем таблицу ips
    mysqli_query($db_stats, " INSERT INTO ips SET date='$date', ip_address='$visitor_ip' ");  // Заносим в базу IP-адрес текущего посетителя
    
    // Заносим в базу дату посещения и устанавливаем кол-во просмотров и уник. посещений в значение 1
    $res_count = mysqli_query($db_stats, " INSERT INTO visits SET date='$date', hosts=1, views=1 ");
    mysqli_query($db_stats, " INSERT INTO posviews SET date='$date', pos_string='', ip='$visitor_ip' ");
    
 } else {  // Если посещения сегодня уже были
 
    // Проверяем, есть ли уже в базе IP-адрес, с которого происходит обращение
    $current_ip = mysqli_query($db_stats, " SELECT ip_id FROM ips WHERE ip_address='$visitor_ip' ");
    
    // Если такой IP-адрес уже сегодня был (т.е. это не уникальный посетитель) 
    if ( mysqli_num_rows($current_ip) == 1 ) {
        // Добавляем для текущей даты +1 просмотр (хит)
        mysqli_query($db_stats, " UPDATE visits SET views=views+1 WHERE date='$date' ");
    } else {   // Если сегодня такого IP-адреса еще не было (т.е. это уникальный посетитель)
        // Заносим в базу IP-адрес этого посетителя
        mysqli_query($db_stats, " INSERT INTO ips SET ip_address='$visitor_ip' ");
        
        // Добавляем в базу +1 уникального посетителя (хост) и +1 просмотр (хит)
        mysqli_query($db_stats, " UPDATE visits SET hosts=hosts+1, views=views+1 WHERE date='$date' ");
        mysqli_query($db_stats, " INSERT INTO posviews SET date='$date', pos_string='', ip='$visitor_ip' ");
    }
 }

mysqli_close($db_stats);
	
?>