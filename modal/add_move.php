<?php

	require_once '../config/config.php';

	use Classes\Item;

	$item_id = $_GET['id'] ;

	$item = Item::find ( $item_id ) ;
?>

<div id="moves-modal" class="modal hide fade" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	</div>
	<div class="modal-body" id="moves-modal-body">
		<form onsubmit="sendMovesForm(); return false;" class="form-horizontal" id="submitMovesForm">
			<p> <b>Item name:</b> <?= $item->getName(); ?> </p>
			<p> <b>Quantity currently available:</b> <?= $item->getQuantity() ; ?> </p>
			<div class="control-group move" id="to_reserve_group" >
				<label class="control-label" for="reserve" style="text-align:left;">Quantity to move: </label>
				<div class="controls">
					<input type="text" id="reserve" placeholder="Quantity to reserve" onkeyup="validateQuantity()">
				</div>
			</div>
			<div class="control-group move" id="type_of_move_group">
				<label class="control-label" for="typeMove" style="text-align:left;">Type of Move: </label>
				<div class="controls">
						<select id="typeMove">
								<option value="1">Move in</option>
								<option value="2">Move out</option>
						</select>
				</div>
			</div>
			<div class="control-group move" id="location_group" >
				<label class="control-label" for="location" style="text-align:left;">Location: </label>
				<div class="controls">
					<input type="text" id="location" placeholder="Location for move">
				</div>
			</div>
			<div id="exceededQuantity" style="display:none;" class="alert alert-block"> There are not enough materials to reserve! </div>
			<button type="submit" class="btn btn-primary" id="submitMoves">Add move! </button>
			<!--<p> Submit button that turns green when request is sucessful then the modal fades away.</p>-->
		</form>
		<div id="sucessfullyAddedMoves" style="display:none" class="alert alert-success"> The change was sucessful! </div>
	</div>

</div>

<script type="text/javascript">
	var quantity_available = <?= $item->getQuantity() ?> ;
	$(function()
	{
		$("#moves-modal").modal('show');
	});

	var quantity_to_move;
	var locationText ;

	function validateQuantity ( )
	{
		quantity_to_move= $("#reserve").val () ;

		if ( quantity_to_move > quantity_available )
		{
			$(".move").addClass ( "error" ) ;
			$("#exceededQuantity").show () ;
			$("#submitMoves").addClass ( "disabled") ;
			return false ;
		}
		else
		{
			$("#exceededQuantity").hide();
			$(".move").removeClass ("error") ;
			$("#submitMoves").removeClass ( "disabled") ;
			return true ;
		}
	}
	function sendMovesForm ( )
	{
		locationText = $("#location").val () ;
		typeOfMove = $("#typeMove").val () ;

		data = 'item_id='+ <?= $item_id; ?> + '&quantity=' + quantity_to_move + '&location=' + locationText + '&typeMove=' + typeOfMove ;
		console.log ( data ) ;
		$.ajax ( {
			url:"ajax/movesToDB.php" ,
			type:"POST",
			dataType:"json",
			data:data,
			success: function (data) {
				console.log ( "333") ;
				$("#submitMovesForm").hide();
				$("#sucessfullyAddedMoves").show () ;
				setTimeout ( function () {
						$("#moves-modal").modal('hide');
						updateRow ( <?= $item_id ?> ) ;
					}, 1500 ) ;
			}
		}) ;
	}

</script>
