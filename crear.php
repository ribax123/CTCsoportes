<?php

include("conexcion.php");
include("funsiones.php"); 

if($_POST["operacion"] == "Crear"){
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

if($_POST["operacion"] == "Editar"){
    $imagen = '';
    if($_FILES["imagen"]["name"] != ''){
        $imagen = subir_imagen();
    }else{
        $imagen = $_POST["imagen_soporte_oculata"];
    }

    $stmt = $conexion->prepare("UPDATE soportes SET descripcion = :descripcion, 
    estado=:estado, solucion=:,solucion, imagen=:imagen WHERE id = :id");

    $resultado = $stmt->execute(
    array(
        'descripcion'   => $_POST['descripcion'],
        'estado'        => $_POST['estado'],
        'solucion'      => $_POST['solucion'],
        'imagen'        => $imagen,
        'id'            => $_POST['id_soporte'],

        )
    );

    if(!empty($resultado)){
        echo 'registro creado';
    }
} 
