<?php

class Categoria{
    public $_id;
    public $_nombre;

    //Todos los constructores tendran el nombre por default de constructor
    public function __construct($id, $nombre) {
        $this->_id = $id;
        $this->_nombre = $nombre;
    }
}

?>