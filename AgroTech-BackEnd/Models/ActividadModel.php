<?php

class ActividadModel extends Mysql
{
    public function __construct()
    {
        parent::__construct();
    }

    // Obtener todas las actividades
    public function obtenerActividades()
    {
        $sql = "SELECT * FROM actividades";
        $data = $this->select_all($sql);
        return $data;
    }

    // Obtener actividad por ID
    public function obtenerActividad($id)
    {
        $sql = "SELECT * FROM actividades WHERE Id_Actividad = ?";
        $data = $this->select($sql, [$id]);
        return $data;
    }

    // Crear nueva actividad
    public function crearActividad($nombre, $descripcion, $fecha, $estado, $tipo, $idCultivo, $idUsuario)
    {
        $sql = "INSERT INTO actividades (Nombre, Descripcion, Fecha, Estado, Tipo, Id_Cultivo, Id_Usuario)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $datos = [$nombre, $descripcion, $fecha, $estado, $tipo, $idCultivo, $idUsuario];
        $request_insert = $this->insert($sql, $datos);
        return $request_insert;
    }

    // Actualizar actividad
    public function actualizarActividad($id, $nombre, $descripcion, $fecha, $estado, $tipo, $idCultivo, $idUsuario)
    {
        $sql = "UPDATE actividades SET Nombre = ?, Descripcion = ?, Fecha = ?, Estado = ?, Tipo = ?, Id_Cultivo = ?, Id_Usuario = ?
                WHERE Id_Actividad = ?";
        $datos = [$nombre, $descripcion, $fecha, $estado, $tipo, $idCultivo, $idUsuario, $id];
        $request_update = $this->update($sql, $datos);
        return $request_update;
    }

    // Eliminar actividad
    public function eliminarActividad($id)
    {
        $sql = "DELETE FROM actividades WHERE Id_Actividad = ?";
        $arrData = [$id];
        $request_delete = $this->delete($sql, $arrData);
        return $request_delete;
    }
}
