

<?php

	define('BASE_PATH', realpath(__DIR__.'/../'));

	spl_autoload_register('autoloader');

	function autoloader($class) {
		$filename = BASE_PATH.DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
		//echo $filename;
		include $filename ;
	}

	use Classes\Session;

	$session = new Session();
