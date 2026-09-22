<?php

include("conexion.php");

$id = $_GET["id"];

$sql = "UPDATE tareas
        SET estado = 'Terminada'
        WHERE id = ?";

$stmt = $conexion->prepare($sql);

$stmt->bind_param("i", $id);

$stmt->execute();

header("Location: index.php");

?>