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
    public function eliminarUsuario($Id_Usuario)
    {
        $sql = "DELETE FROM Usuarios WHERE Id_Usuario = ?";
        $arrData = array($Id_Usuario);
        return $this->delete($sql, $arrData);
    }
    //Este método verifica si un tipo de usuario existe en la base de datos
    public function verificarTipoUsuario($Id_Tipo_Usuario)
    {
        $sql = "SELECT Id_Tipo_Usuario FROM Tipos_Usuarios WHERE Id_Tipo_Usuario = ?";
        $arrData = array($Id_Tipo_Usuario);
        return $this->select($sql, $arrData);
    }
//buscar usuario por correo
    public function obtenerPorCorreo($Correo)
    {
        $sql = "SELECT * FROM Usuarios WHERE Correo = ?";
        $arrData = array($Correo);
        return $this->select($sql, $arrData);
    }
//verifica las credenciales busca usuario por correo y luego verifica
    public function verificarCredenciales($Correo, $Password)
    {
        $usuario = $this->obtenerPorCorreo($Correo);
        if ($usuario && password_verify($Password, $usuario['Password_Hash'])) {
            return $usuario;
        }
        return null;
    }

    public function obtenerTodosUsuarios()
    {
        $sql = "SELECT * FROM Usuarios";
        return $this->select_all($sql);
    }
}