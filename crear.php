<?php

include("conexcion.php");
include("funsiones.php"); 

if($_POST){
    $imagen = '';
    if($_FILES["imagen"]["name"] != ''){
        $imagen = subir_imagen();
    }
    $stmt = $conexion->prepare("INSERT INTO soportes(descripcion, estado, solucion, imagen)
    VALUES(:descripcion, :estado, :solucion, :imagen)");

    $resultado = $stmt->execute(
    array(
        'descripcion'   => $_POST['descripcion'],
        'estado'        => $_POST['estado'],
        'solucion'      => $_POST['solucion'],
        'imagen'        => $imagen
        )
    );

    if(!empty($resultado)){
        echo 'registro creado';
    }
} 
