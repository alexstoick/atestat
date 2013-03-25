<?php

	require_once '../config/config.php';

	$item_id = $_GET['id'] ;

	$item = Item::getItemWithId ( $item_id ) ;
?>

<div id="cart-modal" class="modal hide fade" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
	<div class="modal-body">
		<p> <b>Item name:</b> <?= $item->getName(); ?> </p>
		<p> <b>Qquantity currently available:</b> <?= $item->getQuantity() ; ?> </p>
		<form onsubmit="validateAndSendForm(); return false;" class="form-horizontal">
			<div class="control-group cart" id="to_reserve_group" >
				<label class="control-label" for="reserve" style="text-align:left;">Quantity to reserve: </label>
				<div class="controls">
					<input type="text" id="reserve" placeholder="Quantity to reserve" onkeyup="validateCart()">
				</div>
			</div>
			<div id="exceededQuantity" style="display:none;" class="alert alert-block"> There are not enough materials to reserve! </div>
			<a class="btn btn-primary" id="submitToCart" onclick="validateCart()">Add to cart </a>
			<!--<p> Submit button that turns green when request is sucessful then the modal fades away.</p>-->
		</form>
	</div>
</div>

<script type="text/javascript">
	var quantity_available = <?= $item->getQuantity() ?> ;
    $(function()
    {
        $("#cart-modal").modal('show');
    });

	function validateCart ( )
	{
		quantity_to_reserve = $("#reserve").val () ;
		if ( quantity_to_reserve > quantity_available )
		{
			$(".cart").addClass ( "error" ) ;
			$("#exceededQuantity").show () ;
			$("#submitToCart").addClass ( "disabled") ;
		}
		else
		{
			$("#exceededQuantity").hide();
			$(".cart").removeClass ("error") ;
			$("#submitToCart").removeClass ( "disabled") ;
		}
		console.log ( quantity_to_reserve + " " + quantity_available ) ;
	}


</script>
