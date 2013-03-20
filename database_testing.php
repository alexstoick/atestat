<?php

require_once ( "classes/Database.php") ;

$db_conn = new Database () ;

$start = "1" ;
$final = "10" ;
$result = $db_conn -> query_database ( "SELECT * FROM items WHERE `quantity`!= 0 AND :start<=`id` AND `id`<:final" , array ( "start" => $start , "final" => $final ) ) ;

foreach ( $result as $row )
	echo $row ['item_code'].'<br>';
?>