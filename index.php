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
		<div id="tablePlace">
		</div>

		<div class="progress progress-striped active" id="loadingBar">
			<div class="bar" style="width: 40%;" ></div>
		</div>

		<form class="form-horizontal" onsubmit="login(); return false;" style="display:none;">
			<div class="control-group" id="username_group">
				<label class="control-label" for="username">Username</label>
				<div class="controls">
					<input type="text" id="username" placeholder="Email">
				</div>
			</div>
			<div class="control-group" id="password_group">
				<label class="control-label" for="password">Password</label>
				<div class="controls">
					<input type="password" id="password" placeholder="Password">
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
					<button type="submit" class="btn">Sign in</button>
				</div>
			</div>
		</form>
		<div id="index-data">
		</div>
	</div> <!-- /container -->

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

	<script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/sha1.js"></script>

	<script>
		$(function(){
			check_if_loggedIn ( );
		});

		function addToCart ( i )
		{
			$("#index-data").load ( "modal/add_cart.php?id=" + i ) ;
		}

		function loadMoves ( i )
		{
			$("#index-data").load ( "modal/moves.php?id=" + i ) ;
		}

		function check_if_loggedIn ( )
		{
			$.ajax({
				type:"POST",
				url: "ajax/login.php",
				dataType:"json",
				success: function(data){
					if ( data["loggedIn"] == true )
					{
						$(".form-horizontal").hide();
						$('#tablePlace').load("table.php?i=1&total=20" , function ()  {
							$("#loadingBar").hide(); } ) ;
					}
					else
					{
						$(".form-horizontal").show();
						$("#loadingBar").hide();
					}
				}
			});
		}

		function login ( )
		{
			username = $("#username").val()
			password = $("#password").val() ;
			encrypted_password = CryptoJS.SHA1(password); ;

			data = 'username='+username+'&password='+encrypted_password ;
			$.ajax({
				type:"POST",
				url: "ajax/login.php",
				dataType:"json",
				data: data,
				success: function(data){
					if ( data["loggedIn"] == true )
					{
						//hide the login form and show the table
						$(".form-horizontal").hide();
						$("#loadingBar").show();
						$('#tablePlace').load("table.php?i=1&total=20" , function ()  {
							$('#tablePlace').show();
							$("#loadingBar").hide(); } ) ;
					}
					else
					{
						//add a red frame to the user&password
						$(".control-group").addClass ( "error" ) ;
					}
				}
			});
		}
	</script>

	<script src="js/bootstrap.min.js"></script>
</body>
</html>