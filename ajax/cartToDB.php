<?php

	require_once '../config/config.php';

	$result = array ( );

	$item_id = $_POST ['item_id'] ;
	$reserveQuantity = $_POST ['reserveQuantity'] ;

	$item = Item::getItemWithId ( $item_id ) ;

	//have to add reserved quantity, and substract that from available quantity.

	$quantity_new = $item->getQuantity () - $reserveQuantity ;
	$reserved_new = $item->getReserved () + $reserveQuantity ;

	$item -> setQuantity ( $quantity_new ) ;
	$item -> setReserved ( $reserved_new ) ;

	$result['success'] = true ;
	echo json_encode( $result ) ;
?>