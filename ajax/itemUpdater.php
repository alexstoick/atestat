<?php

	require_once '../config/config.php';

	$item_id = $_GET['id'];
	echo 'winning' ;

	$item = Item::getItemWithId ( $item_id ) ;
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

