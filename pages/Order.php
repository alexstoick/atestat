<?php

	namespace Pages;

	use Classes\Database;

	use Views\Table;

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

		function TableContent ()
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
			if ( $i % 2 )
				echo '<tr class="success">' ;
			else
				echo '<tr class="error">' ;

			foreach ( $this->columns as $key )
				if ( $key == 'order number' )
					echo '<td style="text-align:center; line-height: 10px;"><a href="#" onclick="showOrder('.$row[$key].')">'.$row[$key].'</a></td>' ;
				echo '<td style="line-height: 10px;">'.$row[$key]."</td>";
			echo '</tr>' ;
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
			$table = new Table ( $this->columns , $this->rows ) ;

			$table->TableHeader ( );
			$this ->TableContent ( ) ;
			$table->TableFooter ( );

			$this -> additionalJS () ;

			echo '
					<div id="order-data">
					</div>
				';

			$this->print_Ending();
		}

	}