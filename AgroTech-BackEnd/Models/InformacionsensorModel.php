<?php

class InformacionSensorModel extends Mysql
{
    private $intIdInformacionSensor;
    private $strFechaRegistro;
    private $intValorMaximo;
    private $intValorMinimo;
    private $intIdSensor;

    public function __construct()
    {
        parent::__construct();
    }

    public function setInformacionSensor(string $fecha, int $valorMax, int $valorMin, int $idSensor)
    {
        $this->strFechaRegistro = $fecha;
        $this->intValorMaximo = $valorMax;
        $this->intValorMinimo = $valorMin;
        $this->intIdSensor = $idSensor;

        $sql = "INSERT INTO informacion_sensor (Fecha_Registro, Valor_Maximo, Valor_Minimo, FK_id_sensor)
                VALUES (:fecha, :max, :min, :sensor)";
        $arrayData = array(
            ':fecha' => $this->strFechaRegistro,
            ':max' => $this->intValorMaximo,
            ':min' => $this->intValorMinimo,
            ':sensor' => $this->intIdSensor
        );

        $request_insert = $this->insert($sql, $arrayData);
        return $request_insert;
    }

    public function updateInformacionSensor(int $id, string $fecha, int $valorMax, int $valorMin, int $idSensor)
    {
        $this->intIdInformacionSensor = $id;
        $this->strFechaRegistro = $fecha;
        $this->intValorMaximo = $valorMax;
        $this->intValorMinimo = $valorMin;
        $this->intIdSensor = $idSensor;

        $sql = "UPDATE informacion_sensor 
                SET Fecha_Registro = :fecha, Valor_Maximo = :max, Valor_Minimo = :min, FK_id_sensor = :sensor
                WHERE PK_Informacion_Sensor = :id";
        $arrayData = array(
            ':id' => $this->intIdInformacionSensor,
            ':fecha' => $this->strFechaRegistro,
            ':max' => $this->intValorMaximo,
            ':min' => $this->intValorMinimo,
            ':sensor' => $this->intIdSensor
        );

        $request_update = $this->update($sql, $arrayData);
        return $request_update;
    }

    public function deleteInformacionSensor(int $id)
    {
        $this->intIdInformacionSensor = $id;

        $sql = "DELETE FROM informacion_sensor WHERE PK_Informacion_Sensor = :id";
        $arrayData = array(':id' => $this->intIdInformacionSensor);

        $request_delete = $this->delete($sql, $arrayData);
        return $request_delete;
    }

    public function getInformacionSensor(int $id)
    {
        $this->intIdInformacionSensor = $id;

        $sql = "SELECT * FROM informacion_sensor WHERE PK_Informacion_Sensor = :id";
        $arrayData = array(':id' => $this->intIdInformacionSensor);

        $request = $this->select($sql, $arrayData);
        return $request;
    }

    public function getAllInformacionSensor()
    {
        $sql = "SELECT * FROM informacion_sensor";
        $request = $this->select_all($sql);
        return $request;
    }
}
?>
