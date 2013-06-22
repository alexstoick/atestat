<?php

namespace Classes;

use PDO;

class Database {

	protected static $db = NULL ;

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

	static public function query ( $query , $params = array () )
	{
		$prepared_statement = self::$db -> prepare ($query) ;
		$prepared_statement -> execute ( $params ) ;
		$result = $prepared_statement ->fetchAll(PDO::FETCH_ASSOC) ;
		return $result ;
	}
}
