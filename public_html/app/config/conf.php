<?php
use Medoo\Medoo;
Flight::set('flight.log_errors', true);

/*Flight::register('db', 'PDO', array('mysql:host=localhost;dbname=fligth','root','root'),
  function($db){
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
);*/

Flight::map('db', function(){
    //return ConnMedoo::getInstance();
    return ConnSparrow::getInstance();
});

//Retorno para rota não encontrada
Flight::map('notFound', function(){
    // Display custom 404 page
    return Flight::json(array('op'=> false,'msg'=>'Rota não encontrada'));
});

//Autorização do header
// Authorization: 123456
/*Flight::map('Auth', function(){
    $header = getallheaders();
    if (isset($header['Authorization'])) {

        $count = Flight::db()->from('token_s')
                                ->where('token',$header['Authorization'])
                                ->count();

        if ($count == 0) {
            echo Flight::json(array('op'=> false,'msg'=>'Não autorizado'));
            Flight::halt();
        }

    }else{
    	echo Flight::json(array('op'=> false,'msg'=>'Não autorizado'));
    	Flight::halt();
    }
 
});*/

// Função pra pegar o id do usuário q realizou a requizição com autorização no header
// x-api-key = {token}
Flight::map('cod_usuario',function(){
    $header = getallheaders();
    if (isset($header['x-api-key'])){

        $cod_usuario = Flight::db()->from('token_s')
                     ->where('token',$header['x-api-key'],1)
                     ->value('cod');
        
        if (empty($cod_usuario)) {

            echo Flight::json(array('op'=> false,'msg'=>'Não autorizado'));
            Flight::halt();

        }else{

             return $cod_usuario;

        }

    }else{
         echo Flight::json(array('op'=> false,'msg'=>'Não autorizado'));
         Flight::halt();
    }
});

Flight::map('resp', function($data,$msg = '',$cod = 200){

	$op = true;
	if(!empty($msg)){
		$op = false;

	}

    $resp['op'] = $op;
    $resp['msg'] = $msg;
	if(!empty($data)){
		$resp['data'] = $data;
	}

	return Flight::json($resp,$cod);

});

// Get an instance of your class
// This will create an object with the defined parameters
//
//     new PDO('mysql:host=localhost;dbname=test','user','pass');
//
//$db = Flight::db();
include 'autoload.php';

?>
