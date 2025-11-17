<?php

class Broker
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Salva no Histórico
    public function saveHist($topic, $msg, $time)
    {
        $sql = "INSERT INTO Historico_sensores (topic, msg, time) VALUES (:topic, :msg, :time)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':topic', $topic);
        $stmt->bindParam(':msg', $msg);
        $stmt->bindParam(':time', $time);
        return $stmt->execute();
    }

    // Mostra o Valor do banco de dados
    // Busca pelo último dado do sensor
    public function dataIlu()
    {
        $sql = "SELECT * FROM historico_sensores WHERE topic = 's1/iluminacao' ORDER BY CONCAT(date, ' ', time) DESC LIMIT 1;";
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
        $sql = "SELECT * FROM historico_sensores WHERE topic = 's1/temperatura' ORDER BY CONCAT(date, ' ', time) DESC LIMIT 1;";
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
        $sql = "SELECT * FROM historico_sensores WHERE topic = 's1/umidade' ORDER BY CONCAT(date, ' ', time) DESC LIMIT 1;";
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
