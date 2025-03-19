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
     // Actualizar un tipo de usuario
     public function actualizar($idTipoUsuario)
     {
         try {
             if ($_SERVER['REQUEST_METHOD'] !== "PUT") {
                 jsonResponse(["status" => false, "msg" => "Método no permitido, use PUT"], 405);
                 return;
             }
 
             $_PUT = json_decode(file_get_contents("php://input"), true);
 
             if (empty($_PUT['nombre']) || !is_string($_PUT['nombre'])) {
                 jsonResponse(["status" => false, "msg" => "El nombre es obligatorio y debe ser texto"], 400);
                 return;
             }
 
             $nombre = $_PUT['nombre'];
             $descripcion = $_PUT['descripcion'] ?? '';
 
             $request = $this->model->actualizarTipoUsuario($idTipoUsuario, $nombre, $descripcion);
 
             if ($request > 0) {
                 jsonResponse(["status" => true, "msg" => "Datos actualizados correctamente"], 200);
             } else {
                 jsonResponse(["status" => false, "msg" => "Error al actualizar o no hubo cambios"], 400);
             }
         } catch (Exception $e) {
             jsonResponse(["status" => false, "msg" => "Error: " . $e->getMessage()], 500);
         }
     }
     // Eliminar un tipo de usuario
    public function eliminar($idTipoUsuario)
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== "DELETE") {
                jsonResponse(["status" => false, "msg" => "Método no permitido, use DELETE"], 405);
                return;
            }

            $request = $this->model->eliminarTipoUsuario($idTipoUsuario);

            if ($request > 0) {
                jsonResponse(["status" => true, "msg" => "Tipo de usuario eliminado"], 200);
            } else {
                jsonResponse(["status" => false, "msg" => "No se encontró el tipo de usuario"], 404);
            }
        } catch (Exception $e) {
            jsonResponse(["status" => false, "msg" => "Error: " . $e->getMessage()], 500);
        }
    }

     // Obtener datos de un tipo de usuario
     public function obtener($idTipoUsuario)
     {
         try {
             if ($_SERVER['REQUEST_METHOD'] !== "GET") {
                 jsonResponse(["status" => false, "msg" => "Método no permitido, use GET"], 405);
                 return;
             }
 
             $tipoUsuario = $this->model->obtenerTipoUsuario($idTipoUsuario);
 
             if ($tipoUsuario) {
                 jsonResponse(["status" => true, "data" => $tipoUsuario], 200);
             } else {
                 jsonResponse(["status" => false, "msg" => "Tipo de usuario no encontrado"], 404);
             }
         } catch (Exception $e) {
             jsonResponse(["status" => false, "msg" => "Error: " . $e->getMessage()], 500);
         }
     }
      // Obtener todos los tipos de usuario
public function listarTodos()
{
    try {
        if ($_SERVER['REQUEST_METHOD'] !== "GET") {
            jsonResponse(["status" => false, "msg" => "Método no permitido, use GET"], 405);
            return;
        }

        $tiposUsuario = $this->model->obtenerTodosLosTiposUsuario();

        if (!empty($tiposUsuario)) {
            jsonResponse(["status" => true, "data" => $tiposUsuario], 200);
        } else {
            jsonResponse(["status" => false, "msg" => "No hay tipos de usuario registrados"], 404);
        }
    } catch (Exception $e) {
        jsonResponse(["status" => false, "msg" => "Error: " . $e->getMessage()], 500);
    }
}

}
