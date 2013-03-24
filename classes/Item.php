<?php

class Item {

	private $name ;
	private $quantity ;
	private $reserved ;
	private $description ;
	private $id ;
	private static $db ;

	//////PUBLIC function

	public function __construct ( $array )
	{
		$this -> id = $array ['id'] ;
		$this -> name = $array [ 'item_code'] ;
		$this -> reserved = $array [ 'reserved' ] ;
		$this -> description = $array [ 'item_description' ] ;
		$this -> quantity = $array [ 'quantity' ] ;
	}

	public function printTableLine ()
	{

		echo '<tr id="coloana'.$this->id.'" style="line-height:15px">' ;

		echo '<td ><a onclick="addToCart('.$this->id.')" class="btn btn-info"><i class="icon-shopping-cart"></i>Add to cart</a></td>' ;
		echo '<td ><a class="btn btn-primary" onclick="loadMoves('.$this->id.')"><i class="icon-align-left"></i>Moves</a></td>';
		echo '<td ><a href="add_move.php?item='.$this->name.'" class="btn btn-warning"><i class="icon-ok"></i><i class="icon-remove"></i>Add move</a></td>';
		echo '<td class="expand" >'. $this->name.'</td>' ;
		echo '<td>'. $this->description.'</td>';
		echo '<td>'. $this->quantity. '</td>';
		echo '<td>'. $this->reserved. '</td>';

		echo '</tr>' ;
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


	//////STATIC functions

	public static function getItemWithId ( $id )
	{
		$db = new Database () ;
		$query = "SELECT * FROM items WHERE `id`= :item_id" ;
		$query_result = $db -> query ( $query , array ( "item_id" => $id ) ) ;
		$newItem = new Item ( $query_result[0] ) ;
		return $newItem ;
	}



}

?>