<?php
include '../includes/db.php';
include '../src/auth.php';
include '../src/user.php';

session_start();
$auth = new Auth();
$user = new User($conn);

if (!$auth->isLoggedIn()){
    header("location: login.php");
    exit();
}

$currentUser = $user -> getUserById($_SESSION['user_id']);

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manutenção</title>
    <link rel="stylesheet" href="../style/style.css">
    <script src="../script/script.js"></script>
    <link rel="shortcut icon" type="image/ico" href="../assects/manutencao.png">
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
    <main>
        <div id="saudacao">
            <p>Monitoramento de Manutenção</del></p>
            <div id="pesquisar_completo">
                <input type="text" id="pesquisar_rota" maxlength="4" placeholder="PESQUISAR ROTAS">
                <input type="submit" id="buscar_botao" value="Buscar">
            </div>
        </div>
        <hr>
        <div id="ferrovias">
            <div id="ferrovia" onclick="ferrovia()">
                <img id="seta" src="../assects/seta_ferrovia.png" alt="">
                <p>Ferrovia Sul</p>
            </div>
            <div id="ferrovia_Aberto" class="ferrovia_Aberto">
                <div id="menu_rotas">
                    <div class="rota">
                        <p id="numero">0101</p>
                        <p id="rota_texto">*Arrumar trilho da rota*</p>
                    </div>
                </div>
            </div>
            <hr>
        </div>
    </main>

</body>

</html>