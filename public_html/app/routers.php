<?php

Flight::route('/', function(){
    echo 'hello world! Fligth';
});


Flight::route('/usuarios', array('UsuariosController','get'));
//Flight::route('/ai/@nome', array('HelloController','sayHello'));

?>