<?php

	namespace Pages;

	use Classes\Database;
	use Classes\Item;

	use Views\Table;

	class Cart extends Base\BasicPage implements Base\PageInterface {

		private $rows ;

		public function printPage ( )
		{
			$keys = array( 'reserved quantity' , 'username' , 'item description' , 'quantity' , 'date' ) ;

			$table = new Table ( $keys , $this -> rows) ;

			$table -> printView ( );

			//$this -> print_table () ;
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
		}

	}

