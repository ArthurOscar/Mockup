<?php

include '../db.php';
session_start();

if(!isset($_SESSION['logado'])){
    session_destroy();
    header("Location: index.php");
    exit;
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar senha</title>
    <link rel="stylesheet" href="../style/style.css">
    <script src="../script/script.js"></script>
</head>
<body>
    <nav class="navbar">
        <div class="logo">
            <img src="../assects/Logo_dashboard.png" onclick="reload()">
        </div>
    </nav>
    <h1 class="titulosenha">Redefinição de Senha!</h1>
    <p class="frasesenha">Para redefinir sua senha, informe o usuário ou e-mail cadastrado na sua conta e enviaremos um link com as instruções para ser administrador.</p>
    <div class="email">
        <form action="">
            <label for="user">E-mail ou Usuário:</label>
            <input type="text" id="user" name="user" required><br><br>
            <button id="enviarDados" type="button" onclick="recuperarSenha()">Recuperar Senha</button>
    </div>
    </form>
</body>

</html>