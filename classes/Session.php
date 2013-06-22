<?php

	namespace Classes;

	class Session {
		function __construct ()
		{
			session_start();
		}
	}