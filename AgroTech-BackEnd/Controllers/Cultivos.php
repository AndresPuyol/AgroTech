<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
class Cultivos extends Controllers
{
    public function __construct()
    {
        parent::__construct();
    }

    public function cultivo($idCultivo)
    {
        echo "Hola desde cultivo con el id=" . $idCultivo;
    }

    public function registrar()
    {
        $response = [];

        try {
            $method = $_SERVER['REQUEST_METHOD'];
            if ($method == "POST") {
                $_POST = json_decode(file_get_contents("php://input"), true);

                if (!testString($_POST['Nombre'])) {
                    $response = array('status' => false, 'msg' => 'El nombre debe ser un texto');
                    jsonResponse($response, 200);
                    die();
                }
                if (!testEntero($_POST['Cantidad'])) {
                    $response = array('status' => false, 'msg' => 'La cantidad debe ser un número entero');
                    jsonResponse($response, 200);
                    die();
                }

                $Nombre = ucwords(strtolower($_POST['Nombre']));
                $Cantidad = $_POST['Cantidad'];
                $Img = $_POST['Img'];
                $Descripcion = $_POST['Descripcion'];
                $Id_Tipo_Cultivo = $_POST['Id_Tipo_Cultivo'];

                $request = $this->model->crearCultivo($Nombre, $Cantidad, $Img, $Descripcion, $Id_Tipo_Cultivo);

                if ($request > 0) {
                    $arraCultivo = array(
                        'Id_Cultivo' => $request, // El ID generado por autoincremental
                        'Nombre' => $Nombre,
                        'Cantidad' => $Cantidad,
                        'Img' => $Img,
                        'Descripcion' => $Descripcion,
                        'Id_Tipo_Cultivo' => $Id_Tipo_Cultivo
                    );

                    $response = array(
                        "status" => true,
                        "msg" => "Cultivo registrado correctamente",
                        "data" => $arraCultivo
                    );
                } else {
                    $response = array(
                        "status" => false,
                        "msg" => "Error al registrar el cultivo"
                    );
                }
                $code = 200;

            } else {
                $response = array(
                    "status" => false,
                    "msg" => "Los datos no se registraron, error en la solicitud: " . $method . " cambie a POST"
                );
                $code = 400;
            }

        } catch (\Exception $e) {
            echo "Error en el proceso: " . $e->getMessage();
        }

        jsonResponse($response, $code);
    }

    public function actualizar($idCultivo)
    {
        $response = [];

        try {
            $method = $_SERVER['REQUEST_METHOD'];
            if ($method == "PUT") {
                $_PUT = json_decode(file_get_contents("php://input"), true);

                error_log("Datos recibidos en actualizar: " . print_r($_PUT, true));


                $Nombre = ucwords(strtolower($_PUT['Nombre']));
                $Cantidad = $_PUT['Cantidad'];
                $Img = $_PUT['Img'];
                $Descripcion = $_PUT['Descripcion'];
                $Id_Tipo_Cultivo = $_PUT['Id_Tipo_Cultivo'];


                $request = $this->model->actualizarCultivo($idCultivo, $Nombre, $Cantidad, $Img, $Descripcion, $Id_Tipo_Cultivo);

                if ($request > 0) {
                    $response = array(
                        "status" => true,
                        "msg" => "Datos actualizados correctamente"
                    );
                } else {
                    $response = array(
                        "status" => false,
                        "msg" => "Error al actualizar los datos"
                    );
                }
                $code = 200;

            } else {
                $response = array(
                    "status" => false,
                    "msg" => "Error en la solicitud: " . $method . " cambie a PUT"
                );
                $code = 400;
            }

        } catch (\Exception $e) {
            echo "Error en el proceso: " . $e->getMessage();
        }

        jsonResponse($response, $code);
    }

    public function eliminar($idCultivo)
    {
        $response = [];

        try {
            $method = $_SERVER['REQUEST_METHOD'];
            if ($method == "DELETE") {
                $request = $this->model->eliminarCultivo($idCultivo);

                if ($request > 0) {
                    $response = array(
                        "status" => true,
                        "msg" => "Cultivo eliminado correctamente"
                    );
                } else {
                    $response = array(
                        "status" => false,
                        "msg" => "Error al eliminar el cultivo"
                    );
                }
                $code = 200;

            } else {
                $response = array(
                    "status" => false,
                    "msg" => "Error en la solicitud: " . $method . " cambie a DELETE"
                );
                $code = 400;
            }

        } catch (\Exception $e) {
            echo "Error en el proceso: " . $e->getMessage();
        }

        jsonResponse($response, $code);
    }

    public function obtener($idCultivo)
    {
        $response = [];

        try {
            $method = $_SERVER['REQUEST_METHOD'];
            if ($method == "GET") {
                $cultivo = $this->model->obtenerCultivo($idCultivo);

                if ($cultivo) {
                    $response = array(
                        "status" => true,
                        "data" => $cultivo
                    );
                } else {
                    $response = array(
                        "status" => false,
                        "msg" => "Cultivo no encontrado"
                    );
                }
                $code = 200;

            } else {
                $response = array(
                    "status" => false,
                    "msg" => "Error en la solicitud: " . $method . " cambie a GET"
                );
                $code = 400;
            }

        } catch (\Exception $e) {
            echo "Error en el proceso: " . $e->getMessage();
        }

        jsonResponse($response, $code);
    }
}
?>
