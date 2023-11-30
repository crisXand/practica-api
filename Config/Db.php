<?php
class Db{

    public static function getConn(){
        try {
            //code...
            $conn = new PDO("mysql:dbname=activo_fijo;host=10.254.50.250", "athenadev", "athenadev");

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

        return $conn;
    }
}