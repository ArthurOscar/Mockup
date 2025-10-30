<?php

class Auth{
    // Verificar se está logado
    public function isLoggedIn(){
        return isset($_SESSION['user_id']);
    }

    // Função para jogar dados para o SESSION
    public function loginUser($user){
        $_SESSION['user_id'] = $user['id_usuario'];
        $_SESSION['username'] = $user['nome'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['funcao'] = $user['funcao'];
    }

    // Função para deslogar usuário
    public function logout(){
        session_destroy();
        header("location: index.php");
    }
}

?>