<?php
require_once "conexion.php";

$resultadoHTML = "";
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST["sql"])) {
    $sql = trim($_POST["sql"]);

    // Detectamos si es un SELECT o una acción (INSERT/UPDATE/DELETE)
    if (stripos($sql, "select") === 0) {
        $result = $conn->query($sql);

        if ($result === false) {
            $mensaje = "Error en la consulta: " . $conn->error;
        } elseif ($result->num_rows > 0) {
            $resultadoHTML .= "<table border='1' cellpadding='5' cellspacing='0'><tr>";
            $campos = $result->fetch_fields();
            foreach ($campos as $campo) {
                $resultadoHTML .= "<th>" . htmlspecialchars($campo->name) . "</th>";
            }
            $resultadoHTML .= "</tr>";

            while ($fila = $result->fetch_assoc()) {
                $resultadoHTML .= "<tr>";
                foreach ($fila as $valor) {
                    $resultadoHTML .= "<td>" . htmlspecialchars($valor) . "</td>";
                }
                $resultadoHTML .= "</tr>";
            }
            $resultadoHTML .= "</table>";
        } else {
            $mensaje = "Consulta ejecutada. 0 filas devueltas.";
        }
    } else {
        // INSERT, UPDATE, DELETE, CREATE, etc.
        if ($conn->query($sql) === TRUE) {
            $mensaje = "Sentencia ejecutada correctamente. Filas afectadas: " . $conn->affected_rows;
        } else {
            $mensaje = "Error: " . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consola SQL - bd_universidad</title>
    <style>
        body { font-family: Arial, sans-serif; background:#f4f4f4; padding:20px; }
        textarea { width: 100%; height: 120px; font-family: monospace; font-size: 14px; padding:8px; }
        button { margin-top:8px; padding:8px 20px; background:#2e7d32; color:white; border:none; cursor:pointer; }
        .resultados { background:white; padding:15px; margin-top:15px; border:1px solid #ccc; min-height:150px; }
        table { border-collapse: collapse; width:100%; }
        th { background:#eee; }
        .mensaje { color:#b00020; font-weight:bold; }
    </style>
</head>
<body>
    <h2>Area de Consultas</h2>
    <form method="POST">
        <textarea name="sql" placeholder="Escribe tu sentencia SQL aquí..."><?= isset($_POST['sql']) ? htmlspecialchars($_POST['sql']) : '' ?></textarea><br>
        <button type="submit">RUN ▶</button>
    </form>

    <h2>Area de Resultados</h2>
    <div class="resultados">
        <?php if ($mensaje): ?>
            <p class="mensaje"><?= htmlspecialchars($mensaje) ?></p>
        <?php endif; ?>
        <?= $resultadoHTML ?: "<p>Introduzca una sentencia SQL y haga clic en RUN para ver los resultados.</p>" ?>
    </div>
</body>
</html>