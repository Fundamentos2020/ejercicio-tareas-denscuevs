<?php
require_once("DB.php");
require_once("Tarea.php");

function getByCategoriaId($categoria_id) {
    $db = new connect();
    $db.dbConnect();

    $query = "SELECT * FROM tareas WHERE categoria_id = :categoria_id";
    $response = $db->prepare($query);
    $response->bindParam('categoria_id', $categoria_id, PDO::PARAM_STR);
    $response->execute();

    $tareas = array();

    while($row = $response->fetch(PDO::FETCH_ASSOC)) {
        $tarea = new Tarea($row['id'], $row['titulo'], $row['descripcion'], $row['fechaLimite'], $row['completada'], $row['categoria_id']);
        $tareas[] = $tarea;
    }

    $jsonResponse = json_encode($tareas);
    return $jsonResponse;
}


?>
