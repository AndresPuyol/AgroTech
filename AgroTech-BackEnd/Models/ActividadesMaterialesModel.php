<?php
class ActividadesMaterialesModel extends Mysql
{
    private $intId;
    private $intCantidadUso;
    private $intIdActividad;
    private $intIdMaterial;

    public function __construct()
    {
        parent::__construct();
    }

    public function setActividadesMateriales(int $cantidadUso, int $idActividad, int $idMaterial)
    {
        $this->intCantidadUso = $cantidadUso;
        $this->intIdActividad = $idActividad;
        $this->intIdMaterial = $idMaterial;

        // Verificar que FK_id_actividad y FK_id_material existen antes de insertar
        $sqlCheck = "SELECT COUNT(*) AS total FROM actividad WHERE PK_id_actividad = :actividad";
        $checkActividad = $this->select($sqlCheck, [':actividad' => $this->intIdActividad]);

        $sqlCheckMaterial = "SELECT COUNT(*) AS total FROM material WHERE PK_id_material = :material";
        $checkMaterial = $this->select($sqlCheckMaterial, [':material' => $this->intIdMaterial]);

        if ($checkActividad['total'] == 0 || $checkMaterial['total'] == 0) {
            return false; // No existe la actividad o el material
        }

        $sql = "INSERT INTO actividades_materiales (cantidad_uso, FK_id_actividad, FK_id_material) 
                VALUES (:cantidad, :actividad, :material)";
        $arrayData = [
            ':cantidad' => $this->intCantidadUso,
            ':actividad' => $this->intIdActividad,
            ':material' => $this->intIdMaterial
        ];

        return $this->insert($sql, $arrayData);
    }

    public function updateActividadesMateriales(int $id, int $cantidadUso, int $idActividad, int $idMaterial)
    {
        $this->intId = $id;
        $this->intCantidadUso = $cantidadUso;
        $this->intIdActividad = $idActividad;
        $this->intIdMaterial = $idMaterial;

        $sql = "UPDATE actividades_materiales 
                SET cantidad_uso = :cantidad, FK_id_actividad = :actividad, FK_id_material = :material 
                WHERE PK_Actividades_Materiales = :id";
        $arrayData = [
            ':cantidad' => $this->intCantidadUso,
            ':actividad' => $this->intIdActividad,
            ':material' => $this->intIdMaterial,
            ':id' => $this->intId
        ];

        return $this->update($sql, $arrayData);
    }

    public function deleteActividadesMateriales(int $id)
    {
        $this->intId = $id;
        $sql = "DELETE FROM actividades_materiales WHERE PK_Actividades_Materiales = :id";
        return $this->delete($sql, [':id' => $this->intId]);
    }

    public function getActividadesMateriales(int $id)
    {
        $this->intId = $id;
        $sql = "SELECT * FROM actividades_materiales WHERE PK_Actividades_Materiales = :id";
        return $this->select($sql, [':id' => $this->intId]);
    }
}
?>
