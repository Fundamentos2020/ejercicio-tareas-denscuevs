<?php

class connect() {
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

?>