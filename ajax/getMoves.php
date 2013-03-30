<?php

	require_once '../config/config.php';

	// var $from_time_raw , $to_time_raw ;
	// var $from_date , $to_date ;

	// var $from_year , $from_month , $from_day ;
	// var $to_year , $to_month , $to_day ;

	$from_year = $_GET['from_year'] ;
	$from_month = $_GET['from_month'] ;
	$from_day = $_GET['from_day'] ;

	$to_year = $_GET['to_year'] ;
	$to_month = $_GET['to_month'] ;
	$to_day = $_GET['to_day'] ;

	$from_time_raw  = mktime( 1, 0, 0, $from_month, $from_day , $from_year );
	$to_time_raw  = mktime( 1, 0, 0, $to_month , $to_day , $to_year );
	$from_date = date ("Y-m-d" , $from_time_raw ) ;
	$to_date = date ("Y-m-d" , $to_time_raw ) ;

	$item_id = $_GET['id'] ;


	//need to get some basic information about the object: number in stock & number reserved
	//also need to get the description of the item.

	$item = Item::getItemWithId ( $item_id ) ;

	$item_name = $item -> getName ( ) ;
	$description = $item -> getDescription () ;
	$stock = $item -> getQuantity ();
	$reserved = $item -> getReserved ();
	echo '<div style="padding:10px;">' ;
	echo '<h3><b>Name:'.$item_name.'</b></h3><p>Description:'.$description.'</p><p>Stock:'.$stock.'</p><p>Reserved:'.$reserved.'</p>' ;

	echo '<br>Showing moves from period:'.$from_date.' - '.$to_date;

	echo '<table>
			<tr>
				<td width="20%" bgcolor="#999999" style="text-align:center;"><b> Where </b></td>
				<td width="15%" bgcolor="#999999" style="text-align:center;"><b> Time </b></td>
				<td width="15%" bgcolor="#999999" style="text-align:center;"><b> Quantity </b></td>
			</tr>';


	$added = 0 ;
	$taken = 0 ;

	$query = "SELECT * FROM moves WHERE item_id= :item_id" ;

	$query_result = $db -> query ( $query , array ( "item_id" => $item_id ) ) ;

	foreach ( $query_result as $row )
	{
		$date_DB = $row ['date'] ;
		if ( $from_date <= $date_DB && $date_DB <= $to_date )
		{
			$movement_type = $row [ "type_move" ] ;
			$quantity = $row [ "quantity"  ] ;
			$where = $row [ 'where' ] ;
			if ( $movement_type == 1 ) //intrare
			{
				echo "<tr><td style='align:center;text-align:center;'><i class='icon-upload' />" ;
				$added += $quantity;
			}
			else //iesire
			{
				echo "<tr><td style='align:center;text-align:center;'><i class='icon-download' />" ;
				$taken += $quantity;
			}

			echo $where.'</td><td style="align:center;text-align:center;"> '. $date_DB.'</td><td style="align:center;text-align:center;">'. $quantity ;
			echo '</tr>' ;
		}
	}
		echo '</table>';
	$total = $added + $taken ;
	echo "Total movements:".$total."(<i class='icon-upload' />".$added."&nbsp;,&nbsp;<i class='icon-download' />".$taken.")";
	echo "<br>" ;
	echo '</div>'

?>

