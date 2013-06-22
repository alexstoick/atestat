<?php

	require_once '../config/config.php';

	use Classes\Item;

	$item_id = $_GET['id'];
	echo 'winning' ;

	$item = Item::find ( $item_id ) ;
?>

<script type="text/javascript">
	$(function()
	{
		id = <?= $item_id ?> ;
		$('#quantity'+id).text( '<?= $item->getQuantity(); ?>' ) ;
		$('#quantity'+id).addClass ( 'niceSuccess bold' )
		$('#reserved'+id).text( '<?= $item->getReserved(); ?>' ) ;
		$('#reserved'+id).addClass ( 'niceSuccess bold' )
	});
</script>

