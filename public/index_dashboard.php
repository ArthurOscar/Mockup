<?php
include '../includes/db.php';
include '../src/auth.php';
include '../src/user.php';
include '../src/sensores.php';

session_start();
$user = new User($conn);
<<<<<<< HEAD
$auth = new Auth();
=======
$sensor = new Sensores($conn);
>>>>>>> DashBoard

if (!$auth->isLoggedIn()) {
    header("location: index.php");
    exit();
}

$currentUser = $user->getUserById($_SESSION['user_id']);

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../style/style.css">
    <script src="../script/script.js"></script>
    <link rel="shortcut icon" type="image/ico" href="../assects/dashboard.png">
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
            <?php if ($currentUser['funcao'] === 'Admin'): ?>
                <a href="../public/index_cadastro.php">Cadastro</a>
            <?php endif; ?>
            <br><br><br>
            <a href="logout.php">Sair</a>
        </div>
    </div>
    <main>
        <div class="dashboard">
            <div class="dashboard-title">
                <h1>DashBoard</h1>
            </div>
            <div class="section-dashboard">
                <div class="temp-dashboard">
                    <h2>Temperatura:</h2>
                    <p><?php echo $sensor->sensor("Temperatura"); ?>ºC</p>
                </div>
                <div class="umida-dashboard">
                    <h2>Umidade:</h2>
                    <p><?php echo $sensor->sensor("Umidade"); ?>%</p>
                </div>
                <div class="lux-dashboard">
                    <h2>Luminosidade:</h2>
                    <p><?php echo $sensor->sensor("Luminosidade"); ?> Lux</p>
                </div>
                <div class="presenca-dashboard">
                    <h2>Localização:</h2>
                    <p>O trem está no posto: <?php echo $sensor->localizacao(); ?></p>
                </div>
            </div>
        </div>
    </main>
</body>

</html>