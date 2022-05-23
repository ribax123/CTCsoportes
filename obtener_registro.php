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
            class="img-thumbnail" width="100" height="50" /><input type="hidden" 
            name="imagen_usuario_oculta" value="'.$fila["imagen"].'" />';            
        }else{
            $salida["imagen"] = '<input type="hidden" name="imagen_usuario_oculta" 
            value=""/>';
        }
    }
    echo json_encode($salida);

}