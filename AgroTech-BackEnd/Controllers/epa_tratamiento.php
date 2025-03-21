<?php
class EpaTratamiento extends Controllers {
    public function __construct() {
        parent::__construct();
    }

    public function listar() {
        jsonResponse($this->model->getEpaTratamientos(), 200);
    }

    public function obtener($id) {
        jsonResponse($this->model->getEpaTratamiento($id), 200);
    }

    public function registrar() {
        $response = [];

        try {
            $method = $_SERVER['REQUEST_METHOD'];
            if ($method == "POST") {
                $_POST = json_decode(file_get_contents("php://input"), true);

                if (!isset($_POST['FK_Tratamiento']) || !isset($_POST['FK_EPA'])) {
                    $response = ['status' => false, 'msg' => 'Todos los campos son obligatorios'];
                    jsonResponse($response, 200);
                    die();
                }

                $request = $this->model->setEpaTratamiento($_POST['FK_Tratamiento'], $_POST['FK_EPA']);
                $response = ['status' => $request > 0, 'msg' => $request > 0 ? 'Datos registrados correctamente' : 'Error al registrar'];
            } else {
                $response = ['status' => false, 'msg' => "Error en la solicitud: $method, cambie a POST"];
            }
        } catch (Exception $e) {
            $response = ['status' => false, 'msg' => $e->getMessage()];
        }

        jsonResponse($response, 200);
    }

    public function actualizar($id) {
        $response = [];
    
        try {
            $method = $_SERVER['REQUEST_METHOD'];
            if ($method == "PUT") {
                $_PUT = json_decode(file_get_contents("php://input"), true);
    
                if (!isset($_PUT['FK_Tratamiento']) || !isset($_PUT['FK_EPA'])) {
                    $response = ['status' => false, 'msg' => 'Todos los campos son obligatorios'];
                    jsonResponse($response, 200);
                    die();
                }
    
                $request = $this->model->updateEpaTratamiento($id, $_PUT);
                $response = ['status' => $request, 'msg' => $request ? 'Datos actualizados' : 'Error al actualizar'];
            } else {
                $response = ['status' => false, 'msg' => "Error en la solicitud: $method, cambie a PUT"];
            }
        } catch (Exception $e) {
            $response = ['status' => false, 'msg' => $e->getMessage()];
        }
    
        jsonResponse($response, 200);
    }
    

    public function eliminar($id) {
        $response = [];

        try {
            $method = $_SERVER['REQUEST_METHOD'];
            if ($method == "DELETE") {
                $request = $this->model->deleteEpaTratamiento($id);
                $response = ['status' => $request > 0, 'msg' => $request > 0 ? 'EpaTratamiento eliminado correctamente' : 'Error al eliminar'];
            } else {
                $response = ['status' => false, 'msg' => "Error en la solicitud: $method, cambie a DELETE"];
            }
        } catch (Exception $e) {
            $response = ['status' => false, 'msg' => $e->getMessage()];
        }

        jsonResponse($response, 200);
    }
}
