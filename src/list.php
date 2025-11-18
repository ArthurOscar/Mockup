<?php

class DataList
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function listarDadosSensor($filtro)
    {
        // se filtro vazio, traz últimas 200 linhas (ajuste conforme necessidade)
        if ($filtro === '') {
            $sql = "SELECT id, topic, msg, date, time FROM historico_sensores ORDER BY id DESC LIMIT 200";
            $stmt = $this->conn->query($sql);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $rows ?: [];
        }

        // caso o filtro pareça uma data no formato YYYY-MM-DD, podemos fazer busca mais precisa
        $isDate = preg_match('/^\d{4}-\d{2}-\d{2}$/', $filtro);

        if ($isDate) {
            $sql = "SELECT id, topic, msg, date, time
                    FROM historico_sensores
                    WHERE date = :date_val
                    ORDER BY id DESC
                    LIMIT 500";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':date_val', $filtro, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        }

        // busca parcial por topic ou date (LIKE)
        $sql = "SELECT id, topic, msg, date, time
                FROM historico_sensores
                WHERE topic LIKE :filtro OR date LIKE :filtro
                ORDER BY id DESC
                LIMIT 500";

        $stmt = $this->conn->prepare($sql);
        $filtro_pdo = '%' . $filtro . '%';
        $stmt->bindValue(':filtro', $filtro_pdo, PDO::PARAM_STR);
        $stmt->execute();

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows ?: [];
    }
}
