<?php

class DataList
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function listarValoresUser($id){
        $sql = "SELECT * FROM usuarios WHERE id_usuario=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt -> bindParam(":id", $id);
        $stmt->execute();
        $rows = $stmt->fetch(PDO::FETCH_ASSOC);
        return $rows ?: [];
    }

    public function listarDadosSensor($filtro)
    {
        // se filtro vazio, traz últimas 200 linhas
        if ($filtro === '') {
            $sql = "SELECT id, topic, msg, date, time FROM historico_sensores ORDER BY id DESC LIMIT 200";
            $stmt = $this->conn->query($sql);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $rows ?: [];
        }

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
    public function listarUsuarios($filtro)
    {
        if ($filtro === '') {
            $sql = "SELECT id_usuario, nome, email, funcao, situacao FROM usuarios ORDER BY nome";
            $stmt = $this->conn->query($sql);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $rows ?: [];
        }

        $sql = "SELECT id_usuario, nome, email, funcao, situacao FROM usuarios 
        WHERE nome LIKE :filtro or id_usuario LIKE :filtro or email LIKE :filtro or funcao LIKE :filtro or situacao LIKE :filtro 
        ORDER BY nome";

        $stmt = $this->conn->prepare($sql);
        $filtro_pdo = '%' . $filtro . '%';
        $stmt->bindValue(':filtro', $filtro_pdo, PDO::PARAM_STR);
        $stmt->execute();

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows ?: [];
    }
}
