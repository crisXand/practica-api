<?php
class Db{

    public static function getConn(){
        try {
            //code...
            $conn = new PDO("mysql:dbname=activo_fijo;port=3307;host=localhost", "root", "");
            $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $conn->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, false);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

        return $conn;
    }
}