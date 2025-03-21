<?php
class EpaTratamientoModel extends Mysql
{
    private $intId;
    private $intIdTratamiento;
    private $intIdEPA;

    public function __construct()
    {
        parent::__construct();
    }

    public function setEpaTratamiento(int $idTratamiento, int $idEPA)
    {
        $this->intIdTratamiento = $idTratamiento;
        $this->intIdEPA = $idEPA;

        $sql = "INSERT INTO epa_tratamiento (FK_Tratamiento, FK_EPA) VALUES (:tratamiento, :epa)";
        $arrayData = array(
            ':tratamiento' => $this->intIdTratamiento,
            ':epa' => $this->intIdEPA
        );

        $request = $this->insert($sql, $arrayData);
        return $request;
    }

    public function deleteEpaTratamiento(int $id)
    {
        $this->intId = $id;
        $sql = "DELETE FROM epa_tratamiento WHERE PK_EPA_Tratamiento = :id";
        $arrayData = array(':id' => $this->intId);

        $request = $this->delete($sql, $arrayData);
        return $request;
    }

    public function updateEpaTratamiento(int $id, array $data)
{
    $this->intId = $id;
    $this->intIdTratamiento = $data['FK_Tratamiento'];
    $this->intIdEPA = $data['FK_EPA'];

    $sql = "UPDATE epa_tratamiento SET FK_Tratamiento = :tratamiento, FK_EPA = :epa WHERE PK_EPA_Tratamiento = :id";
    $arrayData = array(
        ':tratamiento' => $this->intIdTratamiento,
        ':epa' => $this->intIdEPA,
        ':id' => $this->intId
    );

    $request = $this->update($sql, $arrayData);
    return $request;
}


    public function getEpaTratamiento(int $id)
    {
        $this->intId = $id;
        $sql = "SELECT * FROM epa_tratamiento WHERE PK_EPA_Tratamiento = :id";
        $arrayData = array(':id' => $this->intId);

        $request = $this->select($sql, $arrayData);
        return $request;
    }
}
?>
