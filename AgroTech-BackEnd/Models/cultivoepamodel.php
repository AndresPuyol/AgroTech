<?php
class CultivosEpaModel extends Mysql
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insertarCultivoEPA(int $idCultivo, int $idEPA)
    {
        $query = "INSERT INTO cultivos_epa (FK_id_cultivo, FK_id_EPA) VALUES (?, ?)";
        $datos = [$idCultivo, $idEPA];
        $this->insert($query, $datos);
        return $this->lastInsert();
    }

    public function actualizarCultivoEPA(int $id, int $idCultivo, int $idEPA)
    {
        $query = "UPDATE cultivos_epa SET FK_id_cultivo = ?, FK_id_EPA = ? WHERE PK_id_Cultivos_EPA = ?";
        $datos = [$idCultivo, $idEPA, $id];
        return $this->update($query, $datos);
    }

    public function eliminarCultivoEPA(int $id)
    {
        $query = "DELETE FROM cultivos_epa WHERE PK_id_Cultivos_EPA = ?";
        return $this->delete($query, [$id]);
    }

    public function obtenerCultivoEPA(int $id)
    {
        $query = "SELECT * FROM cultivos_epa WHERE PK_id_Cultivos_EPA = ?";
        return $this->select($query, [$id]);
    }
}
?>
