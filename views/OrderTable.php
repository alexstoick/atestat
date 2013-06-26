<?php

	namespace Views;

	class OrderTable extends Base\BaseTable implements Base\ViewInterface {

		function printView ( )
		{
			$this -> TableHeader ( ) ;
			$this -> TableContent () ;
			$this -> TableFooter () ;
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



	}