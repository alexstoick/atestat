<?php

	require "config/config.php" ;
	use Views\Table ;

	echo '<link href="css/bootstrap.min.css" rel="stylesheet">';
	$columns = array ( 'nume' , 'varsta' ) ;
	$rows = [] ;
	$row[ 'nume' ] = 'alex' ;
	$row ['varsta'] = 19 ;
	array_push ( $rows , $row ) ;
	$row[ 'nume' ] = 'vlad' ;
	$row ['varsta'] = 17 ;
	array_push ( $rows , $row ) ;

	$cart = new Table ( $columns , $rows ) ;

	$cart -> printView () ;