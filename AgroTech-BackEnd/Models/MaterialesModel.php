<?php

class MaterialesModel extends Mysql
{
    private $Id_Material;
    private $Nombre;
    private $Precio;
    private $Descripcion;
    private $Tipo_Material;
    private $Tipo_Medida_Material;
    private $Cantidad;

    public function setMaterial($Nombre, $Precio, $Descripcion, $Tipo_Material, $Tipo_Medida_Material, $Cantidad)
    {
        $this->Nombre = $Nombre;
        $this->Precio = $Precio;
        $this->Descripcion = $Descripcion;
        $this->Tipo_Material = $Tipo_Material;
        $this->Tipo_Medida_Material = $Tipo_Medida_Material;
        $this->Cantidad = $Cantidad;

        $sql = "SELECT Id_Material, Nombre FROM Materiales WHERE Id_material = :Id OR Nombre = :Nom";
        $arrayParams = array(
            ':Id' => $this->Id_Material,
            ':Nom' => $this->Nombre
        );

        $request = $this->select($sql, $arrayParams);
        if (!empty($request)) {
            return false;
        } else {
            $query_insert = "INSERT INTO `materiales`(`Nombre`, `Precio`, `Descripcion`, `Tipo_Material`, `Tipo_Medida_Material`, `Cantidad`) VALUES(:Nombre,:Precio,:Descripcion,:TipoM,:TipoMM,:Cantidad)";

            $arrayMaterial = array(
                ':Nombre' => $Nombre,
                ':Precio' => $Precio,
                ':Descripcion' => $Descripcion,
                ':TipoM' => $Tipo_Material,
                ':TipoMM' => $Tipo_Medida_Material,
                ':Cantidad' => $Cantidad
            );

            $request_insert = $this->insert($query_insert, $arrayMaterial);
            return $request_insert;
        }
    }
}