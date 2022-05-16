<?php
function subir_imagen(){
    if (isset($_FILES["imagen"])){

        $extension = explode (".", $_FILES["imagen"]['name']);
        $nuevo_nombre = rand() . '.' . $extension[1];
        $ubicacion = './img/' . $nuevo_nombre;
        move_uploaded_file($_FILES["imagen"]['tmp_name'], $ubicacion);
        return $nuevo_nombre;
    }

}

function obtener_nombre_imagen($id_evidencia){
    include('conexcion.php');
    $stmt = $conexion-> prepare("SELECT imagen FROM soportes 
    WHERE id = id_evidencia'");
    $stmt->execute();
    $resultado =$stmt -> fetchAll();
    foreach($resultado as $fila){
        return $fila["imagen"];
    }
}
function obtener_registros(){
    include('conexcion.php');
    $stmt = $conexion-> prepare("SELECT * FROM soportes");
    $stmt->execute();
    $resultado =$stmt -> fetchAll();
    return $stmt->rowCount();
    
}


