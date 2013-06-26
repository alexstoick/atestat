<?php

	namespace Views;

	use Classes\Database;

	class IndexTable extends Base\BaseTable implements Base\ViewInterface {

		function printView ( )
		{
			$this -> TableHeader ( );
			$this -> TableContent ( ) ;
			$this -> TableFooter () ;
		}

		function __construct ( $start , $final , Database $db )
		{
			$this ->start = $start ;
			$this ->final = $final ;

			$query = "SELECT
							id,
							item_code AS `name`,
							item_description AS `description`,
							quantity,
							reserved
						FROM items
						WHERE `quantity`!= 0 AND :start <=`id` AND `id`< :final" ;
			$array = array ( "start" => $start , "final" => $final ) ;
			$this->rows = $db -> query ( $query ,  $array ) ;
		}

		function TableHeader ( )
		{
			echo '
			<h4>Displaying items from '.$this->start.' to '.$this->final.' </h4>
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
			<tbody>' ;
		}

		function TableLine ( $item , $i )
		{
			echo '<tr id="linia'.$item["id"].'" style="line-height:15px">' ;

			echo '<td ><a onclick="addToCart('.$item["id"].')" class="btn btn-info"><i class="icon-shopping-cart"></i>Add to cart</a></td>' ;
			echo '<td ><a class="btn btn-primary" onclick="loadMoves('.$item["id"].')"><i class="icon-align-left"></i>Moves</a></td>';
			echo '<td ><a onclick="addMove('.$item["id"].')" class="btn btn-warning"><i class="icon-ok"></i><i class="icon-remove"></i>Add move</a></td>';
			echo '<td class="expand" >'. $item["name"].'</td>' ;
			echo '<td>'. $item["description"].'</td>';
			echo '<td id="quantity'.$item["id"].'">'. $item["quantity"]. '</td>';
			echo '<td id="reserved'.$item["id"].'">'. $item["reserved"]. '</td>';

			echo '</tr>' ;
		}
	}