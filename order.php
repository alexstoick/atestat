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
        <?php  echo $helper -> show_menu ( $_SERVER["PHP_SELF"] ) ; ?>
    </div>
    <div class="container">

        <!-- have to show a list of all the items, the quantity reserved and the ability to edit
            that particular item. -->
        <table class="table">
            <thead style="background-color: rgb(130, 185, 236)">
                <tr>
                    <th style="text-align:center;"> Order number</th>
                    <th style="text-align:center;"> User that order</th>
                </tr>
            </thead>
            <tbody>
        <?php

            //SELECT user_id,order it din reserved
            //username din users cu user_id din reserved

            $query = "SELECT DISTINCT reserved.user_id, reserved.order_no , users.username
                        FROM reserved, users
                        WHERE  users.id = reserved.user_id
                        AND order_no>0" ;

            $result = $db -> query ( $query ) ;
            print_r ( $result ) ;
            $i = 0 ;
            foreach ( $result as $row )
            {
            	$order_no = $row [ "order_no" ] ;
            	$username = $row ["username"] ;
 
                if ( $i % 2 )
                    echo '<tr class="success">' ;
                else
                    echo '<tr class="error">' ;

                echo '<td style="text-align:center; line-height: 10px;" class="link" onclick="showOrder('.$order_no.')">'.$order_no.'</td>' ;
                echo '<td style="text-align:center; line-height: 10px;">'.$username.'</td>' ;
                echo '</tr>' ;
                ++ $i;
            }
        ?>
            </tbody>
        </table>
        <div id="order-data">
        </div>
        <button class="btn disabled"> Export!</button>
    </div> <!-- /container -->

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    <script src="js/bootstrap.min.js"></script>

    <script type="text/javascript">

    	function showOrder ( orderNo )
    	{
    		$("#order-data").load ( "modal/inspect_order.php?orderNo=" + orderNo ) ;
    	}

    </script>
</body>
</html>