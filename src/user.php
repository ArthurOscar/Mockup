<?php

class User {
    private $conn;

    public function __construct($db){
        $this-> conn = $db;
    }
    public function register($nome, $email, $senha, $funcao){
        $hash = password_hash($senha, PASSWORD_DEFAULT);
        $sql = "INSERT INTO usuarios (nome, email, senha, funcao) VALUES (:nome, :email, :senha, :funcao)";
        $stmt = $this-> conn->prepare($sql);
        $stmt -> bindParam(':nome', $nome);
        $stmt -> bindParam(':email', $email);
        $stmt -> bindParam(':senha', $hash);
        $stmt -> bindParam(':funcao', $funcao);
        return $stmt->execute();
    }

    public function login($email, $password){
        $sql = "SELECT * FROM usuarios WHERE email= :email";
        $stmt = $this -> conn->prepare($sql);
        $stmt ->bindParam(":email", $email);
        $stmt->execute();
        $user = $stmt -> fetch(PDO::FETCH_ASSOC);

        if($user && password_verify($password, $user['senha'])){
            return $user;
        }
        return false;
    }
    public function getUserById($user_id){
        $sql = "SELECT * FROM usuarios WHERE id_usuario= :id";
        $stmt = $this -> conn->prepare($sql);
        $stmt ->bindParam(":id", $user_id);
        $stmt->execute();
        return $stmt -> fetch(PDO::FETCH_ASSOC);
    }
    public function updateProfilePic($user_id,$profilePic){
        $sql = "UPDATE usuarios SET foto_perfil = :profile_pic WHERE id_usuario              = :id";
        $stmt = $this-> conn->prepare($sql);
        $stmt -> bindParam(':profile_pic', $profilePic);
        $stmt -> bindParam(':id', $user_id);
        return $stmt->execute();
    }
}

?>