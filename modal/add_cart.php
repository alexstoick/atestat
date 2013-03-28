<?php

	require_once '../config/config.php';

	$item_id = $_GET['id'] ;

	$item = Item::getItemWithId ( $item_id ) ;
?>

<div id="cart-modal" class="modal hide fade" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
	<div class="modal-body" id="cart-modal-body">
		<form onsubmit="sendCartForm(); return false;" class="form-horizontal" id="submitCartForm">
			<p> <b>Item name:</b> <?= $item->getName(); ?> </p>
			<p> <b>Quantity currently available:</b> <?= $item->getQuantity() ; ?> </p>
			<div class="control-group cart" id="to_reserve_group" >
				<label class="control-label" for="reserve" style="text-align:left;">Quantity to reserve: </label>
				<div class="controls">
					<input type="text" id="reserve" placeholder="Quantity to reserve" onkeyup="validateCart()">
				</div>
			</div>
			<div id="exceededQuantity" style="display:none;" class="alert alert-block"> There are not enough materials to reserve! </div>
			<button type="submit" class="btn btn-primary" id="submitToCart">Add to cart </button>
			<!--<p> Submit button that turns green when request is sucessful then the modal fades away.</p>-->
		</form>
		<div id="sucessfullyAddedToCart" style="display:none" class="alert alert-success"> The change was sucessful! </div>
	</div>

</div>

<script type="text/javascript">
	var quantity_available = <?= $item->getQuantity() ?> ;
    $(function()
    {
        $("#cart-modal").modal('show');
    });

    var quantity_to_reserve ;

	function validateCart ( )
	{
		quantity_to_reserve = $("#reserve").val () ;
		if ( quantity_to_reserve > quantity_available )
		{
			$(".cart").addClass ( "error" ) ;
			$("#exceededQuantity").show () ;
			$("#submitToCart").addClass ( "disabled") ;
			return false ;
		}
		else
		{
			$("#exceededQuantity").hide();
			$(".cart").removeClass ("error") ;
			$("#submitToCart").removeClass ( "disabled") ;
			return true ;
		}
	}
	function sendCartForm ( )
	{
		data = 'item_id='+ <?= $item_id; ?> + '&reserveQuantity=' + quantity_to_reserve ;
		console.log ( data ) ;
		$.ajax ( {
			url:"ajax/cartToDB.php" ,
			type:"POST",
			dataType:"json",
			data:data,
			success: function (data) {
				$("#submitCartForm").hide();
				$("#sucessfullyAddedToCart").show () ;
				setTimeout ( function () {$("#cart-modal").modal('hide');}, 1500 ) ;
			}
		}) ;
	}

</script>
