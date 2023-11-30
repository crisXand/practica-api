<?php

header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json");
header("Access-Control-Allow-Methods: GET,PUT,POST,DELETE");
header("Access-Control-Allow-Headers: Access-Control-Allow-Origin,Content-Type,Access-Control-Allow-Methods");

require_once __DIR__ . "/Controllers/ActivoController.php";
require_once __DIR__ . "/Repositories/ActivoRepository.php";
require_once __DIR__ . "/Controllers/AsignacionController.php";
require_once __DIR__ . "/Repositories/AsignacionRepository.php";

require_once __DIR__ . "/Config/Db.php";

$uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$uri = explode("/", $uri);
$resource = ucfirst($uri[3]) . "Controller";
$idElement = isset($uri[4]) ? $uri[4] : null;
$requestMethod = $_SERVER["REQUEST_METHOD"];
$controller = new $resource;
switch ($requestMethod) {
    case 'GET':
        $body = json_decode(file_get_contents("php://input"), true);
        
            $controller->get($body);
        
        break;
    case "POST":
        $body = json_decode(file_get_contents("php://input"), true);
        $controller->save($body);
        break;
        
    case "DELETE":
        $controller->delete($idElement);
        break;
    default:
        # code...
        break;
}
