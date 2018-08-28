<?php


class ConnSparrow
{
	public static $instance;
	
	public static function getInstance() {
		if (!isset(self::$instance)) 
		{
			self::$instance = 	new Sparrow();
			self::$instance->setDb([
									'type' => 'pdomysql',
									'database' => 'flight',
									'hostname' => 'localhost',
									'username' => 'root',
									'password' => 'root',
								]);
		}
		return self::$instance;
	}
}