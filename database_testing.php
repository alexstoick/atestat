<?php

class Database {

	static $db = NULL ;

	public function __construct ( )
	{
		if ( self::$db == NULL )
		{
			$db_user = "root" ;
			$db_password = "" ;
			$db_name = "warehous_lucru" ;
			$db_host = "localhost" ;
			self::$db = new PDO ( 'mysql:host='.$db_host.';dbname='.$db_name , $db_user , $db_password ) ;
		}
	}

	public function query_database ( $query , $params )
	{
		$prepared_statement = self::$db -> prepare ($query) ;
		$prepared_statement -> execute ( $params ) ;
		$result = $prepared_statement ->fetchAll(PDO::FETCH_ASSOC) ;
		return $result ;
;	}
}

$db_conn = new Database () ;

$user_id = "1" ;
$result = $db_conn -> query_database ( "SELECT * FROM users WHERE `id`= :user_id" , array ( "user_id" => $user_id ) ) ;

foreach ( $result as $row )
	print_r ( $row ) ;
?>