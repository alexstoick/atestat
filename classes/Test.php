<?php

namespace Classes;

class Test implements Base\Object {

	public function find ( $id )
	{
		echo $id.'<br>';
	}
}
