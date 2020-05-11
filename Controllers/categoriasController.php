<?php

 //require_once("Models/DB.php");
// require_once("Categoria.php");

class connect {
    public function dbConnect() {
        try {
            $dns = 'mysql:host=localhost;dbname=lista_tareas';
            $username = 'root';
            $password = '';
            
            $dbTareas = new PDO($dns, $username, $password);
        
            return $dbTareas;
        }
        catch(PDOExeption $e) {
            echo 'Error'. $e;
        }
        
    }
}

class Categoria{
    public $_id;
    public $_nombre;

    //Todos los constructores tendran el nombre por default de constructor
    public function __construct($id, $nombre) {
        $this->_id = $id;
        $this->_nombre = $nombre;
    }
}

try {
    $dns = 'mysql:host=localhost;dbname=lista_tareas';
    $username = 'root';
    $password = '';
    
    $dbTareas = new PDO($dns, $username, $password);

    $query = "SELECT * FROM categorias";
    $response = $dbTareas->prepare($query);
    $response->execute();

    $categorias = array();

    while($row = $response->fetch(PDO::FETCH_ASSOC)) {
        $categoria = new Categoria($row['id'], $row['nombre']);
        $categorias[] = $categoria;
    }

    $jsonResponse = json_encode($categorias);

    echo $jsonResponse;

}
catch(PDOExeption $e) {
    echo 'Error'. $e;
}

?>
