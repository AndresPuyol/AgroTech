<?php
class actividades_materiales extends Controllers {
    public function __construct() {
        parent::__construct();
    }

    public function registrar() {
        $response = [];
        try {
            $method = $_SERVER['REQUEST_METHOD'];
            if ($method == "POST") {
                $_POST = json_decode(file_get_contents("php://input"), true);
                if (empty($_POST['cantidad_uso']) || !is_numeric($_POST['cantidad_uso'])) {
                    jsonResponse(['status' => false, 'msg' => 'Cantidad de uso inválida'], 200);
                    die();
                }
                $request = $this->model->setActividadesMateriales(
                 $_POST['cantidad_uso'],
                 $_POST['FK_id_actividad'], 
                 $_POST['FK_id_material']);
                jsonResponse(['status' => $request > 0, 'msg' => $request > 0 ? 'Registro exitoso' : 'Error en el registro'], 200);
            }
        } catch (Exception $e) {
            jsonResponse(['status' => false, 'msg' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function actualizar($id) {
        try {
            $method = $_SERVER['REQUEST_METHOD'];
            if ($method == "PUT") {
                $_PUT = json_decode(file_get_contents("php://input"), true);
                $request = $this->model->updateActividadesMateriales(
                    $id, 
                    $_PUT['cantidad_uso'], 
                    $_PUT['FK_id_actividad'], 
                    $_PUT['FK_id_material']
                );
                jsonResponse(['status' => $request > 0, 'msg' => $request > 0 ? 'Actualización exitosa' : 'Error en la actualización'], 200);
            }
        } catch (Exception $e) {
            jsonResponse(['status' => false, 'msg' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function eliminar($id) {
        try {
            $method = $_SERVER['REQUEST_METHOD'];
            if ($method == "DELETE") {
                $request = $this->model->deleteActividadesMateriales($id);
                jsonResponse(['status' => $request > 0, 'msg' => $request > 0 ? 'Eliminación exitosa' : 'Error al eliminar'], 200);
            }
        } catch (Exception $e) {
            jsonResponse(['status' => false, 'msg' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function obtener($id) {
        try {
            $method = $_SERVER['REQUEST_METHOD'];
            if ($method == "GET") {
                $data = $this->model->getActividadesMateriales($id);
                jsonResponse(['status' => $data ? true : false, 'data' => $data], 200);
            }
        } catch (Exception $e) {
            jsonResponse(['status' => false, 'msg' => 'Error: ' . $e->getMessage()], 500);
        }
    }
}