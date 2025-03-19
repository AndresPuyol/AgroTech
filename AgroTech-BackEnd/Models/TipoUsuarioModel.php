<?php
class TipoUsuarioModel extends Mysql
{
    public function __construct()
    {
        parent::__construct();
    }

    // Crear un nuevo tipo de usuario
    public function crearTipoUsuario($nombre, $descripcion)
    {
        $sql = "INSERT INTO Tipo_Usuario (Nombre, Descripcion) VALUES (?, ?)";
        $arrData = array($nombre, $descripcion);
        return $this->insert($sql, $arrData);
    }