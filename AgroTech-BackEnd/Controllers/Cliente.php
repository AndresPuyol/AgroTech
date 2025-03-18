<?php
class Cliente extends Controllers{

    public function __construct()
    {
        parent::__construct();
    }

    public function cliente($idCliente)
    {
        echo "hola desde cliente con el id=".$idCliente;
    }

    public function registrar()
    {
        $response = [];

        try {
            $method = $_SERVER['REQUEST_METHOD'];
            if ($method == "POST") {

                $_POST = json_decode(file_get_contents("php://input"), true);

                if(empty($_POST['identificacion']))
                {
                    $response = array('status' => false, 'msg' => 'La identificacion es obligatoria');
                    jsonResponse($response, 200);
                    die();
                }

                if(!testString($_POST['nombres']))
                {
                    $response = array('status' => false, 'msg' => 'El nombre debe ser un texto');
                    jsonResponse($response, 200);
                    die();
                }

                if(!testString($_POST['apellidos']))
                {
                    $response = array('status' => false, 'msg' => 'Error en los apellidos');
                    jsonResponse($response, 200);
                    die();
                }

                if(!testEntero($_POST['telefono']))
                {
                    $response = array('status' => false, 'msg' => 'Error en el telefono');
                    jsonResponse($response, 200);
                    die();
                }

                if(!testEmail($_POST['email']))
                {
                    $response = array('status' => false, 'msg' => 'Error en el email');
                    jsonResponse($response, 200);
                    die();
                }

                if(!testString($_POST['direccion']))
                {
                    $response = array('status' => false, 'msg' => 'Error en la direccion');
                    jsonResponse($response, 200);
                    die();
                }

                if(!testEntero($_POST['nit']))
                {
                    $response = array('status' => false, 'msg' => 'Error en el nit');
                    jsonResponse($response, 200);
                    die();
                }

                if(!testString($_POST['nombreFiscal']))
                {
                    $response = array('status' => false, 'msg' => 'Error en el nombre fiscal');
                    jsonResponse($response, 200);
                    die();
                }

                if(!testString($_POST['direccionFiscal']))
                {
                    $response = array('status' => false, 'msg' => 'Error en la direccion fiscal');
                    jsonResponse($response, 200);
                    die();
                }

                $strIdentificacion = $_POST['identificacion'];
                $strNombres = ucwords(strtolower($_POST['nombres']));
                $strApellidos = ucwords(strtolower($_POST['apellidos']));
                $intTelefono = $_POST['telefono'];
                $strEmail = strtolower($_POST['email']);
                $strDireccion = $_POST['direccion'];
                $intNit = !empty($_POST['nit']) ? $_POST['nit'] : "";
                $strNomFiscal = !empty($_POST['nombreFiscal']) ? $_POST['nombreFiscal'] : "";
                $strDirFiscal = !empty($_POST['direccionFiscal']) ? $_POST['direccionFiscal'] : "";

                $request = $this->model->setCliente(
                    $strIdentificacion,
                    $strNombres,
                    $strApellidos,
                    $intTelefono,
                    $strEmail,
                    $strDireccion,
                    $intNit,
                    $strNomFiscal,
                    $strDirFiscal
                );

                if ($request > 0){
                    $arraCliente = array(
                        'identificacion' => $strIdentificacion,
                        'nombres' => $strNombres,
                        'apellidos' => $strApellidos,
                        'telefono' => $intTelefono,
                        'email' => $strEmail,
                        'direccion' => $strDireccion,
                        'nit' => $intNit,
                        'nombreFiscal' => $strNomFiscal,
                        'direccionFiscal' => $strDirFiscal
                    );

                    $response = array(
                        "status" => true,
                        "msg" => "Datos registrados correctamente",
                        "data" => $arraCliente
                    );
                } else {
                    $response = array(
                        "status" => false,
                        "msg" => "La identificacion o email ya se encuentra registrados",
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
            echo "error en el proceso:".$e->getMessage();
        }

        jsonResponse($response, $code);
    }

    public function actualizar($idCliente)
    {
        $response = [];

        try {
            $method = $_SERVER['REQUEST_METHOD'];
            if ($method == "PUT") {

                $_PUT = json_decode(file_get_contents("php://input"), true);

          

                $strIdentificacion = $_PUT['identificacion'];
                $strNombres = ucwords(strtolower($_PUT['nombres']));
                $strApellidos = ucwords(strtolower($_PUT['apellidos']));
                $intTelefono = $_PUT['telefono'];
                $strEmail = strtolower($_PUT['email']);
                $strDireccion = $_PUT['direccion'];
                $intNit = !empty($_PUT['nit']) ? $_PUT['nit'] : "";
                $strNomFiscal = !empty($_PUT['nombreFiscal']) ? $_PUT['nombreFiscal'] : "";
                $strDirFiscal = !empty($_PUT['direccionFiscal']) ? $_PUT['direccionFiscal'] : "";

                $request = $this->model->updateCliente(
                    $idCliente,
                    $strIdentificacion,
                    $strNombres,
                    $strApellidos,
                    $intTelefono,
                    $strEmail,
                    $strDireccion,
                    $intNit,
                    $strNomFiscal,
                    $strDirFiscal
                );

                if ($request > 0){
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
            echo "error en el proceso:".$e->getMessage();
        }

        jsonResponse($response, $code);
    }

    public function Eliminar($idCliente)
    {
        $response = [];

        try {
            $method = $_SERVER['REQUEST_METHOD'];
            if ($method == "DELETE") {

                $request = $this->model->deleteCliente($idCliente);

                if ($request > 0){
                    $response = array(
                        "status" => true,
                        "msg" => "Cliente eliminado correctamente"
                    );
                } else {
                    $response = array(
                        "status" => false,
                        "msg" => "Error al eliminar el cliente"
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
            echo "error en el proceso:".$e->getMessage();
        }

        jsonResponse($response, $code);
    }

    public function Obtener($idCliente)
    {
        $response = [];

        try {
            $method = $_SERVER['REQUEST_METHOD'];
            if ($method == "GET") {

                $cliente = $this->model->getCliente($idCliente);

                if ($cliente){
                    $response = array(
                        "status" => true,
                        "data" => $cliente
                    );
                } else {
                    $response = array(
                        "status" => false,
                        "msg" => "Cliente no encontrado"
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
            echo "error en el proceso:".$e->getMessage();
        }

        jsonResponse($response, $code);
    }
}
?>