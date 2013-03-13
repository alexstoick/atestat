<?php
    require_once ( "config/session.php" ) ;
    require_once ( "config/config.php") ;
    require_once ( "config/functions.php" ) ;

?>

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
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
    <![endif]-->
    <!-- Fav and touch icons -->
    <link href="ico/apple-touch-icon-144-precomposed.png" rel="apple-touch-icon-precomposed" sizes="144x144">
    <link href="ico/apple-touch-icon-114-precomposed.png" rel="apple-touch-icon-precomposed" sizes="114x114">
    <link href="ico/apple-touch-icon-72-precomposed.png" rel="apple-touch-icon-precomposed" sizes="72x72">
    <link href="ico/apple-touch-icon-57-precomposed.png" rel="apple-touch-icon-precomposed">
    <link href="ico/favicon.png" rel="shortcut icon">
    <link href="css/footable-0.1.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="navbar navbar-inverse navbar-fixed-top">
        <?php  echo show_menu ( $_SERVER["PHP_SELF"] ) ; ?>
    </div>
    <div class="container">

        <!-- have to show a list of all the items, the quantity reserved and the ability to edit
            that particular item. -->
        <table class="table">
            <thead style="background-color: rgb(130, 185, 236)">
                <tr>
                    <th style="align:center;text-align:center;"> Username</th>
                    <th style="align:center;text-align:center;"> Item description </th>
                    <th style="align:center;text-align:center;"> Quantity stock </th>
                    <th style="align:center;text-align:center;"> Quantity reserved </th>
                    <th style="align:center;text-align:center;"> Date of reservation</th>
                </tr>
            </thead>
            <tbody>
        <?php

            $user_id = $_SESSION [ 'user_id' ] ;

            $query = "SELECT `username` FROM users WHERE id='".$user_id."'" ;
            $result = mysql_query( $query , $connection ) or die ( mysql_error() ) ;
            $username = mysql_result( $result , 0 , "username" ) ;


            //selecting the items that are reserved by this user and are not on an order.
            //(aka have NOT been 'checkouted')
            //
            //
            //Reserved
            //id , item_id, user_id, quantity-reserved, solved, order_no
            //Items
            //quantity, item_code

            $query = "SELECT `username` FROM users WHERE id='".$user_id."'" ;
            $result = mysql_query ( $query , $connection ) or die ( mysql_error() ) ;
            $username = mysql_result( $result , 0 , "username" ) ;

            $query = "SELECT * FROM reserved WHERE user_id='".$user_id."' AND order_no='0'" ;
            $result = mysql_query( $query , $connection ) or die ( mysql_error() ) ;
            $length = mysql_num_rows( $result ) ;

            for ( $i = 0 ; $i < $length ; ++ $i )
            {
                $item_id = mysql_result($result, $i , "item_id" ) ;
                $quantity_reserved = mysql_result ( $result , $i , "quantity" ) ;
                $date = mysql_result( $result , $i , "date") ;

                $query = "SELECT `item_code`,`quantity` FROM items WHERE id='".$item_id."'";
                $local_query = mysql_query( $query , $connection ) or die ( mysql_error() ) ;

                $item_description = mysql_result( $local_query, 0 , "item_code" ) ;
                $quantity_stock = mysql_result( $local_query , 0 , "quantity" ) ;

                if ( $i % 2 )
                    echo '<tr class="success">' ;
                else
                    echo '<tr class="error">' ;

                echo '<td style="align:center;text-align:center;">'.$username.'</td>' ;
                echo '<td style="align:center;text-align:center;">'.$item_description.'</td>' ;
                echo '<td style="align:center;text-align:center;">'.$quantity_stock.'</td>' ;
                echo '<td style="align:center;text-align:center;">'.$quantity_reserved.'</td>' ;
                echo '<td style="align:center;text-align:center;">'.$date.'</td>' ;
                echo '</tr>' ;
            }
        ?>
            </tbody>
        </table>
        <button class="btn">Place order</button>
        <button class="btn disabled"> Export!</button>
    </div> <!-- /container -->

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    <script src="js/bootstrap.min.js"></script>
</body>
</html>