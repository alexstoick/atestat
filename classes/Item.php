<?php

namespace Classes;
use Classes\Base\Object;

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


	public function printTableLine ()
	{

		echo '<tr id="linia'.$this->id.'" style="line-height:15px">' ;

		echo '<td ><a onclick="addToCart('.$this->id.')" class="btn btn-info"><i class="icon-shopping-cart"></i>Add to cart</a></td>' ;
		echo '<td ><a class="btn btn-primary" onclick="loadMoves('.$this->id.')"><i class="icon-align-left"></i>Moves</a></td>';
		echo '<td ><a onclick="addMove('.$this->id.')" class="btn btn-warning"><i class="icon-ok"></i><i class="icon-remove"></i>Add move</a></td>';
		echo '<td class="expand" >'. $this->name.'</td>' ;
		echo '<td>'. $this->description.'</td>';
		echo '<td id="quantity'.$this->id.'">'. $this->quantity. '</td>';
		echo '<td id="reserved'.$this->id.'">'. $this->reserved. '</td>';

		echo '</tr>' ;
	}

}
