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

        /*$read = new Read();
        $read->ExeRead('Usuarios', '');
        $todos = $read->getResult();*/
        /*$all = array();
        foreach ($todos as $key => $value) {
            $res['nome'] = $value['NOME_USER'];
            $all[] = $res;
        }*/

        //Função que pega o codigo do usuario q requisitou
        // $cod = Flight::cod_usuario();
        $todos = Flight::db()->select('User','*');

        if ($todos) {
            return Flight::resp($todos, '');
        }else{
            //echo $read->getError();
			return Flight::resp($todos,'Ops, ocorreu algum erro!');
       
        }

        

    }

    public function sayHello($nome){

        return Flight::json(array('error'=> false, 'mensagem'=> 'Olá! Tudo bem '.$nome.'?'));
    }



}


/* EXEMPLOS CONEXÃO

        private function Create(){
            $cadastra = new Create();
            $cadastra->ExeCreate(self::Entity, $this->Data);
            if($cadastra->getResult()):
                $this->Error  = array("O post <b>{$this->Data['NOME_USUARIO']}</b>, foi cadastrado com sucesso no sistema!", WS_ACCEPT);
                $this->Result = $cadastra->getResult(); 
            endif;
        }

        private function Update(){
            $update = new Update();
            $update->ExeUpdate(self::Entity, $this->Data,"WHERE COD_USUARIO = :id", "id={$this->Post}");
            if($update->getResult()):
                $this->Error  = array("O usuario <b>{$this->Data['NOME_USUARIO']}</b>, foi atualizado com sucesso no sistema!", WS_ACCEPT);
                $this->Result = true;
            endif;
        }

*/

?>

