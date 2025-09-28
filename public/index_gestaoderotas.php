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
    <title>Gestão de rotas</title>
    <link rel="stylesheet" href="../style/style.css">
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
            <a href="../public/index_gestaoderotas.php">Rotas</a>
            <a href="../public/index_manutencao.php">Manutenção</a>
            <a href="../public/index_relatorios.php">Relatórios</a>
            <a href="../public/index_alertas.php">Alertas</a>
            <br><br><br>
            <a href="logout.php">Sair</a>
        </div>
    </div>
    <main>
        <div id="saudacao"><!-- Nome do usúario --></div>
        <div id="pesquisar_completo">
            <input type="text" id="pesquisar_rota" maxlength="4" placeholder="PESQUISAR ROTAS">
            <input type="submit" id="buscar_botao" value="Buscar">
        </div>
        <hr>
        <div id="ferrovias">
            <div id="ferrovia" onclick="ferrovia()">
                <img id="seta" src="../assects/seta_ferrovia.png" alt="">
                <p>Ferrovia</p>
            </div>
            <div id="ferrovia_Aberto" class="ferrovia_Aberto">
                <div id="menu_rotas">
                    <div class="rota">
                        <p id="numero">0101</p>
                        <p id="rota_texto">Sul / Centro</p>
                    </div>
                    <div id="mapaStyle">
                        <img id="mapa_ferrovia" src="../assects/Mapa.PNG" alt="">
                        <div>
                            <p>Horário de partida: <u>08:20</u></p>
                            <br>
                            <p>Disponibilidade: <u>Seg a Seg</u></p>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </div>
    </main>
</body>

</html>