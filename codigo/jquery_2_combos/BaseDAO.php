<?php

abstract class BaseDAO {
    protected PDO $conexion;
   
    public function __construct(PDO $conexion) {
        $this->conexion = $conexion;
    }

    public function comenzarTransaccion(): void {
        $this->conexion->beginTransaction();
    }

    public function confirmarTransaccion(): void {
        $this->conexion->commit();
    }

    public function revertirTransaccion(): void {
        $this->conexion->rollBack();
    }
}
?>