<?php
include("conexion.php");

$resultado = $conexion->query("SELECT * FROM tareas ORDER BY fecha_entrega ASC");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Tareas</title>

    <link rel="stylesheet" href="estilos.css">
</head>

<body>

    <div class="contenedor">

        <h1>📚 Mis Tareas</h1>

        <h2>Agregar nueva tarea</h2>

        <form action="agregar.php" method="POST">

            <label>Nombre de la tarea:</label>
            <input type="text" name="nombre" required>

            <label>Materia:</label>
            <input type="text" name="materia" required>

            <label>Fecha de entrega:</label>
            <input type="date" name="fecha_entrega" required>

            <label>Descripción:</label>
            <textarea name="descripcion"></textarea>

            <button type="submit">Agregar tarea</button>

        </form>


        <h2>📋 Mis tareas</h2>

        <div class="tareas">

            <?php

            if ($resultado->num_rows > 0) {

                while ($tarea = $resultado->fetch_assoc()) {

            ?>

                    <div class="tarea">

                        <h3>
                            <?php echo htmlspecialchars($tarea["nombre"]); ?>
                        </h3>

                        <p>
                            <strong>Materia:</strong>
                            <?php echo htmlspecialchars($tarea["materia"]); ?>
                        </p>

                        <p>
                            <strong>Fecha de entrega:</strong>
                            <?php echo $tarea["fecha_entrega"]; ?>
                        </p>

                        <p>
                            <strong>Descripción:</strong>
                            <?php echo htmlspecialchars($tarea["descripcion"]); ?>
                        </p>

                        <p>
                            <strong>Estado:</strong>

                            <?php

                            if ($tarea["estado"] == "Terminada") {
                                echo "<span class='terminada'>Terminada</span>";
                            } else {
                                echo "<span class='pendiente'>Pendiente</span>";
                            }

                            ?>

                        </p>

                        <div class="botones">

                            <a href="editar.php?id=<?php echo $tarea["id"]; ?>">
                                Editar
                            </a>

                            <a href="eliminar.php?id=<?php echo $tarea["id"]; ?>"
                               onclick="return confirm('¿Seguro que quieres eliminar esta tarea?');">
                                Eliminar
                            </a>

                            <?php if ($tarea["estado"] == "Pendiente") { ?>

                                <a href="completar.php?id=<?php echo $tarea["id"]; ?>">
                                    ✓ Terminar
                                </a>

                            <?php } ?>

                        </div>

                    </div>

            <?php

                }

            } else {

                echo "<p>No hay tareas registradas.</p>";

            }

            ?>

        </div>

    </div>

</body>

</html>