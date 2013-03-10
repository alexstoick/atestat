<?php

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
    <style type="text/css">
        body {
            padding-top:60px;
        }
        .sidebar-nav {
            padding: 9px 0;
        }
        @media (max-width:980px) {
            /* Enable use of floated navbar text */
            .navbar-text.pull-right {
                float:none;
                padding-left:5px;
                padding-right: 5px;
            }
        }
        /* Custom container */
        .container {
            margin:0 auto;
            max-width:80%;
        }
        .container>hr {
            margin: 60px 0;
        }
    </style>

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
        <div id="dateSelection-modal" class="modal hide fade" aria-hidden="true" data-backdrop="static" style="left:10%; margin-left:0%; width:80%">
            <div id="dateSelection" style="padding:10px;">

                <form class="form-horizontal" onsubmit="processForm(); return false;">
                    <div class="control-group" id="starting_date">

                        <label class="control-label" for="month">Beggining date:</label>
                            <div class="controls">
                                <select id="start_year">
                                        <option>- Year -</option>
                                        <option value="2011">2011</option>
                                        <option value="2012">2012</option>
                                        <option value="2013">2013</option>
                                        <option value="2014">2014</option>
                                </select>
                                <select id="start_month">
                                    <option>- Month -</option>
                                    <option value="1">January</option>
                                    <option value="2">February</option>
                                    <option value="3">March</option>
                                    <option value="4">April</option>
                                    <option value="5">May</option>
                                    <option value="6">June</option>
                                    <option value="7">July</option>
                                    <option value="8">August</option>
                                    <option value="9">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>

                            <select id="start_day">
                                <option>- Day -</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group" id="finish_date">
                        <label class="control-label" for="month">Ending date:</label>
                            <div class="controls">
                                <select id="fin_year">
                                    <option>- Year -</option>
                                    <option value="2011">2011</option>
                                    <option value="2012">2012</option>
                                    <option value="2013">2013</option>
                                    <option value="2014">2014</option>
                                </select>
                                <select id="fin_month">
                                    <option>- Month -</option>
                                    <option value="1">January</option>
                                    <option value="2">February</option>
                                    <option value="3">March</option>
                                    <option value="4">April</option>
                                    <option value="5">May</option>
                                    <option value="6">June</option>
                                    <option value="7">July</option>
                                    <option value="8">August</option>
                                    <option value="9">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>

                            <select id="fin_day">
                                <option>- Day -</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <button type="submit" class="btn">Submit</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

        <div id="data-modal" class="modal hide fade" aria-hidden="true" data-backdrop="static">
            <div id="data"></div>
            <div id="modal-footer" style="padding:10px;">
                <button data-dismiss="modal" class="btn" aria-hidden="true" onclick="showDateModal()">Close</button>
            </div>

        </div>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    <script type="text/javascript">
        function showDateModal ( )
        {
            $("#dateSelection-modal").modal('show');
        }
        $(function()
            {
                $("#dateSelection-modal").modal('show');
            });
        function processForm ( )
        {
            from_year = $("#start_year").val() ;
            from_month = $("#start_month").val() ;
            from_day = $("#start_day").val() ;

            to_year = $("#fin_year").val() ;
            to_month = $("#fin_month").val() ;
            to_day = $("#fin_day").val() ;

            default_year =  "- Year -" ;
            default_month = "- Month -" ;
            default_day = "- Day -" ;

            if ( ( from_year == default_year || to_year == default_year ) ||
                ( from_month == default_month || to_month == default_month ) ||
                ( from_day == default_day || to_day == default_day ) )
                    console.log ( "fail" ) ;

            console.log ( from_year + " " + from_month + " " + from_day ) ;
            console.log ( to_year + " " + to_month + " " + to_day ) ;
            $("#data").load ( "ajax/getMoves.php?id="+<?= $_GET['id'] ?>+"&from_year="+from_year+"&from_month="+from_month+"&from_day="+from_day+
                                "&to_year="+to_year+"&to_month="+to_month+"&to_day="+to_day , function () {
                                $("#dateSelection-modal").modal('hide') ;
                                $("#data-modal").modal('show'); } ) ;
        }

    </script>

    <script src="js/bootstrap.min.js"></script>
</html>