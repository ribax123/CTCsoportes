<?php

include("conexcion.php");
include("funsiones.php"); 





if(isset($_POST["id_soporte"])){
    $imagen = obtener_nombre_imagen($_POST["id_soporte"]);


    if($imagen != ""){
        unlink("img/". $imagen);
    }

    $stmt = $conexion->prepare(
        
        "DELETE FROM soportes WHERE id = :id"
    );

    $resultado = $stmt->execute(
    array(
        ':id'    => $_POST["id_soporte"]
    )
        
    );

    if(!empty($resultado)){
        echo 'Registro Borrado';
    }
}  