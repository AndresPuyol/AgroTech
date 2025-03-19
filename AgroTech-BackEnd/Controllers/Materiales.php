<?php
    class Materiales extends Controllers
    {

        public function Materiales($IdMaterial)
        {
            echo "hola desde materiales" . $IdMaterial;
        }

        public function registrarMaterial()
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

                    if (!testEntero($_POST['Precio'])) {
                        $response = array('status' => false, 'msg' => 'El precio debe ser un numero');
                        jsonResponse($response, 200);
                        die();
                    }

                    if (!testString($_POST['Descripcion'])) {
                        $response = array('status' => false, 'msg' => 'La descripcion debe ser un texto');
                        jsonResponse($response, 200);
                        die();
                    }

                    if (!testEntero($_POST['Cantidad'])) {
                        $response = array('status' => false, 'msg' => 'La cantidad debe ser un numero');
                        jsonResponse($response, 200);
                        die();
                    }

                    $Nombre = ucwords(strtolower($_POST['Nombre']));
                    $Precio = $_POST['Precio'];
                    $Descripcion = ucwords(strtolower($_POST['Descripcion']));
                    $Tipo_Material = isset($_POST['TipoM']) ? $_POST['TipoM'] : null;
                    $Tipo_Medida_Material = isset($_POST['TipoMM']) ? $_POST['TipoMM'] : null;
                    $Cantidad = $_POST['Cantidad'];

                    $request = $this->model->setMaterial(
                        $Nombre,
                        $Precio,
                        $Descripcion,
                        $Tipo_Material,
                        $Tipo_Medida_Material,
                        $Cantidad
                    );

                    if ($request > 0) {
                        $arraMaterial = array(
                            'Nombre' => $Nombre,
                            'Precio' => $Precio,
                            'Descripcion' => $Descripcion,
                            'tipo_Material' => $Tipo_Material,
                            'Tipo_Medida_Material' => $Tipo_Medida_Material,
                            'Cantidad' => $Cantidad
                        );
                        $response = array(
                            "status" => true,
                            "msg" => "Datos del material registrados correctamente",
                            "data" => $arraMaterial
                        );

                    } else {
                        $response = array(
                            "status" => false,
                            "msg" => "Error al registrar material, ya esta registrado"
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
            } catch (Exception $e) {
                echo "error en el proceso" . $e->getMessage();
            }
            

            jsonResponse($response, $code);

        }

    }

?>