<?php

Flight::set('flight.log_errors', true);

Flight::map('db', function(){
    return ConnSparrow::getInstance();
});

//Retorno para rota não encontrada
Flight::map('notFound', function(){
    // Display custom 404 page
    return Flight::json(array('op'=> false,'msg'=>'Rota não encontrada'));
});

Flight::map('resp', function($data){

    $resp['op'] = true;
	$resp['data'] = $data;

	return Flight::json($resp,200);

});

Flight::map('mError', function($msg, $cod = 200){

    $resp['op'] = false;
    $resp['msg'] = $msg;

	return Flight::json($resp,$cod);

});

Flight::map('data', function(){

    $get_string = Flight::request()->getBody();

    parse_str($get_string, $params_array);
    
    return $params_array;

});


//Middleware que verifica existencia do token jwt e se é valido
Flight::before('start', function(&$params, &$output){
    
    if (!(Flight::request()->url == '/token'
     && Flight::request()->method == 'POST')){

        $header = getallheaders();

        if(isset($header['Authorization'])){

            $authorization = $header['Authorization'];

            list($jwt) = sscanf($authorization, 'Bearer %s');

            if($jwt) {

                try {

                    Flight::set('session', JWTWrapper::decode($jwt));

                } catch(Exception $ex) {
                    // nao foi possivel decodificar o token jwt
                    echo Flight::mError('Acesso nao autorizado', 401);
                    exit();
                }
     
            } else {
                // nao foi possivel extrair token do header Authorization
                echo Flight::mError('Token nao informado', 401);
                exit();
            }

        }else {
            // nao foi possivel extrair token do header Authorization
            echo Flight::mError('Token nao informado', 401);
            exit();
        }
    }

});

// Get an instance of your class
// This will create an object with the defined parameters
//
//     new PDO('mysql:host=localhost;dbname=test','user','pass');
//
//$db = Flight::db();

?>
