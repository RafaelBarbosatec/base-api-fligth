<?php

require 'flight/Flight.php';

define('TOKEN_AUTHORIZATION', '123456');

include 'app/config/conf.php';

/*Caso queira ativar autenticação no header favor descomentar
MODELO: Authorization: token={TOKEN_AUTHORIZATION}
*/
//Flight::Auth();

include 'app/routers.php';

Flight::start();

?>
