<?php

// Classe destinada a pegar informações do banco de dados para o DashBoard
class Sensores
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function sensor($tipo)
    {
        $sql = "SELECT valor FROM sensores WHERE tipo_sensor = :sensor";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':sensor', $tipo);
        if ($stmt->execute()) {
            $sensor_valor = $stmt->fetch(PDO::FETCH_ASSOC);
            return $sensor_valor ? $sensor_valor['valor'] : 'N/A';
        }

        return 'Erro';
    }

    public function localizacao()
    {
        $sql = "SELECT localizacao FROM sensores WHERE valor = 1 AND tipo_sensor = 'Presença'";
        $stmt = $this->conn->prepare($sql);
        if ($stmt->execute()) {
            $sensor_localizacao = $stmt->fetch(PDO::FETCH_ASSOC);
            return $sensor_localizacao ? $sensor_localizacao['localizacao'] : 'N/A';
        }

        return 'Erro';
    }
}
