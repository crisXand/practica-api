<?php
class AsignacionRepository{
    private $conn = null;
    public function __construct() {
        $this->conn = Db::getConn();
    }
    public function get(){
        $stm = $this->conn->prepare("SELECT * from asignaciones a INNER JOIN activos_fijos act on a.activos_fijos_id =act.id_activo_fijo
        INNER JOIN personas p on a.personas_id = p.id_persona INNER JOIN areas_trabajo t on p.areas_trabajo_id = t.id_areas_trabajo");
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($activoId){
        
        $stm = $this->conn->prepare("DELETE FROM asignaciones a where activos_fijos_id  = (select a.id_activo_fijo from activos_fijos a where a.id_activo_fijo = ?)");
        $result = $stm->execute([$activoId]);

        return $stm->rowCount();
    }

    public function post($asignacion){
        try {
            $stm = $this->conn
            ->prepare("INSERT INTO asignaciones (personas_id, activos_fijos_id) VALUES (?,?);");
            $result = $stm->execute([$asignacion["personasId"], $asignacion["activosFijosId"]]);
            
            if($stm->rowCount() == 0){
                throw new Exception("Type data is wrong");
            }
            $asignacion["id"] = $this->conn->lastInsertId();
            return $asignacion;
            
        } catch (\Exception $e) {
            throw $e;
        }
    }

}