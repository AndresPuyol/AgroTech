<?php

class InformacionSensor extends Controllers
{
    public function __construct()
    {
        parent::__construct();
    }

    // Obtener todas las informaciones de sensores
    public function getInformaciones()
    {
        $data = $this->model->getAllInformacionesSensor();
        if (!empty($data)) {
            http_response_code(200);
            echo json_encode(["status" => true, "data" => $data]);
        } else {
            http_response_code(404);
            echo json_encode(["status" => false, "message" => "No hay registros de sensores"]);
        }
    }

    // Obtener una sola información por ID
    public function getInformacion(int $id)
    {
        $data = $this->model->getInformacionSensor($id);
        if (!empty($data)) {
            http_response_code(200);
            echo json_encode(["status" => true, "data" => $data]);
        } else {
            http_response_code(404);
            echo json_encode(["status" => false, "message" => "Registro no encontrado"]);
        }
    }

    // Insertar una nueva información del sensor
    public function postInformacion()
    {
        $json = file_get_contents('php://input');
        $datos = json_decode($json, true);

        if (
            empty($datos['Fecha_Registro']) || 
            !isset($datos['Valor_Maximo']) || 
            !isset($datos['Valor_Minimo']) || 
            !isset($datos['FK_id_sensor'])
        ) {
            http_response_code(400);
            echo json_encode(["status" => false, "message" => "Datos incompletos"]);
            return;
        }

        $insert = $this->model->setInformacionSensor(
            $datos['Fecha_Registro'],
            intval($datos['Valor_Maximo']),
            intval($datos['Valor_Minimo']),
            intval($datos['FK_id_sensor'])
        );

        if ($insert > 0) {
            http_response_code(201);
            echo json_encode(["status" => true, "message" => "Información registrada correctamente", "id" => $insert]);
        } else {
            http_response_code(500);
            echo json_encode(["status" => false, "message" => "Error al registrar la información"]);
        }
    }

    // Actualizar información del sensor
    public function putInformacion($id)
    {
        $json = file_get_contents('php://input');
        $datos = json_decode($json, true);

        if (
            empty($datos['Fecha_Registro']) || 
            !isset($datos['Valor_Maximo']) || 
            !isset($datos['Valor_Minimo']) || 
            !isset($datos['FK_id_sensor'])
        ) {
            http_response_code(400);
            echo json_encode(["status" => false, "message" => "Datos incompletos"]);
            return;
        }

        $update = $this->model->updateInformacionSensor(
            intval($id),
            $datos['Fecha_Registro'],
            intval($datos['Valor_Maximo']),
            intval($datos['Valor_Minimo']),
            intval($datos['FK_id_sensor'])
        );

        if ($update) {
            http_response_code(200);
            echo json_encode(["status" => true, "message" => "Información actualizada correctamente"]);
        } else {
            http_response_code(500);
            echo json_encode(["status" => false, "message" => "Error al actualizar la información"]);
        }
    }

    // Eliminar una información del sensor
    public function deleteInformacion($id)
    {
        $delete = $this->model->deleteInformacionSensor(intval($id));

        if ($delete) {
            http_response_code(200);
            echo json_encode(["status" => true, "message" => "Información eliminada correctamente"]);
        } else {
            http_response_code(404);
            echo json_encode(["status" => false, "message" => "No se pudo eliminar, ID no encontrado"]);
        }
    }
}
?>
