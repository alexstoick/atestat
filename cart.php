<?php
    require_once "config/config.php" ;
    use Views\Cart as CartView ;

    $cart = new CartView ( $db ) ;

	$cart -> printPage () ;