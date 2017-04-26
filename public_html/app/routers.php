<?php

Flight::route('/', function(){
    echo 'hello world! Fligth';
});


Flight::route('/oi', array('HelloController','get'));
Flight::route('/ai/@nome', array('HelloController','sayHello'));

?>