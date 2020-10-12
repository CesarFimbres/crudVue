<?php
include_once 'conn.php';
$obj = new Connection();
$conexion = $obj->Conectar();

$_POST = json_decode(file_get_contents("php://input"), true);
$option = (isset($_POST['option'])) ? $_POST['option'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$cliente = (isset($_POST['cliente'])) ? $_POST['cliente'] : '';
$proyecto = (isset($_POST['proyecto'])) ? $_POST['proyecto'] : '';
$busca = (isset($_POST['busca'])) ? $_POST['busca'] : '';

switch ($option) {
    case 1:
        $consulta = "INSERT INTO tablero (nombre, cliente, proyecto) VALUES('$nombre', '$cliente', '$proyecto') ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        break;
    case 2:
        $consulta = "UPDATE tablero SET nombre='$nombre', cliente='$cliente', proyecto='$proyecto' WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3:
        $consulta = "DELETE FROM tablero WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        break;
    case 4:
        $consulta = "SELECT id, nombre, cliente, proyecto FROM tablero ORDER BY id DESC LIMIT 7";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 5:
        $consulta = " SELECT * FROM tablero WHERE nombre LIKE '%$busca%' OR cliente LIKE '%$busca%' OR proyecto LIKE '%$busca%' ORDER BY id DESC ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE);
$conexion = NULL;
