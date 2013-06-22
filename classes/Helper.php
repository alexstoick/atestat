<?php

	namespace Classes;

	class Helper {

		function confirm_loggedIn ( )
		{
			return isset ( $_SESSION ['user_id'] ) ;
		}

		function isActive ( $link , $page )
		{
			if ( $link == $page )
				return 'active';
			return '' ;
		}

		function show_menu ( $adress )
		{
			$page = substr ( strrchr($adress, '/') , 1 );

			echo'
				<div class="navbar-inner">
					<div class="container-fluid">
						<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="brand" href="index.php">Warehousing</a>
						<div class="nav-collapse collapse">
							<ul class="nav">
								<li class="'.$this -> isActive ( 'index.php' , $page ).'"><a href="index.php">Home</a></li>
								<li class="'.$this -> isActive ( 'cart.php' , $page ).'"><a href="cart.php">Cart</a></li>
								<li class="'.$this -> isActive ( 'order.php' , $page ).'"><a href="order.php">Orders</a></li>';
								if ( $this -> isActive ( 'index.php' , $page ) )
									echo '<li><a href="#" onclick="logout()">Logout</a></li>';

								echo'
												</ul>
											</div>
											<!--/.nav-collapse -->
										</div>
									</div>';
		}

	}
?>
