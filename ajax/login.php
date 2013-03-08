<?php
	require_once ( "../config/session.php") ;
	require_once ( "../config/config.php" ) ;

	$result = array ( ) ;

	if ( isset ( $_POST['username'] )
		&& isset ( $_POST [ 'password'] ) )
	{
		$username = $_POST ['username'] ;
		$hashed_password = $_POST [ 'password'] ;

		$query = "SELECT id FROM users WHERE username='".$username."' AND hashed_password='".$hashed_password."' LIMIT 1";
		$query_result = mysql_query ( $query , $connection ) or die ( mysql_error () ) ;
		if ( mysql_num_rows ( $query_result ) > 0 )
		{
			$_SESSION['user_id']=mysql_result ( $query_result , 0 , 'id' ) ;
			$_SESSION['username']= $_POST [ 'username' ] ;
			$_SESSION['nr_linii'] = 20 ;
			$_SESSION['startRow'] = 0 ;
			$result["loggedIn"] = true ;
			$result["justSet"] = true ;
		}
		else
			$result["loggedIn"] = false ;
	}
	elseif ( isset($_SESSION['user_id']) )
	{
		$result["loggedIn"] = true ;
		$result["wasSet"] = true ;
	}
	else
	{
		$result["loggedIn"] = false ;
		$result["wasSet"] = false ;
	}

	echo json_encode($result);
?>
