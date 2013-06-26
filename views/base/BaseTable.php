<?php

	namespace Views\Base ;

	abstract class BaseTable {

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

		abstract public function TableContent() ;
		abstract public function TableLine( $row , $i ) ;

		function TableFooter ()
		{
			echo '
					</tbody>
					</table>';
		}

		function __construct ( $columns , $rows )
		{
			$this -> columns = $columns ;
			$this -> rows = $rows ;
		}

	}