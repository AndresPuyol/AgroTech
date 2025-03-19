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
    public function actualizarUsuario($Id_Usuario, $Nombre, $Apellidos, $Telefono, $Correo, $Id_Tipo_Usuario)
    {
        $sql = "UPDATE Usuarios SET Nombre = ?, Apellidos = ?, Telefono = ?, Correo = ?, Id_Tipo_Usuario = ? WHERE Id_Usuario = ?";
        $arrData = array($Nombre, $Apellidos, $Telefono, $Correo, $Id_Tipo_Usuario, $Id_Usuario);
        return $this->update($sql, $arrData);
    }