<?php

	namespace Views;

	use Classes\Database;
	use Classes\Item;

	class Cart extends Base\BasicPage implements Base\PageInterface {

		public function printPage ( )
		{
			$this -> print_table () ;
			echo '
					<button class="btn">Place order</button>
					<button class="btn disabled"> Export!</button>
				';
			$this -> print_page () ;
		}

		function __construct ( Database $db )
		{

			//selecting the items that are reserved by this user and are not on an order.
			//(aka have NOT been 'checkouted')
			//
			//Reserved
			//id , item_id, user_id, quantity-reserved, solved, order_no
			//Items
			//quantity, item_code

			parent::__construct();

			$user_id = $_SESSION['user_id'];

			$query = "SELECT reserved.quantity AS  `reserved quantity` , users.username, items.item_code AS `item description`, items.quantity, reserved.date
					FROM reserved, users, items
					WHERE  `user_id` ='".$user_id."'
					AND items.id = reserved.item_id AND `order_no`=0" ;

			$this->rows = $db -> query ( $query , array ( "user_id" => $user_id ) ) ;
			print_r ( $this->rows ) ;
		}

		public function TableHeader ( )
		{
			echo '
				<table class="table">
				<thead style="background-color: rgb(130, 185, 236)">
					<tr>
						<th style="text-align:center;"> Item description </th>
						<th style="text-align:center;"> Quantity stock </th>
						<th style="text-align:center;"> Quantity reserved </th>
						<th style="text-align:center;"> Date of reservation</th>
					</tr>
				</thead>
				<tbody>
			' ;
		}

		function TableContent ( )
		{
			$i = 0 ;
			foreach ( $this->rows as $row )
			{
				$this -> TableLine ( $row , $i ) ;
				$i ++ ;
			}
		}

		function TableLine ( $row , $i )
		{
			$quantity_reserved = $row [ "reserved quantity" ] ;
			$date = $row [ "date" ] ;
			$item_description = $row ["item_code" ] ;
			$quantity_stock = $row [ 'quantity' ] ;

			if ( $i % 2 )
				echo '<tr class="success">' ;
			else
				echo '<tr class="error">' ;

			echo '<td style="align:center;text-align:center;">'.$item_description.'</td>' ;
			echo '<td style="align:center;text-align:center;">'.$quantity_stock.'</td>' ;
			echo '<td style="align:center;text-align:center;">'.$quantity_reserved.'</td>' ;
			echo '<td style="align:center;text-align:center;">'.$date.'</td>' ;
			echo '</tr>' ;
		}

		function TableFooter ()
		{
			echo'
				</tbody>
				</table>
				';
		}

		function print_table ( )
		{
			$this -> TableHeader ( );
			$this -> TableContent ( ) ;
			$this -> TableFooter () ;
		}


	}

