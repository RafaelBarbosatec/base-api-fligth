<?php

class Usuario {

    public static $instance;

    private function __construct() {
        //
    }

    public static function getInstance() {
        
        if (!isset(self::$instance))
            self::$instance = new Usuario();

        return self::$instance;

    }

    public function getAll(){

        //Função que pega o codigo do usuario q requisitou
        // $cod = Flight::cod_usuario();
         $todos = Flight::db()->from('users')
                               // ->sortAsc('cod')
                               // ->join('token_s',array('Usuarios.cod'=>'token_s.cod'))
                                //->update(array('nome'=>'Manuel'))
                               // ->delete()
                                //->execute();
                                ->select()
                                //->value('nome');
                                ->many();

       /* $todos = Flight::db()->from('Usuarios')
                                ->insert(['nome'=>'Rafael aaaaa','sexo'=>'M'])
                                ->execute();
        $todos = Flight::db()->insert_id;*/

        if ($todos) {
            //return Flight::resp($todos, '');
            return $todos;
        }else{
            //echo $read->getError();
			//return Flight::resp($todos,'Ops, ocorreu algum erro!');
            return false;
       
        }

        

    }

    public function sayHello($nome){

        return Flight::json(array('error'=> false, 'mensagem'=> 'Olá! Tudo bem '.$nome.'?'));
    }



}

?>

