<?php
    require_once "config/config.php" ;
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
</head>

<body>
    <div class="navbar navbar-inverse navbar-fixed-top">
        <?php  echo $helper -> show_menu ( $_SERVER["PHP_SELF"] ) ; ?>
    </div>
    <div class="container">

        <!-- have to show a list of all the items, the quantity reserved and the ability to edit
            that particular item. -->
        <table class="table">
            <thead style="background-color: rgb(130, 185, 236)">
                <tr>
                    <th style="text-align:center;"> Username</th>
                    <th style="text-align:center;"> Item description </th>
                    <th style="text-align:center;"> Quantity stock </th>
                    <th style="text-align:center;"> Quantity reserved </th>
                    <th style="text-align:center;"> Date of reservation</th>
                </tr>
            </thead>
            <tbody>
        <?php

            $user_id = $_SESSION [ 'user_id' ] ;

            $query = "SELECT `username` FROM users WHERE id= :user_id" ;

            $result = $db -> query ( $query , array ( "user_id" => $user_id ) ) ;

            $username = $result [0]['username'] ;


            //selecting the items that are reserved by this user and are not on an order.
            //(aka have NOT been 'checkouted')
            //
            //
            //Reserved
            //id , item_id, user_id, quantity-reserved, solved, order_no
            //Items
            //quantity, item_code
            //
            //

            $query = "SELECT reserved.item_id, reserved.quantity AS  `reserved quantity` , users.username, items.item_code, items.quantity, reserved.date
                        FROM reserved, users, items
                        WHERE  `user_id` ='".$user_id."'
                        AND items.id = reserved.item_id AND `order_no`=0" ;

            $result = $db -> query ( $query , array ( "user_id" => $user_id ) ) ;
            $i = 0 ;
            foreach ( $result as $row )
            {
            	$quantity_reserved = $row [ "reserved quantity" ] ;
            	$date = $row [ "date" ] ;
            	$item_description = $row ["item_code" ] ;
            	$quantity_stock = $row [ 'quantity' ] ;

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
                ++ $i;
            }
        ?>
            </tbody>
        </table>
        <button class="btn">Place order</button>
        <button class="btn disabled"> Export!</button>
    </div> <!-- /container -->

</body>
</html>