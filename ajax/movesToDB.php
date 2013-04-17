<?php

	require_once '../config/config.php';

	$id = $_POST['item_id'] ;
	$location = $_POST['location'] ;
	$quantity = $_POST['quantity'] ;
	$type_move  = $_POST['typeMove'] ;

	$item = Item::getItemWithId ( $id ) ;

	if ( $type_move == 1 )
		$quantity_new = $item->getQuantity () + $quantity ;
	else
		$quantity_new = $item->getQuantity () - $quantity ;

	$item -> setQuantity ( $quantity_new ) ;

	$query = "INSERT INTO moves (`item_id`, `type_move`, `where`, `quantity`) VALUES ( :item_id , :typeMove, :location , :quantity )";

	$array = array( "item_id" => $id , "typeMove" => $type_move , "location" => $location , "quantity" => $quantity ) ;

	$db -> query ( $query , $array ) ;

	$result = array() ;

	$result['success'] = true ;

	echo json_encode( $result ) ;
?>
