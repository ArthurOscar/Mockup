<?php

class Broker
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Guarda o Valor do topico s1/iluminacao
    public function saveDataIlu($msg, $time)
    {
        $sql = "UPDATE Valor_sensores SET msg = :msg, time = :time WHERE topic = 's1/iluminacao'";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':msg', $msg);
        $stmt->bindParam(':time', $time);
        return $stmt->execute();
    }

    public function saveDataTemp($msg, $time)
    {
        $sql = "UPDATE Valor_sensores SET msg = :msg, time = :time WHERE topic = 's1/temperatura'";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':msg', $msg);
        $stmt->bindParam(':time', $time);
        return $stmt->execute();
    }

    public function saveDataUmi($msg, $time)
    {
        $sql = "UPDATE Valor_sensores SET msg = :msg, time = :time WHERE topic = 's1/umidade'";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':msg', $msg);
        $stmt->bindParam(':time', $time);
        return $stmt->execute();
    }

    // Mostra o Valor do banco de dados
    public function dataIlu()
    {
        $sql = "SELECT * FROM Valor_sensores WHERE topic= 's1/iluminacao'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $iluminacao = $stmt->fetch(PDO::FETCH_ASSOC);

        // Retorna os dois valores como um array
        return [
            'msg_anterior' => $iluminacao['msg'],
            'time_anterior' => $iluminacao['time']
        ];
    }
    public function dataTemp()
    {
        $sql = "SELECT * FROM Valor_sensores WHERE topic= 's1/temperatura'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $temperatura = $stmt->fetch(PDO::FETCH_ASSOC);

        // Retorna os dois valores como um array
        return [
            'msg_anterior' => $temperatura['msg'],
            'time_anterior' => $temperatura['time']
        ];
    }
    public function dataUmi()
    {
        $sql = "SELECT * FROM Valor_sensores WHERE topic= 's1/umidade'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $umidade = $stmt->fetch(PDO::FETCH_ASSOC);

        // Retorna os dois valores como um array
        return [
            'msg_anterior' => $umidade['msg'],
            'time_anterior' => $umidade['time']
        ];
    }
}
