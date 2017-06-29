<?php

Flight::set('flight.log_errors', true);

Flight::register('db', 'PDO', array('mysql:host=localhost;dbname=fligth','root','root'),
  function($db){
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
);

//Retorno para rota não encontrada
Flight::map('notFound', function(){
    // Display custom 404 page
    return Flight::json(array('error'=> true,'mensagem'=>'Rota não encontrada'));
});

//Autorização do header
// Authorization: token=123456
Flight::map('Auth', function(){
    $header = getallheaders();
    if (isset($header['Authorization'])) {

        $read = new Read();
        $read->ExeRead('token_s', "where token = '".$header['Authorization']."'");

        if ($read->getRowCount() == 0) {
            echo Flight::json(Flight::resp('','Nao autorizado.'));
            Flight::halt();
        }
    	/*$token = substr($header['Authorization'],6);

	    if (empty($token) || $token != TOKEN_AUTHORIZATION) {
	    	echo Flight::json(array('error'=> true, 'data'=> array('mensagem'=>'Não autorizado')));
    		Flight::halt();
	    }*/

    }else{
    	echo Flight::json(Flight::resp('','Nao autorizado.'));
    	Flight::halt();
    }
 
});

// Função pra pegar o id do usuário q realizou a requizição com autorização no header
Flight::map('cod_usuario',function(){
    $header = getallheaders();
    if (isset($header['Authorization'])){
        $read = new Read();
        $read->ExeRead('token_s', "where token= '".$header['Authorization']."' limit 1");

        return $read->getResult()[0]['cod'];
    }else{
        return false;
    }
});

Flight::map('resp', function($data,$msg){

	$op = true;
	if(!empty($msg)){
		$op = false;
	}

	if(empty($data)){
		$data = array();
	}

	return array('op'=> $op,'msg'=>$msg,'data'=>$data);

});

// Get an instance of your class
// This will create an object with the defined parameters
//
//     new PDO('mysql:host=localhost;dbname=test','user','pass');
//
//$db = Flight::db();
include 'autoload.php';
?>
