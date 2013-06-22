<?php

	namespace Views;

	use Classes\Database;
	use Classes\Item;

	class Cart extends Base\BasicPage implements Base\ViewInterface {

		public function printView ( )
		{
			echo '
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
            <tbody>';
            $this -> print_page () ;
		}

	}

