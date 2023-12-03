<?php

class AsignacionController{

private $repository = null;
public function __construct() {
    $this->repository = new AsignacionRepository();
}

    public function save($body){
        if(isset($body["personasId"]) && isset($body["activosFijosId"])){
            try {
                $result = $this->repository->post($body);
                http_response_code(201);
                echo json_encode($result);
            } catch (\Exception $e) {
                http_response_code(400);
                echo $e->getMessage();
            }
        }else{
            http_response_code(400);
            echo json_encode("Body request is wrong");
        }
    }

public function get($param){
    $result = $this->repository->get();
    if(isset($result)){
        echo json_encode($result);
    }else{
        http_response_code(404);
        echo "Asignacion not found";
    }
}

public function delete($param){
    if($param != null){
        $result = $this->repository->delete($param);
        if($result > 0){
            http_response_code(204);
            echo json_encode($result);
        }else{
            http_response_code(404);
            echo "Asignacion to activo {$param} not found";
        }

    }else{
        http_response_code(404);
        echo "Asignacion id is missing";
    }
}
}