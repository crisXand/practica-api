<?php

header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json");
header("Access-Control-Allow-Methods: GET,PUT,POST,DELETE");
header("Access-Control-Allow-Headers: Access-Control-Allow-Origin,Content-Type,Access-Control-Allow-Methods");


require_once __DIR__ . "/Config/Db.php";

$uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$uri = explode("/", $uri);
$requestMethod = null;
$resource =  isset($uri[3]) ? ucfirst($uri[3]) : "";
$fileController = __DIR__ . "/Controllers/" . $resource . "Controller.php";
$fileRepository = __DIR__ . "/Repositories/" . $resource . "Repository.php";

if(file_exists($fileController) && file_exists($fileRepository)){
    require_once $fileController;
    require_once $fileRepository;
    $resource = $resource . "Controller";
    $idElement = isset($uri[4]) ? $uri[4] : null;
    $requestMethod = $_SERVER["REQUEST_METHOD"];
    $controller = new $resource;
}

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
        http_response_code(404);
        break;
}
