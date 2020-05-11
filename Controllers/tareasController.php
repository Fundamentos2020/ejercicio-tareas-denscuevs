<?php

//$categoria_id = file_get_contents();
//echo file_get_contents('php://input');

$matchFound = (array_key_exists("categoria_id", $_GET)) && trim($_GET["categoria_id"]) != '0';
$categoria_id = $matchFound ? trim($_GET["categoria_id"]) : '0';
//$categoria_id = ($_GET["categoria_id"]);

// var_dump($_GET['categoria_id']);

class Tarea {
    public $_id;
    public $_titulo;
    public $_descripcion;
    public $_fechaLimite;
    public $_completada;
    public $_categoria_id;

    //Todos los constructores tendran el nombre por default de constructor
    public function __construct($id, $titulo, $descripcion, $fechaLimite, $completada, $categoria_id) {
        $this->_id = $id;
        $this->_titulo = $titulo;
        $this->_descripcion = $descripcion;
        $this->_fechaLimite = $fechaLimite;
        $this->_completada = $completada;
        $this->_categoria_id = $categoria_id;
    }
}

try {
    $dns = 'mysql:host=localhost;dbname=lista_tareas';
    $username = 'root';
    $password = '';
    
    $dbTareas = new PDO($dns, $username, $password);

    if($categoria_id != 0 || $categoria_id != "0"){
        $query = "SELECT * FROM tareas WHERE categoria_id = :categoria_id";
        $response = $dbTareas->prepare($query);
        $response->bindParam('categoria_id', $categoria_id, PDO::PARAM_INT);
        $response->execute();
    }
    else{
        $query = "SELECT * FROM tareas";
        $response = $dbTareas->prepare($query);
        $response->execute();
    }

    $tareas = array();

    while($row = $response->fetch(PDO::FETCH_ASSOC)) {
        $tarea = new Tarea($row['id'], $row['titulo'], $row['descripcion'], $row['fechaLimite'], $row['completada'], $row['categoria_id']);
        $tareas[] = $tarea;
    }

    $jsonResponse = json_encode($tareas);

    echo $jsonResponse;

}
catch(PDOExeption $e) {
    echo 'Error'. $e;
}

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
