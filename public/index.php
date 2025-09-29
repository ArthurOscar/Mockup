<?php
include '../includes/db.php';
include '../src/auth.php';
include '../src/user.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $user = new User($conn);
  $auth = new Auth();
  $loggedInUser = $user->login($_POST['email'], $_POST['senha']);
  if ($loggedInUser) {
    $auth->loginUser($loggedInUser);
    header("location: index_dashboard.php");
  } else {
    echo "<script>alert('Login Falhou!')</script>";
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
  <link rel="shortcut icon" type="image/ico" href="../assects/login.jpg">
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
    </div>
  </main>
</body>

</html>