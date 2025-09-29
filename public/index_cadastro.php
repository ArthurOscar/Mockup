<?php
include '../includes/db.php';
include '../src/auth.php';
include '../src/user.php';

session_start();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $user = new User($conn);
    
    $user->register($_POST['nome'], $_POST['email'], $_POST['senha'], $_POST['funcao']);
    header("location: index_dashboard.php");
}

$currentUser = $user -> getUserById($_SESSION['user_id']);

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <script src="../script/script.js"></script>
    <link rel="shortcut icon" type="image/ico" href="../assects/cadastro.png">
</head>

<body>
    <nav class="navbar">
        <div class="perfil">
            <a href="index_perfil.php">
                <img src="../uploads/<?php echo htmlspecialchars($currentUser['foto_perfil']); ?>"
                    alt="foto de perfil">
            </a>
        </div>
        <div class="logo">
            <img src="../assects/Logo_dashboard.png" onclick="reload()">
        </div>
        <div class="menu_dashboard">
            <img id="imagem_menu" onclick="trocar_menu()" src="../assects/menu_dashboard.png">
        </div>
    </nav>
    <div id="menu_lateral" class="menu_lateral">
        <div id="menu_links">
            <a href="../public/index_dashboard.php">Início</a>
            <a href="../public/index_gestaoderotas.php">Rotas</a>
            <a href="../public/index_manutencao.php">Manutenção</a>
            <a href="../public/index_relatorios.php">Relatórios</a>
            <a href="../public/index_alertas.php">Alertas</a>
            <br><br><br>
            <a href="logout.php">Sair</a>
        </div>
    </div>
    <br>
    <div class="login">
        <form method="POST">
            <strong id="texto_login">Novo Cadastro:</strong><br>
            <input type="text" id="usuario_login" name="nome" maxlength="100" placeholder="Usuário">
            <input type="text" id="usuario_login" name="email" maxlength="250" placeholder="Email">
            <div class="senha">
                <input type="password" maxlength="100" id="senha_login" name="senha" placeholder="Senha">
                <button type="button" id="olho" onclick="togglePasswordVisibility()"><img id="olho_img"
                        src="../assects/show.png"></button>
            </div>
            <select name="funcao">
                <option value="Admin">Administrador</option>
                <option value="Funcionário">Funcionário</option>
            </select>
            <button type="submit" id="enviarDados">Cadastrar</button>
        </form>
    </div>
    <link rel="stylesheet" href="../style/style.css">
</body>

</html>