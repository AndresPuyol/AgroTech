<?php
class Usuarios extends Controllers
{
    public function __construct()
    {
        parent::__construct();
    }

    public function registrar()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== "POST") {
                jsonResponse(["status" => false, "msg" => "Método no permitido, use POST"], 405);
                return;
            }

            $_POST = json_decode(file_get_contents("php://input"), true);

            if (!isset($_POST['Id_Identificacion'], $_POST['Nombre'], $_POST['Apellidos'], $_POST['Telefono'], $_POST['Correo'], $_POST['Password_Hash'], $_POST['Id_Tipo_Usuario'])) {
                jsonResponse(["status" => false, "msg" => "Faltan datos obligatorios"], 400);
                return;
            }

            $Id_Identificacion = $_POST['Id_Identificacion'];
            $Nombre = $_POST['Nombre'];
            $Apellidos = $_POST['Apellidos'];
            $Telefono = $_POST['Telefono'];
            $Correo = $_POST['Correo'];
            $Password_Hash = password_hash($_POST['Password_Hash'], PASSWORD_DEFAULT);
            $Id_Tipo_Usuario = $_POST['Id_Tipo_Usuario'];

            // Verificar que el tipo de usuario exista
            $tipoUsuarioExiste = $this->model->verificarTipoUsuario($Id_Tipo_Usuario);

            if (!$tipoUsuarioExiste) {
                jsonResponse(["status" => false, "msg" => "El tipo de usuario no existe"], 400);
                return;
            }

            $request = $this->model->crearUsuario($Id_Identificacion, $Nombre, $Apellidos, $Telefono, $Correo, $Password_Hash, $Id_Tipo_Usuario);

            if ($request > 0) {
                jsonResponse(["status" => true, "msg" => "Usuario registrado correctamente"], 200);
            } else {
                jsonResponse(["status" => false, "msg" => "Error al registrar el usuario"], 400);
            }
        } catch (Exception $e) {
            jsonResponse(["status" => false, "msg" => "Error: " . $e->getMessage()], 500);
        }
    }
    public function obtener($Id_Usuario)
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== "GET") {
                jsonResponse(["status" => false, "msg" => "Método no permitido, use GET"], 405);
                return;
            }

            $usuario = $this->model->obtenerUsuario($Id_Usuario);

            if ($usuario) {
                jsonResponse(["status" => true, "data" => $usuario], 200);
            } else {
                jsonResponse(["status" => false, "msg" => "Usuario no encontrado"], 404);
            }
        } catch (Exception $e) {
            jsonResponse(["status" => false, "msg" => "Error: " . $e->getMessage()], 500);
        }
    }