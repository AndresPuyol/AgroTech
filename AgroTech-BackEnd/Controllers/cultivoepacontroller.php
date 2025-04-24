<?php
class CultivosEpa extends Controllers
{
    public function __construct()
    {
        parent::__construct();
    }

    public function registrar()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                return jsonResponse(['status' => false, 'msg' => 'Debe usar POST'], 400);
            }

            $_POST = json_decode(file_get_contents("php://input"), true);

            if (!isset($_POST['FK_id_cultivo']) || !testEntero($_POST['FK_id_cultivo'])) {
                return jsonResponse(['status' => false, 'msg' => 'El id de cultivo es obligatorio y debe ser un número entero'], 200);
            }

            if (!isset($_POST['FK_id_EPA']) || !testEntero($_POST['FK_id_EPA'])) {
                return jsonResponse(['status' => false, 'msg' => 'El id de EPA es obligatorio y debe ser un número entero'], 200);
            }

            $cultivo = $_POST['FK_id_cultivo'];
            $epa = $_POST['FK_id_EPA'];

            $insert = $this->model->insertarCultivoEPA($cultivo, $epa);

            if ($insert > 0) {
                return jsonResponse(['status' => true, 'msg' => 'Registro creado correctamente', 'id' => $insert], 200);
            }

            return jsonResponse(['status' => false, 'msg' => 'Error al crear el registro'], 200);

        } catch (Exception $e) {
            return jsonResponse(['status' => false, 'msg' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function actualizar($id)
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
                return jsonResponse(['status' => false, 'msg' => 'Debe usar PUT'], 400);
            }

            $_PUT = json_decode(file_get_contents("php://input"), true);

            if (!isset($_PUT['FK_id_cultivo']) || !testEntero($_PUT['FK_id_cultivo'])) {
                return jsonResponse(['status' => false, 'msg' => 'El id de cultivo es obligatorio y debe ser un número entero'], 200);
            }

            if (!isset($_PUT['FK_id_EPA']) || !testEntero($_PUT['FK_id_EPA'])) {
                return jsonResponse(['status' => false, 'msg' => 'El id de EPA es obligatorio y debe ser un número entero'], 200);
            }

            $cultivo = $_PUT['FK_id_cultivo'];
            $epa = $_PUT['FK_id_EPA'];

            $update = $this->model->actualizarCultivoEPA($id, $cultivo, $epa);

            if ($update > 0) {
                return jsonResponse(['status' => true, 'msg' => 'Registro actualizado correctamente'], 200);
            }

            return jsonResponse(['status' => false, 'msg' => 'Error al actualizar el registro'], 200);

        } catch (Exception $e) {
            return jsonResponse(['status' => false, 'msg' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function eliminar($id)
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
                return jsonResponse(['status' => false, 'msg' => 'Debe usar DELETE'], 400);
            }

            $delete = $this->model->eliminarCultivoEPA($id);

            if ($delete > 0) {
                return jsonResponse(['status' => true, 'msg' => 'Registro eliminado'], 200);
            }

            return jsonResponse(['status' => false, 'msg' => 'Error al eliminar el registro'], 200);

        } catch (Exception $e) {
            return jsonResponse(['status' => false, 'msg' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function obtener($id)
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
                return jsonResponse(['status' => false, 'msg' => 'Debe usar GET'], 400);
            }

            $data = $this->model->obtenerCultivoEPA($id);

            if ($data) {
                return jsonResponse(['status' => true, 'data' => $data], 200);
            }

            return jsonResponse(['status' => false, 'msg' => 'No se encontró el registro'], 200);

        } catch (Exception $e) {
            return jsonResponse(['status' => false, 'msg' => 'Error: ' . $e->getMessage()], 500);
        }
    }
}
?>