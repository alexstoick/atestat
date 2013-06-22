<?php
	require_once "config/config.php" ;

	use Classes\Helper;
	use Classes\Database;
	use Classes\Item;

	use Views\IndexTable as TableView;

	$helper = new Helper ();

	$logged_in = $helper -> confirm_loggedIn ( ) ;
?>
<body>

<?php

	$start = $_GET ['i' ];
	$final = $_GET ['total'];

	$table = new TableView ( $start , $final , $db );

	$table -> printView() ;
?>

</body>
</html>