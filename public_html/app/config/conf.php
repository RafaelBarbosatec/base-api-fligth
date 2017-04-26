<?php

Flight::set('flight.log_errors', true);

Flight::register('db', 'PDO', array('mysql:host=localhost;dbname=flight','root','root'),
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
    	$token = substr($header['Authorization'],6);

	    if (empty($token) || $token != TOKEN_AUTHORIZATION) {
	    	echo Flight::json(array('error'=> true, 'data'=> array('mensagem'=>'Não autorizado')));
    		Flight::halt();
	    }

    }else{
    	echo Flight::json(array('error'=> true, 'data'=> array('mensagem'=>'Não autorizado')));
    	Flight::halt();
    }
 
});

// Get an instance of your class
// This will create an object with the defined parameters
//
//     new PDO('mysql:host=localhost;dbname=test','user','pass');
//
//$db = Flight::db();
include 'autoload.php';
?>