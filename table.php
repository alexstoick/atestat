<?php
	require_once ( "config/session.php" ) ;
	require_once ( "config/config.php" ) ;
	require_once ( "config/functions.php" ) ;
	confirm_loggedIn ( ) ;
?>
<head>
<link href="css/footable-0.1.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php

	$i = $_GET ['i' ];
	$total = $_GET ['total'];
	$query = "SELECT * FROM items WHERE `quantity`!= 0 AND ".$i."<=`id` AND `id`<".$total  ;
	$result = mysql_query ( $query , $connection ) or die ( mysql_error () ) ;
	$total_rows =mysql_num_rows ( $result ) ;
?>
<h4>Displaying items from <?php echo $i; ?> to <?php echo $total; ?></h4>
<table class="footable">
	<thead>
		<tr>
			<th data-hide="phone,tablet"> Cart</th>
			<th data-hide="phone,tablet"> Moves</th>
			<th data-hide="phone,tablet"> Add move</th>
			<th data-class="expand"> Name</th>
			<th > Description</th>
			<th data-hide="phone" > Quantity</th>
			<th data-hide="phone,tablet"> Reserved</th>
		</tr>
	</thead>
<tbody>

<?php


	for ( $i = 0 ; $i < $total_rows ; ++ $i )
	{
		$name = mysql_result ( $result , $i , "item_code" );
		$quantity = mysql_result ( $result , $i , "quantity" );
		$reserved = mysql_result ( $result , $i , "reserved" );
		$description = mysql_result ( $result , $i , "item_description" );
		$id = mysql_result ( $result , $i , "id" );

		echo '<tr id="coloana'.$i.'" style="line-height:15px;">' ;

		echo '<td ><a href="add_cart.php?id='.$id.'" class="btn btn-info"><i class="icon-shopping-cart"></i>Add to cart</a></td>' ;
		echo '<td ><a class="btn btn-primary" onclick="loadMoves('.$id.')"><i class="icon-align-left"></i>Moves</a></td>';
		//echo '<td ><a class="btn btn-primary" href="moves.php?id='.$id.'"><i class="icon-align-left"></i>Moves</a></td>';
		echo '<td ><a href="add_move.php?item='.$name.'" class="btn btn-warning"><i class="icon-ok"></i><i class="icon-remove"></i>Add move</a></td>';
		echo '<td class="expand" >'. $name.'</td>' ;
		echo '<td>'. $description.'</td>';
		echo '<td>'. $quantity. '</td>';
		echo '<td>'. $reserved. '</td>';

		echo '</tr>' ;
	}
?>

</tbody>
</table>

<script type="text/javascript" src="js/footable-0.1.js" >
</script>
<script type="text/javascript">
		$(function() {
		  $('.footable').footable();
		});
</script>


</body>
</html>