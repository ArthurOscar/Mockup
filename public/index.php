<?php

include '../db.php';

session_start();

if (isset($_GET['logout']) && $_GET['logout'] == '1') {
  session_destroy();
  header("Location: index.php");
  exit;
}

if (isset($_SESSION['logado']) && $_SESSION['logado'] === true) {
  header("Location: index_dashboard.php");
  exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $email = $_POST["email"] ?? "";
  $senha = $_POST["senha"] ?? "";

  $stmt = $conn->prepare("SELECT id_usuario, nome, email, senha, data_nascimento, descricao, funcao FROM usuarios WHERE email=? AND senha=?");
  $stmt->bind_param("ss", $email, $senha);
  $stmt->execute();
  $result = $stmt->get_result();
  $dados = $result->fetch_assoc();
  $stmt->close();

  if ($dados) {
    $_SESSION["usuario_id"] = $dados["id_usuario"];
    $_SESSION["usuario"] = $dados["nome"];
    $_SESSION["data_nascimento"] = $dados["data_nascimento"];
    $_SESSION["email"] = $dados["email"];
    $_SESSION["senha"] = $dados["senha"];
    $_SESSION["funcao"] = $dados["funcao"];
    $_SESSION["logado"] = true;
    header("Location: index_dashboard.php");
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
      <p id="frase_introdutoriaText">Fazendo das rodovias
        em vias da vida</p>
    </div>
    <div class="login">
      <form method="POST">
        <strong id="texto_login">Fazer Login:</strong><br>
        <input type="text" id="usuario_login" name="email" placeholder="Email">
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