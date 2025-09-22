<?php

include '../includes/db.php';

session_start();

if (isset($_GET['logout'])) {
  session_destroy();
  header("Location: login.php");
  exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $nome = $_POST["nome"] ?? "";
  $senha = $_POST["senha"] ?? "";

  $stmt = $conn->prepare("SELECT id_usuario, nome, email, senha FROM usuario WHERE nome=?");
  $stmt->bind_param("s", $nome);
  $stmt->execute();
  $result = $stmt->get_result();
  $dados = $result->fetch_assoc();
  $stmt->close();

  if ($dados && password_verify($senha, $dados["senha"])) {
    $_SESSION["usuario_id"] = $dados["id_usuario"];
    $_SESSION["usuario"] = $dados["nome"];
    header("Location: index_dashboard.php?usuario=$_SESSION[usuario]");
    exit;
  } else {
    echo "<script>alert('Usuário ou senha incorretos!')</script>";
    $conn->close();
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
      <form method="POST">
        <strong id="texto_login">Fazer Login:</strong><br>
        <input type="text" id="usuario_login" name="nome" placeholder="Usuário">
        <div class="senha">
          <input type="password" id="senha_login" name="senha" placeholder="Senha">
          <button type="button" id="olho" onclick="togglePasswordVisibility()"><img id="olho_img"
              src="../assects/show.png"></button>
        </div>
        <button type="submit" id="enviarDados">Entrar</button>
      </form>
      <a href="recuperar_senha.html" id="esqueceu_senha">Esqueceu a senha?</a>
    </div>
  </main>
</body>

</html>