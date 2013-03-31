<?php

	require_once '../config/config.php';

	$order_no = $_GET['orderNo'] ;
	$user_id = $_SESSION ['user_id'] ;
	$username = $_SESSION ['username'] ;

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
							reserved.quantity AS `reserved quantity`,
							items.item_code AS `name`,
							items.item_description AS `description`
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
					$date = $row['date'] ;
					$reservedQuantity = $row['reserved quantity'] ;
					$name = $row['name'] ;
					$description = $row['description'] ;

					echo '<tr class="'.$classes[$i%3].'">' ;

					echo '<td>'.$name.'</td>' ;
					echo '<td>'.$description.'</td>' ;
					echo '<td>'.$reservedQuantity.'</td>' ;
					echo '<td>'.$date.'</td>' ;
					echo '<td><button class="btn" onclick="showConfirmModal( \''.$name.'\', '.$reservedQuantity.'); return false;">Confirm!</button></td>' ;
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
	function showConfirmModal ( name , quantity )
	{
		console.log ( name + "	" + quantity ) ;
		$("#information").html ( "Confirm sending " + name + " in quantity of " + quantity + " ..." ) ;
		$("#inspectOrder-modal").modal('hide') ;
		$("#confirmSending-modal").modal('show') ;
	}
</script>
