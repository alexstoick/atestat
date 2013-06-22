<?php
	require_once "config/config.php" ;

	use Classes\Helper;
	use Classes\Database;
	use Classes\Item;

	$helper = new Helper ();

	$logged_in = $helper -> confirm_loggedIn ( ) ;
?>
<body>
<?php

	$start = $_GET ['i' ];
	$final = $_GET ['total'];

	$query = "SELECT * FROM items WHERE `quantity`!= 0 AND :start <=`id` AND `id`< :final" ;

	$db = new Database ( );

	$result = $db -> query ( $query , array ( "start" => $start , "final" => $final ) ) ;
?>
<h4>Displaying items from <?php echo $start; ?> to <?php echo $final; ?></h4>
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

	foreach ( $result as $row )
	{
		$item = new Item ( $row ) ;
		$item -> printTableLine ( ) ;
	}
?>

</tbody>
</table>
</body>
</html>