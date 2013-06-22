<?php

	define('BASE_PATH', realpath(__DIR__.'/../'));

	spl_autoload_register('autoloader');

	function autoloader($class) {
		//echo $class.'<br>';
		$filename = BASE_PATH.DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
		//echo $filename.'<br>';
		include $filename ;
	}

	use Classes\Session;
	use Classes\Helper ;
    use Classes\Database ;

	$session = new Session();
    $helper = new Helper () ;
    $db = new Database () ;