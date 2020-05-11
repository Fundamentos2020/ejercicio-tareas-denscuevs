<?php

class Tarea extends connect{
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

?>