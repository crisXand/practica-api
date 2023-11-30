<?php
class ProductRepository{
    private $conn = null;
    public function __construct() {
        $this->conn = Db::getConn();
    }
    public function get($code){
        $stm = $this->conn->prepare("SELECT * from activos_fijos WHERE codigo = ?");
        $stm->execute([$code]);
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function save($product){
        try {
            $stm = $this->conn
            ->prepare("INSERT into activos_fijos (codigo, tipo_activo_id, descripcion) values (?, ?, ?)");
            $result = $stm->execute([$product["codigo"], $product["tipoActivoId"], $product["descripcion"]]);
            
            if($stm->rowCount() == 0){
                throw new Exception("Type data is wrong");
            }
            $product["id"] = $this->conn->lastInsertId();
            return $product;
            
        } catch (\Exception $e) {
            throw $e;
        }
    }
}