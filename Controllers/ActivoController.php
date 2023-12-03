<?php

class ActivoController{

    private $repository = null;
    public function __construct() {
        $this->repository = new ProductRepository();
    }
    
    public function get($body = null,$param =null ){
        if(isset($body["codigo"])){
            $result = $this->repository->get($body["codigo"]);
            if(!empty($result)){
                echo json_encode($result);
            }else{
                http_response_code(404);
                echo "Activo not found";
            }
        }else{
            http_response_code(400);
            echo json_encode(["message" => 12]);
        }
    }

    public function save($body){
        try {
            if(isset($body["codigo"]) && isset($body["tipoActivoId"]) && isset($body["descripcion"])){
                $result = $this->repository->save($body);
                http_response_code(201);
                echo json_encode($result);
            }else{
                http_response_code(400);
                echo "Body request is wrong";
            }
            
        } catch (\Exception $e) {
            http_response_code(400);
            echo $e->getMessage();
            
        }
    }
}