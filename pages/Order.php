<?php

	namespace Pages;

	use Classes\Database;

	use Views\Table;

	class Order extends Base\BasicPage implements Base\PageInterface {

		private $rows ;

		function __construct ( Database $db )
		{
			parent :: __construct() ;

			$query = "SELECT DISTINCT reserved.user_id, reserved.order_no AS `order number`, users.username
						FROM reserved, users
						WHERE  users.id = reserved.user_id
						AND order_no>0" ;

			$this->rows = $db -> query ( $query ) ;
		}

		function print_table ()
		{

		}

		function printPage ()
		{

			$keys = array ( 'order number' , 'username' ) ;
			$table = new Table ( $keys , $this->rows ) ;
			$table->printView () ;

		}

	}