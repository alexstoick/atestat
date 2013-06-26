<?php

	namespace Views;

	class Table extends Base\BaseTable implements Base\ViewInterface {

		function printView ( )
		{
			$this -> TableHeader ( ) ;
			$this -> TableContent () ;
			$this -> TableFooter () ;
		}

		function TableLine ( $row , $i )
		{
			if ( $i % 2 )
				echo '<tr class="success">' ;
			else
				echo '<tr class="error">' ;

			foreach ( $this->columns as $key )
				echo '<td>'.$row[$key]."</td>";
			echo '</tr>' ;
		}

	}
