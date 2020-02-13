<?php
namespace GoaferLX;
require_once("../Framework/Autoload.php");
new Framework\Autoload();

$router = new Framework\Router(new ToDo\ToDoRoutes());


$base = new Framework\BaseController($router);
$base->execute();


?>
