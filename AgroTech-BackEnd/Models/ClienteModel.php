<?php

class ClienteModel extends Mysql
{
    private $intIdCliente;
    private $strIdentificacion;
    private $strNombres;
    private $strApellidos;
    private $intTelefono;
    private $strEmail;
    private $strDireccion;
    private $strNit;
    private $strNombreFiscal;
    private $strDirFiscal;
    private $intStatus;

    public function __construct()
    {
        parent::__construct();
    }

    public function setCliente(string $identificacion, string $nombres, string $apellidos, int $telefono, string $email, string $direccion, int $nit, string $nomfiscal, string $dirfiscal)
    {
        $this->strIdentificacion = $identificacion;
        $this->strNombres = $nombres;
        $this->strApellidos = $apellidos;
        $this->intTelefono = $telefono;
        $this->strEmail = $email;
        $this->strDireccion = $direccion;
        $this->strNit = $nit;
        $this->strNomFiscal = $nomfiscal;
        $this->strDirFiscal = $dirfiscal;

        $sql = "SELECT identificacion, email FROM cliente WHERE (email = :email OR identificacion = :iden) AND status = :status";
        $arrayParams = array(
            ':email' => $email,
            ':iden' => $identificacion,
            ':status' => 1
        );

        $request = $this->select($sql, $arrayParams);

        if (!empty($request)) {
            return false;
        } else {
            $query_insert = "INSERT INTO cliente(identificacion, nombres, apellidos, telefono, email, direccion, nit, nombrefiscal, direccionfiscal) VALUES (:iden, :nom, :ape, :tel, :email, :dir, :nit, :nomfiscal, :dirfiscal)";
            $arrayData = array(
                ':iden' => $this->strIdentificacion,
                ':nom' => $this->strNombres,
                ':ape' => $this->strApellidos,
                ':tel' => $this->intTelefono,
                ':email' => $this->strEmail,
                ':dir' => $this->strDireccion,
                ':nit' => $this->strNit,
                ':nomfiscal' => $this->strNomFiscal,
                ':dirfiscal' => $this->strDirFiscal
            );

            $request_insert = $this->insert($query_insert, $arrayData);
            return $request_insert;
        }
    }

    public function updateCliente(int $idCliente, string $identificacion, string $nombres, string $apellidos, int $telefono, string $email, string $direccion, int $nit, string $nomfiscal, string $dirfiscal)
    {
        $this->intIdCliente = $idCliente;
        $this->strIdentificacion = $identificacion;
        $this->strNombres = $nombres;
        $this->strApellidos = $apellidos;
        $this->intTelefono = $telefono;
        $this->strEmail = $email;
        $this->strDireccion = $direccion;
        $this->strNit = $nit;
        $this->strNomFiscal = $nomfiscal;
        $this->strDirFiscal = $dirfiscal;

        $sql = "UPDATE cliente SET identificacion = :iden, nombres = :nom, apellidos = :ape, telefono = :tel, email = :email, direccion = :dir, nit = :nit, nombrefiscal = :nomfiscal, direccionfiscal = :dirfiscal WHERE idcliente = :id";
        $arrayData = array(
            ':iden' => $this->strIdentificacion,
            ':nom' => $this->strNombres,
            ':ape' => $this->strApellidos,
            ':tel' => $this->intTelefono,
            ':email' => $this->strEmail,
            ':dir' => $this->strDireccion,
            ':nit' => $this->strNit,
            ':nomfiscal' => $this->strNomFiscal,
            ':dirfiscal' => $this->strDirFiscal,
            ':id' => $this->intIdCliente
        );

        $request = $this->update($sql, $arrayData);
        return $request;
    }

    public function deleteCliente(int $idCliente)
    {
        $this->intIdCliente = $idCliente;
        $sql = "DELETE FROM cliente WHERE idcliente = :id";
        $arrayData = array(':id' => $this->intIdCliente);

        $request = $this->delete($sql, $arrayData);
        return $request;
    }

    public function getCliente(int $idCliente)
    {
        $this->intIdCliente = $idCliente;
        $sql = "SELECT * FROM cliente WHERE idcliente = :id";
        $arrayData = array(':id' => $this->intIdCliente);

        $request = $this->select($sql, $arrayData);
        return $request;
    }
}
?>