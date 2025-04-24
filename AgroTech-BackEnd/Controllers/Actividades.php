<?php
class Actividades extends Controllers
{
    public function __construct()
    {
        parent::__construct();
    }

    // Obtener todas las actividades
    public function obtenerActividades()
    {
        $response = [];
        try {
            if ($_SERVER['REQUEST_METHOD'] == "GET") {
                $actividades = $this->model->obtenerActividades();
                $response = $actividades
                    ? ["status" => true, "data" => $actividades]
                    : ["status" => false, "msg" => "No se encontraron actividades"];
            } else {
                $response = ["status" => false, "msg" => "Método no permitido. Usa GET"];
            }
        } catch (\Exception $e) {
            $response = ["status" => false, "msg" => "Error en el proceso: " . $e->getMessage()];
        }
        jsonResponse($response, 200);
    }

    // Obtener una actividad por ID
    public function obtener($idActividad)
    {
        $response = [];
        try {
            if ($_SERVER['REQUEST_METHOD'] == "GET") {
                $actividad = $this->model->obtenerActividad($idActividad);
                $response = $actividad
                    ? ["status" => true, "data" => $actividad]
                    : ["status" => false, "msg" => "Actividad no encontrada"];
            } else {
                $response = ["status" => false, "msg" => "Método no permitido. Usa GET"];
            }
        } catch (\Exception $e) {
            $response = ["status" => false, "msg" => "Error en el proceso: " . $e->getMessage()];
        }
        jsonResponse($response, 200);
    }

    // Registrar actividad
    public function registrar()
    {
        $response = [];
        try {
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $_POST = json_decode(file_get_contents("php://input"), true);

                if (!testString($_POST['Nombre'])) {
                    jsonResponse(['status' => false, 'msg' => 'El nombre debe ser texto'], 200);
                    die();
                }

                $Nombre = ucwords(strtolower($_POST['Nombre']));
                $Descripcion = $_POST['Descripcion'] ?? '';
                $Fecha = $_POST['Fecha'];
                $Estado = $_POST['Estado'];
                $Tipo = $_POST['Tipo'];
                $Id_Cultivo = $_POST['Id_Cultivo'];
                $Id_Usuario = $_POST['Id_Usuario'];

                $request = $this->model->crearActividad($Nombre, $Descripcion, $Fecha, $Estado, $Tipo, $Id_Cultivo, $Id_Usuario);

                if ($request > 0) {
                    $response = [
                        "status" => true,
                        "msg" => "Actividad registrada correctamente",
                        "data" => [
                            'Id_Actividad' => $request,
                            'Nombre' => $Nombre,
                            'Descripcion' => $Descripcion,
                            'Fecha' => $Fecha,
                            'Estado' => $Estado,
                            'Tipo' => $Tipo,
                            'Id_Cultivo' => $Id_Cultivo,
                            'Id_Usuario' => $Id_Usuario
                        ]
                    ];
                } else {
                    $response = ["status" => false, "msg" => "Error al registrar la actividad"];
                }
            } else {
                $response = ["status" => false, "msg" => "Método no permitido. Usa POST"];
            }
        } catch (\Exception $e) {
            $response = ["status" => false, "msg" => "Error en el proceso: " . $e->getMessage()];
        }
        jsonResponse($response, 200);
    }

    // Actualizar actividad
    public function actualizar($idActividad)
    {
        $response = [];
        try {
            if ($_SERVER['REQUEST_METHOD'] == "PUT") {
                $_PUT = json_decode(file_get_contents("php://input"), true);

                $Nombre = ucwords(strtolower($_PUT['Nombre']));
                $Descripcion = $_PUT['Descripcion'];
                $Fecha = $_PUT['Fecha'];
                $Estado = $_PUT['Estado'];
                $Tipo = $_PUT['Tipo'];
                $Id_Cultivo = $_PUT['Id_Cultivo'];
                $Id_Usuario = $_PUT['Id_Usuario'];

                $request = $this->model->actualizarActividad($idActividad, $Nombre, $Descripcion, $Fecha, $Estado, $Tipo, $Id_Cultivo, $Id_Usuario);

                $response = $request > 0
                    ? ["status" => true, "msg" => "Actividad actualizada correctamente"]
                    : ["status" => false, "msg" => "Error al actualizar la actividad"];
            } else {
                $response = ["status" => false, "msg" => "Método no permitido. Usa PUT"];
            }
        } catch (\Exception $e) {
            $response = ["status" => false, "msg" => "Error en el proceso: " . $e->getMessage()];
        }
        jsonResponse($response, 200);
    }

    // Eliminar actividad
    public function eliminar($idActividad)
    {
        $response = [];
        try {
            if ($_SERVER['REQUEST_METHOD'] == "DELETE") {
                $request = $this->model->eliminarActividad($idActividad);
                $response = $request > 0
                    ? ["status" => true, "msg" => "Actividad eliminada correctamente"]
                    : ["status" => false, "msg" => "Error al eliminar la actividad"];
            } else {
                $response = ["status" => false, "msg" => "Método no permitido. Usa DELETE"];
            }
        } catch (\Exception $e) {
            $response = ["status" => false, "msg" => "Error en el proceso: " . $e->getMessage()];
        }
        jsonResponse($response, 200);
    }
}
