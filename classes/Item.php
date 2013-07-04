<?php

namespace Classes;

class Item implements Base\Object {

	private $name ;
	private $quantity ;
	private $reserved ;
	private $description ;
	private $id ;
	protected static $db ;

	/***
		Interface functions
	*/

	static public function find ( $id )
	{
		Item::$db = new Database () ;
		$query = "SELECT * FROM items WHERE `id`= :item_id" ;
		$query_result = Item::$db -> query ( $query , array ( "item_id" => $id ) ) ;
		return new Item ( $query_result[0] ) ;
	}

	/***
		Item functions
	***/

	public function __construct ( $array = null )
	{
		$this -> id = $array ['id'] ;
		$this -> name = $array [ 'item_code'] ;
		$this -> reserved = $array [ 'reserved' ] ;
		$this -> description = $array [ 'item_description' ] ;
		$this -> quantity = $array [ 'quantity' ] ;

		if ( ! isset ( Item::$db) )
			Item::$db = new Database () ;
	}

	public function setQuantity ( $quantity_new )
	{
		$query = "UPDATE items SET `quantity`= :quantity WHERE `id`= :item_id" ;
		Item::$db -> query ( $query , array ( "quantity" => $quantity_new , "item_id" => $this->id) ) ;
	}

	public function setReserved ( $reserved_new )
	{
		$query = "UPDATE items SET `reserved`= :reserved WHERE `id`= :item_id" ;
		Item::$db -> query ( $query , array ( "reserved" => $reserved_new ,"item_id" => $this->id ) ) ;
	}

	public function getId ( )
	{
		return $this->id;
	}

	public function getName ( )
	{
		return $this->name ;
	}

	public function getQuantity()
	{
		return $this->quantity;
	}

	public function getDescription()
	{
		return $this->description;
	}

	public function getReserved()
	{
		return $this->reserved;
	}
}
