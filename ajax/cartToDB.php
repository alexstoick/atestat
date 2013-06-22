<?php

	require_once '../config/config.php';

	use Classes\Item;

	$result = array ( );

	$item_id = $_POST ['item_id'] ;
	$reserveQuantity = $_POST ['reserveQuantity'] ;

	$item = Item::find ( $item_id ) ;

	//have to add reserved quantity, and substract that from available quantity.

	$quantity_new = $item->getQuantity () - $reserveQuantity ;
	$reserved_new = $item->getReserved () + $reserveQuantity ;

	$item -> setQuantity ( $quantity_new ) ;
	$item -> setReserved ( $reserved_new ) ;

	$user_id = $_SESSION [ 'user_id' ] ;

	$query = "INSERT INTO reserved
				(item_id,user_id,quantity,solved) VALUES ( :item_id, :user_id, :quantityReserved, 0 )" ;

	$array = array( "item_id" => $item_id , "user_id" => $user_id , "quantityReserved" => $reserveQuantity ) ;

	$db -> query ( $query , $array ) ;


	$result['success'] = true ;

	echo json_encode( $result ) ;
?>