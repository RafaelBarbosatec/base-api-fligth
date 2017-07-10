<?php

use Medoo\Medoo;

class ConnMedoo extends medoo
{
	public static $instance;
	
	public static function getInstance() {
		if (!isset(self::$instance)) 
		{
			self::$instance = 	new self([
									'database_type' => 'mysql',
									'database_name' => 'flight',
									'server' => 'localhost',
									'username' => 'root',
									'password' => 'root',
									'charset' => 'utf8',
								]);
		}
		return self::$instance;
	}
}