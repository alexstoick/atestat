    <div class="container">
        <div id="dateSelection-modal" class="modal hide fade" aria-hidden="true" style="left:10%; margin-left:0%; width:80%">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div id="dateSelection" class="modal-body">

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
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div id="data" class="modal-body"></div>
            <div id="modal-footer" style="padding:10px">
                <button data-dismiss="modal" class="btn" aria-hidden="true" onclick="showDateModal()">Close</button>
            </div>

        </div>

    </div> <!-- /container -->

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
