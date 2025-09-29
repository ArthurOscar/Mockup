<?php
include '../includes/db.php';
include '../src/auth.php';
include '../src/user.php';

session_start();
$auth = new Auth();
$user = new User($conn);

if (!$auth->isLoggedIn()) {
    header("location: login.php");
    exit();
}

$currentUser = $user->getUserById($_SESSION['user_id']);

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alertas</title>
    <link rel="stylesheet" href="../style/style.css">
    <script src="../script/script.js"></script>
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
        <div class="flex-Alertas">
            <div class="alertas">
                <p>Alertas</p>
            </div>
            <div id="abaFiltro">
                <select name="filtro" id="filtro" required onclick="filtroAbrir()">
                    <option value="Filtros">Filtros</option>
                    <option value="naoLidos">Comunicados</option>
                    <option value="Lidos">Alertas</option>
                </select>
            </div>
        </div>
        <hr>
        <div class="textGreen_comunicado">
            <p>Comunicado</p>
        </div>
        <div>
            <p class="textoAlerta">Informamos que a linha (0101) Sul / Centro, Terá um atraso por conta das
                manutenções dos trilhos.</p>
        </div>
        <br>
        <hr>
        <div class="textGreen_comunicado">
            <p>Comunicado</p>
        </div>
        <div>
            <p class="textoAlerta">Informamos que o trem da linha (0103) está passando por consertos por conta de
                falhas mecânicas. </p>
        </div>
        <br>
        <hr>
        <div class="textGreen_alerta">
            <p>Alerta</p>
        </div>
        <div>
            <p class="textoAlerta">Anunciamos que nossa ferroviária está passando por atualizações de segurança e
                por isso os serviços serão limitados.</p>
        </div>
        <br>
        <hr>
    </main>
</body>

</html>