<?php
class UsuariosModel extends Mysql
{
    public function __construct()
    {
        parent::__construct();
    }

    public function crearUsuario($Id_Identificacion, $Nombre, $Apellidos, $Telefono, $Correo, $Password_Hash, $Id_Tipo_Usuario)
    {
        $sql = "INSERT INTO Usuarios (Id_Identificacion, Nombre, Apellidos, Telefono, Correo, Password_Hash, Id_Tipo_Usuario) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $arrData = array($Id_Identificacion, $Nombre, $Apellidos, $Telefono, $Correo, $Password_Hash, $Id_Tipo_Usuario);
        return $this->insert($sql, $arrData);
    }
    public function obtenerUsuario($Id_Usuario)
    {
        $sql = "SELECT * FROM Usuarios WHERE Id_Usuario = ?";
        $arrData = array($Id_Usuario);
        return $this->select($sql, $arrData);
    }