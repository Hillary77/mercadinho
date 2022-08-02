<?php

//define('URL', $_SERVER['HTTP_HOST']);
//var_dump(URL); (achar com mais facilidade as pastas)
/* Modal
 * Encaminha informação do banco para o controller
 */
define('HOST', 'localhost');
define('USER', 'root');
define('BASE', 'epl');
define('PASS', '');

$pdo = new PDO("mysql:host=localhost; dbname=epl", USER, PASS);

date_default_timezone_set('America/Sao_Paulo');
