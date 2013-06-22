<?php

	namespace Views;

	use Classes\Database;
	use Classes\Item;

	class Table implements Base\ViewInterface {

		private $rows;

		function __construct ( $start , $final , Database $db )
		{
			$this ->start = $start ;
			$this ->final = $final ;

			$query = "SELECT * FROM items WHERE `quantity`!= 0 AND :start <=`id` AND `id`< :final" ;
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

		function TableContent ()
		{
			foreach ( $this->rows as $row )
			{
				$item = new Item ( $row ) ;
				$this -> TableLine ( $item ) ;
			}
		}
		function TableFooter ()
		{
			echo '
					</tbody>
					</table>';
		}

		function TableLine ( Item $item )
		{
			echo '<tr id="linia'.$item->getId().'" style="line-height:15px">' ;

			echo '<td ><a onclick="addToCart('.$item->getId().')" class="btn btn-info"><i class="icon-shopping-cart"></i>Add to cart</a></td>' ;
			echo '<td ><a class="btn btn-primary" onclick="loadMoves('.$item->getId().')"><i class="icon-align-left"></i>Moves</a></td>';
			echo '<td ><a onclick="addMove('.$item->getId().')" class="btn btn-warning"><i class="icon-ok"></i><i class="icon-remove"></i>Add move</a></td>';
			echo '<td class="expand" >'. $item->getName().'</td>' ;
			echo '<td>'. $item->getDescription().'</td>';
			echo '<td id="quantity'.$item->getId().'">'. $item->getQuantity(). '</td>';
			echo '<td id="reserved'.$item->getId().'">'. $item->getReserved(). '</td>';

			echo '</tr>' ;
		}

		function printView ( )
		{
			$this -> TableHeader ( );
			$this -> TableContent ( ) ;
			$this -> TableFooter () ;
		}

	}