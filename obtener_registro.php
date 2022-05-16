<?php

include("conexcion.php");
include("funsiones.php"); 

if (isset($_POST["id_soporte"])){
    $salida = array();
    $stmt = $conexion->prepare("SELECT * FROM soportes WHERE id = '".$_POST["id_soporte"].
    "' LIMIT 1");
    $stmt->execute();
    $resultado = $stmt -> fetchAll();
    foreach($resultado as $fila){       
        $salida["descripcion"] = $fila["descripcion"];
        $salida["creacion"]= $fila["creacion"];
        $salida["solucion"]= $fila["solucion"];
        $salida["estado"]= $fila["estado"];
        if ($fila["imagen"] != ""){
            $salida["imagen"] = '<img src="img/' . $fila["imagen"] . '" 
            class="img-thumbnail" width="50" height="35"><input type="hidden" name="imagen_soporte_oculata" value="' . $fila["imagen"] 
            . '"';            
        }else{
            $salida["imagen"] = '<input type="hidden" name="imagen_soporte_oculata" value="' . $fila["imagen"] 
            . '"';            
        }
    }
    echo json_encode($salida);

}