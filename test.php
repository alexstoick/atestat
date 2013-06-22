<?php

	require "config/config.php" ;
	use Pages\Order ;

	$page = new Order ( $db ) ;

	$page -> printPage () ;