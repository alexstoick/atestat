<?php

	$pathToLibs = realpath(__DIR__.'/../');
	set_include_path($pathToLibs . PATH_SEPARATOR  . get_include_path());

	require_once ( "classes/Database.php" ) ;
	require_once ( "classes/Item.php") ;
	require_once ( "config/session.php") ;

	$db = new Database () ;
?>