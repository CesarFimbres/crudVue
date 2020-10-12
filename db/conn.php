<?php
    class Connection{
        public static function Conectar(){
            define('server', 'localhost');
            define('db', 'protocolos'); 
            define('user', 'root');
            define('password', '');	
            $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');			
            try{
                $conn = new PDO("mysql:host=".server."; dbname=".db, user, password, $options);
                return $conn;
            }catch (Exception $e){
                die("El error de Conexión es: ". $e->getMessage());
            }
        }
    }
?>