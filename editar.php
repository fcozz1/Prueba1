<?php

include("conexion.php");

$id = $_GET["id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = $_POST["nombre"];
    $materia = $_POST["materia"];
    $fecha = $_POST["fecha_entrega"];
    $descripcion = $_POST["descripcion"];

    $sql = "UPDATE tareas
            SET nombre = ?,
                materia = ?,
                fecha_entrega = ?,
                descripcion = ?
            WHERE id = ?";

    $stmt = $conexion->prepare($sql);

    $stmt->bind_param(
        "ssssi",
        $nombre,
        $materia,
        $fecha,
        $descripcion,
        $id
    );

    $stmt->execute();

    header("Location: index.php");

    exit;
}

$sql = "SELECT * FROM tareas WHERE id = ?";

$stmt = $conexion->prepare($sql);

$stmt->bind_param("i", $id);

$stmt->execute();

$resultado = $stmt->get_result();

$tarea = $resultado->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>Editar tarea</title>

    <link rel="stylesheet" href="estilos.css">

</head>

<body>

    <div class="contenedor">

        <h1>✏️ Editar tarea</h1>

        <form method="POST">

            <label>Nombre:</label>

            <input
                type="text"
                name="nombre"
                value="<?php echo htmlspecialchars($tarea["nombre"]); ?>"
                required
            >


            <label>Materia:</label>

            <input
                type="text"
                name="materia"
                value="<?php echo htmlspecialchars($tarea["materia"]); ?>"
                required
            >


            <label>Fecha de entrega:</label>

            <input
                type="date"
                name="fecha_entrega"
                value="<?php echo $tarea["fecha_entrega"]; ?>"
                required
            >


            <label>Descripción:</label>

            <textarea name="descripcion"><?php
                echo htmlspecialchars($tarea["descripcion"]);
            ?></textarea>


            <button type="submit">
                Guardar cambios
            </button>

        </form>

        <br>

        <a href="index.php">← Regresar</a>

    </div>

</body>

</html>