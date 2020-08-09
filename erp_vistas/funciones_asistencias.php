<?php
require "../config/config.php";
require_once ROOT_PATH . "/libs/database.php";

if($_POST){
    switch($_POST['accion']){
        case 'registro-asistencia':
            registroAsistencia();
        break;
        case 'registro-salida':
            registroSalida();
        break;
    }
}

function registroAsistencia(){
    extract($_POST);
    global $db;
    $res = $db->get("empleados_rh", "*", [
        "number" => $number
    ]);
    if($res){
        $db->insert("asistencia", [
            "codigo_persona" => $number,
            "fecha_hora" => $fecha_hora,
            "tipo" => "entrada",
            "fecha" => $fecha,
            "empleado_id" => $res['id'],
            "departamento_id" => $res['department']
        ]);
        $resultado['status'] = 1;
    } else {
        $resultado['status'] = 0;
    }
    echo json_encode($resultado);
}

function registroSalida(){
    extract($_POST);
    global $db;
    $res = $db->get("empleados_rh", "*", [
        "number" => $number
    ]);
    if($res){
        $db->insert("asistencia", [
            "codigo_persona" => $number,
            "fecha_hora" => $fecha_hora,
            "tipo" => "salida",
            "fecha" => $fecha,
            "empleado_id" => $res['id'],
            "departamento_id" => $res['department']
        ]);
        $resultado['status'] = 1;
    } else {
        $resultado['status'] = 0;
    }
    echo json_encode($resultado);
}
?>