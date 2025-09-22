<?php

include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST["email"] ?? "";
    $nome = $_POST["nome"] ?? "";
    $senha = $_POST["senha"] ?? "";
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO usuario(nome, email, senha) VALUES (?,?,?)");
    $stmt->bind_param("sss", $nome, $email, $senha_hash);

    if ($stmt->execute()) {
        header("Location: index_dashboard.php?user=$_SESSION[user]");
        exit;
    } else {
        echo "Erro: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}


?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <script src="../script/script.js"></script>
</head>

<body>
    <nav class="navbar">
        <div class="logo">
            <img src="../assects/Logo_dashboard.png" onclick="reload()">
        </div>
        <div class="menu_dashboard">
            <img id="imagem_menu" onclick="trocar_menu()" src="../assects/menu_dashboard.png">
        </div>
    </nav>
    <div id="menu_lateral" class="menu_lateral">
        <div id="menu_links">
            <a href="../public/index_gestaoderotas.html">Rotas</a>
            <a href="../public/index_manutencao.html">Manutenção</a>
            <a href="../public/index_relatorios.html">Relatórios</a>
            <a href="../public/index_alertas.html">Alertas</a>
        </div>
    </div>
    <div class="login">
        <form method="POST">
            <strong id="texto_login">Novo Cadastro:</strong><br>
            <input type="text" id="usuario_login" name="email" placeholder="Email">
            <input type="text" id="usuario_login" name="nome" placeholder="Usuário">
            <div class="senha">
                <input type="password" id="senha_login" name="senha" placeholder="Senha">
                <button id="olho" onclick="togglePasswordVisibility()"><img id="olho_img"
                        src="../assects/show.png"></button>
            </div>
            <button type="submit" id="enviarDados">Cadastrar</button>
        </form>
    </div>
    <link rel="stylesheet" href="../style/style.css">
</body>

</html>