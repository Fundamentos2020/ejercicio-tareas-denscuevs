<?php

require_once("DB.php");
require_once("Categoria.php");

function get() {
    $db = new connect();
    $db.dbConnect();

    $query = "SELECT * FROM categorias";
    $response = $db->prepare($query);
    $response->execute();

    $categorias = array();

    while($row = $response->fetch(PDO::FETCH_ASSOC)) {
        $categoria = new Categoria($row['id'], $row['nombre']);
        $categorias[] = $categoria;
    }

    $jsonResponse = json_encode($categorias);
    return $jsonResponse;
}

?>
