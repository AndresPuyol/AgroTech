<?php
class TipoUsuario extends Controllers
{
    public function __construct()
    {
        parent::__construct();
    }

    // Registrar un tipo de usuario
    public function registrar()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== "POST") {
                jsonResponse(["status" => false, "msg" => "Método no permitido, use POST"], 405);
                return;
            }

            $_POST = json_decode(file_get_contents("php://input"), true);

            if (empty($_POST['nombre']) || !is_string($_POST['nombre'])) {
                jsonResponse(['status' => false, 'msg' => 'El nombre es obligatorio y debe ser texto'], 400);
                return;
            }

            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'] ?? '';

            $request = $this->model->crearTipoUsuario($nombre, $descripcion);

            if ($request > 0) {
                jsonResponse(["status" => true, "msg" => "Tipo de usuario registrado correctamente"], 200);
            } else {
                jsonResponse(["status" => false, "msg" => "Error al registrar el tipo de usuario"], 400);
            }
        } catch (Exception $e) {
            jsonResponse(["status" => false, "msg" => "Error: " . $e->getMessage()], 500);
        }
    }