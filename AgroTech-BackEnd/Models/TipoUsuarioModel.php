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
     // Actualizar un tipo de usuario existente
     public function actualizarTipoUsuario($id_tipo_usuario, $nombre, $descripcion)
     {
         $sql = "UPDATE Tipo_Usuario SET Nombre = ?, Descripcion = ? WHERE Id_Tipo_Usuario = ?";
         $arrData = array($nombre, $descripcion, $id_tipo_usuario);
         return $this->update($sql, $arrData);
     }
     // Eliminar un tipo de usuario
    public function eliminarTipoUsuario($id_tipo_usuario)
    {
        $sql = "DELETE FROM Tipo_Usuario WHERE Id_Tipo_Usuario = ?";
        $arrData = array($id_tipo_usuario);
        return $this->delete($sql, $arrData);
    }
     // Obtener datos de un tipo de usuario
     public function obtenerTipoUsuario($id_tipo_usuario)
     {
         $sql = "SELECT * FROM Tipo_Usuario WHERE Id_Tipo_Usuario = ?";
         return $this->select($sql, array($id_tipo_usuario));
     }
 }
