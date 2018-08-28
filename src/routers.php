<?php

Flight::route('/', function(){

    $session = Flight::get('session');
    Flight::resp("Bem vindo a API ".$session->data->name."(".$session->data->id.")");

});

Flight::route('POST /token', function(){
    
    $body = Flight::data();

    $jwt = JWTWrapper::encode([
        'expiration_sec' => LIVE_SESSION,
        'iss' => 'rafelbarbosatec.githib.io',
        'userdata' => [
            'id' => 1,
            'name' => 'Rafael Almeida'
        ]
    ]);

    $resp['access_token'] = $jwt;
    $resp['expire_in'] = LIVE_SESSION;
    Flight::resp($resp);

});

Flight::route('/usuarios', array('UsuariosController','get'));

?>