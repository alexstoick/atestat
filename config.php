<?php

	define('BASE_PATH', realpath(dirname(__FILE__)));

	spl_autoload_register('my_autoloader');

	function my_autoloader($class) {
		echo 'Including: '.$class.'<br>';
		$filename = BASE_PATH.DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
		include $class . '.php';
	}