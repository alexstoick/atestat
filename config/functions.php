<?php

	function confirm_loggedIn ( )
	{
		return isset ( $_SESSION ['user_id'] ) ;
	}
?>