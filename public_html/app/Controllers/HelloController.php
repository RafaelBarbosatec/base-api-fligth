<?php
class HelloController {

    public static function get(){

        
		return Hello::getInstance()->getAll();

	}

	public static function sayHello($nome){

		return Hello::getInstance()->sayHello($nome);

	}
    
}

?>