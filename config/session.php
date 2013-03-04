<?php
	session_start();
	
	function redirect_to( $location = NULL ) {
		if ($location != NULL) {
			header("Location: {$location}");
			exit;
		}
	}
	
	function logged_in() {
		return isset($_SESSION['user_id']);
	}
	
	function confirm_logged_in() {
		if (!logged_in()) 
		{
			redirect_to("login.php");
		}
	}
	function check_all_vars() {
		if ( $_SESSION['startRow']<0)
			$_SESSION['startRow']=0;
		if ( $_SESSION['startRow']>4000)
			$_SESSION['startRow']=0;
	}
	function confirm_admin() {
		return true ;
		/****************
		HAS TO BE CHANGED
		if ( $_SESSION['username'] == "admin" ) 
			return true ;
		return false;
		*/
	}
	
	define ("MAX_SIZE","25000");
	
	function redirect ( $location )
	{
		echo '<script>
				<!--
					location.replace("'.$location.'");
				-->
			  </script>';
	}
?>
<script type="text/javascript">

	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-27142889-1']);
	  _gaq.push(['_trackPageview']);

	  (function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();

</script>