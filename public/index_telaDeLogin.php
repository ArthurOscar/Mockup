<?php

include '../includes/db.php';

session_start();

if (isset($_GET['logout'])) {
  session_destroy();
  header("Location: login.php");
  exit;
}

$mensagem = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $nome = $_POST["nome"] ?? "";
  $senha = $_POST["senha"] ?? "";

  $stmt = $conn->prepare("SELECT id_usuario, nome, email, senha FROM usuarios WHERE nome=? AND senha=?");
  $stmt->bind_param("ss", $nome, $senha);
  $stmt->execute();
  $result = $stmt->get_result();
  $dados = $result->fetch_assoc();
  $stmt->close();

  if ($dados) {
    $_SESSION["user_id"] = $dados["id"];
    $_SESSION["user"] = $dados["user"];
    header("Location: read.php?user=$_SESSION[user]");
    exit;
  } else {
    $msg = "Usuário ou senha incorretos!";
  }
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../style/style.css">
    <script src="../script/script.js"></script>
</head>

<body>
    <nav class="navbar">
        <div class="logo">
            <img src="../assects/Logo_dashboard.png" onclick="reload()">
        </div>
    </nav>
    <main>
        <div class="frase_introdutoria">
            <img src="../assects/TremVida_slogan.png" alt="">
            <p id="frase_introdutoriaText">Fazendo das ródovias
                em vias da vida</p>
        </div>
        <div class="login">
            <strong id="texto_login">Fazer Login:</strong><br>
            <input type="text" name="usuario_login" id="usuario_login" placeholder="Usuário">
            <div class="senha">
                <input type="password" id="senha_login" placeholder="Senha">
                <button id="olho" onclick="togglePasswordVisibility()"><img id="olho_img"
                        src="../assects/show.png"></button>
            </div>
            <button onclick="enviarDados()" id="enviarDados">Entrar</button>
            <a href="recuperar_senha.html" id="esqueceu_senha">Esqueceu a senha?</a>
        </div>
    </main>
</body>

</html>