<?php
class UsuariosController {

    public static function get(){
        
        //Flight::cod_usuario();

        // Exemplo uso da class de Criptografia DES
        /*$des = new Des('123456');

        $c = $des->Encrypt(json_encode($usuarios));
        $d = $des->Decrypt($c);*/

        
         //   Exemplo do uso de CACHE
         //Sempre que necessitar o codigo do usuário da requisição usar
    

        //$c = new Cache();

        // Seta arquivo de cache, se existe arquivo, seleciona, se não existe cria;
       // $c->setCache('usuarios_cache');

        //Verifica se tem algo em cache com a chave "usuario"
        // if ($c->isCached('usuarios')) {

        //     return Flight::resp($c->retrieve('usuarios'));

        // }else{
        
        //     $usuarios = Usuario::getInstance()->getAll();

        //     if ($usuarios) {
        //         $c->store('usuarios',$usuarios);
        //     	return Flight::resp($c->retrieve('usuarios'));
        //     }else{
        //     	return Flight::resp('','Erro ao retornar usuários');
        //     }
        // }

        return Flight::resp("Aqui deveria listar os usuarios");
		

	}

	public static function sayHello($nome){

		return Flight::resp($nome);

	}
    
}

?>
