<?php

Flight::route('/', function(){
    echo 'hello world! Fligth';
});


Flight::route('/usuarios', array('UsuariosController','get'));
//Flight::route('/@nome', array('UsuariosController','sayHello'));

?>