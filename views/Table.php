<?php

	namespace Views;

	class Table implements Base\ViewInterface {

		function printView ( )
		{
			echo 'basic table view' ;
			$this -> TableHeader ( ) ;
			$this -> TableContent () ;
			$this -> TableFooter () ;
		}


		function TableHeader ( )
		{
			echo '
			<table class="table">
				<thead style="background-color: rgb(130, 185, 236)">
					<tr>
					' ;

			foreach ( $this->columns as $column )
				echo '<th style="text-align:center;">'.\ucwords ( $column ).'</td>';

			echo	'</tr>
				</thead>
			<tbody>' ;
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
				echo '<td>'.$row[$key]."</td>";
			echo '</tr>' ;
}

		function TableFooter ()
		{
			echo '
					</tbody>
					</table>';
		}


		//\ucwords

		function __construct ( $columns , $rows )
		{
			$this -> columns = $columns ;
			$this -> rows = $rows ;
		}

	}
