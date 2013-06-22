<?php

namespace Pages\Base;

use Classes\Helper;

class BasicPage {

	protected $helper ;

	function __construct ()
	{
		$this->helper = new Helper();
		$this -> print_head () ;
		$this -> print_nav () ;
	}

	function print_head ()
	{
		echo '
			<!DOCTYPE html>

			<html lang="en">
			<head>
			    <meta charset="utf-8">

			    <title>Warehousing</title>
			    <meta content="width=device-width, initial-scale=1.0" name="viewport">
			    <meta content="" name="description">
			    <meta content="" name="author"><!-- Le styles -->
			    <link href="css/bootstrap.min.css" rel="stylesheet">
			    <link href="css/bootstrap-responsive.min.css" rel="stylesheet"><!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
			</head>
			<body>
			';
	}

	function print_nav ()
	{

		echo '<div class="navbar navbar-inverse navbar-fixed-top">';
        $this->helper -> show_menu ( $_SERVER["PHP_SELF"] ) ;
    	echo '</div>';
    	echo '<div class="container">' ;
	}

	function print_js ( )
	{
		echo '
			<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
			<script src="js/bootstrap.min.js"></script>
			';
	}
	function print_finalMarkup()
	{
		echo '</div>' ; //container
		echo '</body>' ;
		echo '</html>' ;
	}

	function print_Ending ()
	{
		$this -> print_js () ;
		$this -> print_finalMarkup () ;
	}
}