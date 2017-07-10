<?php
class UsuariosController {

    public static function get(){
        
       // Flight::Auth();
        
		return Flight::json(Usuario::getInstance()->getAll());

	}

	public static function sayHello($nome){

		return Flight::json(Usuario::getInstance()->sayHello($nome));

	}
    
}

?>
