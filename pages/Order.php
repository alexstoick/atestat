<?php

	namespace Pages;

	use Classes\Database ;

	use Views\OrderTable ;

	class Order extends Base\BasicPage implements Base\PageInterface {

		private $rows ;
		private $columns ;

		function __construct ( Database $db )
		{
			parent :: __construct() ;

			$query = "SELECT DISTINCT reserved.user_id, reserved.order_no AS `order number`, users.username
						FROM reserved, users
						WHERE  users.id = reserved.user_id
						AND order_no>0" ;

			$this->rows = $db -> query ( $query ) ;
		}

		function additionalJS ( )
		{

			echo '
			    <script type="text/javascript">

					function showOrder ( orderNo )
					{
						$("#order-data").load ( "modal/inspect_order.php?orderNo=" + orderNo ) ;
					}

				</script>' ;

		}

		function printPage ()
		{
			$this->columns = array ( 'order number' , 'username' ) ;
			$table = new OrderTable ( $this->columns , $this->rows ) ;

			$table -> printView () ;

			$this -> additionalJS () ;

			echo '
					<div id="order-data">
					</div>
				';

			$this->print_Ending();
		}

	}