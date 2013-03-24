<?php

	require_once '../config/config.php';

	$item_id = $_GET['id'] ;

	$item = Item::getItemWithId ( $item_id ) ;

?>

<div id="cart-modal" class="modal hide fade" aria-hidden="false">
	<div class="modal-body">
		<p> <b>Item name:</b> <?= $item->getName(); ?> </p>
		<p> <b>Current quantity:</b> <?= $item->getQuantity() ; ?> </p>
		<form onsubmit="validateAndSendForm(); return false;" class="form-horizontal">
			<div class="control-group" id="to_reserve_group" >
				<label class="control-label" for="reserve" style="text-align:none;">Quantity to reserve</label>
				<div class="controls">
					<input type="password" id="reserve" placeholder="Quantity to reserve">
				</div>
			</div>
		</form>
		<p> Submit button that turns green when request is sucessful then the modal fades away.</p>
	</div>
</div>

<script type="text/javascript">

    $(function()
        {
            $("#cart-modal").modal('show');
        });

</script>