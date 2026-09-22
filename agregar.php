<?php

include("conexion.php");

$nombre = $_POST["nombre"];
$materia = $_POST["materia"];
$fecha = $_POST["fecha_entrega"];
$descripcion = $_POST["descripcion"];

$sql = "INSERT INTO tareas
        (nombre, materia, fecha_entrega, descripcion)
        VALUES (?, ?, ?, ?)";

$stmt = $conexion->prepare($sql);

$stmt->bind_param(
    "ssss",
    $nombre,
    $materia,
    $fecha,
    $descripcion
);

$stmt->execute();

header("Location: index.php");

?>