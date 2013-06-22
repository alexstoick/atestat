<?php

	require_once '../config/config.php';

	$id = $_GET['id'] ;

	$location = $_GET['loc'] ;


	$query = "UPDATE reserved SET `solved`=1 WHERE id= :id" ;
	$array = array( "id" => $id ) ;

	$result = $db -> query ( $query , $array ) ;

	$query = "SELECT item_id, date,	quantity FROM reserved WHERE id= :id " ;

	$result = $db -> query ( $query , $array ) ;

	$row = $result [ 0 ] ;

	$itemId = $row ['item_id'] ;
	$date = $row ['date'] ;
	$quantity = $row['quantity'] ;

	$query = "UPDATE items SET items.reserved = ( items.reserved - :quantityReserved) WHERE id = :itemId " ;
	$array = array("quantityReserved" => $quantity , "itemId" => $itemId ) ;

	$result = $db -> query ( $query , $array ) ;

	$query = "INSERT INTO moves (`item_id`, `type_move`, `where`, `quantity`) VALUES
							(:itemId , :type_move , :where , :quantity)" ;
	$array = array( "itemId" => $itemId ,
					"type_move" => 2 , "where" => $location ,
					"quantity" => $quantity
				) ;

	$result = $db -> query ( $query , $array ) ;

	echo '
		<div class="alert alert-success">
  			Sucessfully updated the database!
  		</div>
  		' ;
?>