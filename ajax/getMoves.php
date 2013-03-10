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

	$query = "SELECT `item_code`,`item_description`,`quantity`,`reserved` FROM items WHERE id='".$item_id."'" ;

	$result = mysql_query ( $query , $connection ) or die ( mysql_error ( ) );

	$item_name = mysql_result($result, 0 , "item_code" ) ;
	$description = mysql_result ( $result , 0 , "item_description" ) ;
	$stock = mysql_result ( $result , 0 , "quantity" ) ;
	$reserved = mysql_result( $result, 0 , "reserved" ) ;
	echo '<div style="padding:10px;">' ;
	echo '<h3><b>Name:'.$item_name.'</b></h3><p>Description:'.$description.'</p><p>Stock:'.$stock.'</p><p>Reserved:'.$reserved.'</p>' ;

	echo '<br>Showing moves from period:'.$from_date.' - '.$to_date;

	$query = "SELECT * FROM moves WHERE item_id='".$item_id."'" ;


	echo '<table>
			<tr>
				<td width="20%" bgcolor="#999999" style="align:center;text-align:center;"><b> Where </b></td>
				<td width="15%" bgcolor="#999999" style="align:center;text-align:center;"><b> Time </b></td>
				<td width="15%" bgcolor="#999999" style="align:center;text-align:center;"><b> Quantity </b></td>
			</tr>';
	$added = 0 ;
	$taken = 0 ;
	$result = mysql_query ( $query , $connection ) or die ( mysql_error () ) ;
	for ( $i = 0 ; $i < mysql_num_rows ( $result ) ; ++ $i )
	{

		$date_DB = mysql_result ( $result , $i , "date" ) ;
		if ( $from_date <= $date_DB && $date_DB <= $to_date )
		{
			$movement_type = mysql_result ( $result , $i , "type_move" ) ;
			$quantity = mysql_result ( $result , $i , "quantity" ) ;
			$where = mysql_result ( $result , $i , "where" ) ;
			if ( $movement_type == 1 ) //intrare
			{
				echo "<tr><td style='align:center;text-align:center;'><i class='icon-upload' />" ;//height='22px' width='22px'
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

