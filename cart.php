<?php
    require_once "config/config.php" ;
    use Pages\Cart as CartView ;

    $cart = new CartView ( $db ) ;