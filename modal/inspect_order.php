<?php

	require_once '../config/config.php';

	$order_no = $_GET['orderNo'] ;
	$user_id = $_SESSION ['user_id'] ;
	$username = $_SESSION ['username'] ;

	function disabled ($solved)
	{
		if ( $solved )
		{
			return 'disabled' ;
		}
		return '' ;
	}

?>


<div id="inspectOrder-modal" class="modal hide fade" aria-hidden="true" style="left:10%; margin-left:0%; width:80%">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	</div>
	<div class="modal-body">

		<table class="table">
			<thead style="background-color: rgb(130, 185, 236)">
				<tr>
					<th style="text-align:center;"> Name</th>
					<th style="text-align:center;"> Description </th>
					<th style="text-align:center;"> Quantity reserved </th>
					<th style="text-align:center;"> Date of reservation</th>
					<th > Confirm sending </th>
				</tr>
			</thead>

			<?php

				$query = "SELECT reserved.date,
							reserved.id,
							reserved.quantity AS `reserved quantity`,
							items.item_code AS `name`,
							items.item_description AS `description`,
							reserved.solved AS `solved`
							FROM reserved,items
							WHERE reserved.user_id = :user_id
							AND order_no = :order_no
							AND items.id = reserved.item_id" ;

				$array = array("user_id" => $user_id , "order_no" => $order_no ) ;

				$query_result = $db -> query ( $query , $array ) ;
				$i = 0 ;
				$classes = array (1 => "niceSuccess" , 0 => "niceWarning" , 2=>"niceError") ;
				foreach ( $query_result as $row )
				{
					//date, reserved quantity, name, description
					$reservedId = $row['id'] ;
					$date = $row['date'] ;
					$reservedQuantity = $row['reserved quantity'] ;
					$name = $row['name'] ;
					$description = $row['description'] ;
					$solved = $row['solved'] ;

					echo '<tr class="'.$classes[$i%3].'">' ;

					echo '<td>'.$name.'</td>' ;
					echo '<td>'.$description.'</td>' ;
					echo '<td>'.$reservedQuantity.'</td>' ;
					echo '<td>'.$date.'</td>' ;
					if ( $solved )
						echo '<td><button class="btn disabled">Confirmed!</button></td>' ;
					else
					 	echo '<td><button id='.$reservedId.' class="btn" onclick="saveReservedId( '.$reservedId.' ); return false;">Confirm!</button></td>' ;
					echo '</tr>' ;
					++ $i ;
				}

			?>
		</table>
	</div>
</div>

<div id="confirmSending-modal" class="modal hide fade" aria-hidden="true" style="left:10%; margin-left:0%; width:80%">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	</div>
	<div class="modal-body">
		<form onsubmit="showConfirmModal(); return false;" class="form-horizontal" id="formLocation">
			<div class="control-group" id="password_group">
				<label class="control-label" for="location">Location</label>
				<div class="controls">
					<input type="location" id="location" placeholder="Location">
				</div>
			</div>

			<div class="control-group">
				<div class="controls">
					<button type="submit" class="btn" onclick="showConfirmModal(); return false;">Submit</button>
				</div>
			</div>
		</form>
		<div id="information"></div>
	</div>
</div>

<script type="text/javascript">
	$(function()
		{
			$("#inspectOrder-modal").modal('show');
			$('#confirmSending-modal').on('hidden', function () {
				$("#inspectOrder-modal").modal('show');
			}) ;
		});
	var reservedId = 0 ;
	function saveReservedId ( id )
	{
		console.log ( id ) ;
		reservedId = id ;
		$("#inspectOrder-modal").modal('hide') ;
		$("#confirmSending-modal").modal('show') ;
	}
	function showConfirmModal ( )
	{
		$("#"+reservedId).addClass ( "disabled" ).removeAttr('onclick').html ( "Confirmed!" ) ;
		loc = $("#location").val () ;
		console.log ( loc ) ;
		url = "ajax/confirm_sending.php?id=" + reservedId + "&loc=" + loc ;
		$("#information").load ( url ,
								function () {
									$("#formLocation").hide();
									setTimeout ( function () {$("#confirmSending-modal").modal('hide');}, 1500 ) ;
							} ) ;
	}
</script>
