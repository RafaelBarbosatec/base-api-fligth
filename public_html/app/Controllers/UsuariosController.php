<?php
class UsuariosController {

    public static function get(){
        
		return Usuario::getInstance()->getAll();

	}

	public static function sayHello($nome){

		return Usuario::getInstance()->sayHello($nome);

	}
    
}

?>