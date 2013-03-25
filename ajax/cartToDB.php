<?php

	require_once '../config/config.php';

	$result = array ( );

	$item_id = $_POST ['item_id'] ;
	$reserveQuantity = $_POST['reserveQuantity'] ;

	$item = Item::getItemWithId ( $item_id ) ;

	

	$result [ 'abc' ] = true ;

	echo json_encode( $result ) ;

?>