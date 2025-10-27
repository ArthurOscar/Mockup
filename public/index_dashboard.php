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
    <title>Dashboard</title>
    <link rel="stylesheet" href="../style/style.css">
    <script src="../script/script.js"></script>
    <link rel="shortcut icon" type="image/ico" href="../assects/dashboard.png">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .dashboard-content {
            margin-left: 250px;
            padding: 20px;
        }
        .cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }
        .card {
            background: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            text-align: center;
        }
        .card h3 {
            margin: 0;
            font-size: 14px;
            color: #666;
        }
        .card .number {
            font-size: 24px;
            font-weight: bold;
            margin: 5px 0;
        }
        .charts {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        .chart-box {
            background: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            height: 250px;
        }
    </style>
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

    <div class="dashboard-content">
        <h1>Dashboard</h1>
        
        <div class="cards">
            <div class="card">
                <h3>Rotas Ativas</h3>
                <div class="number">12</div>
            </div>
            <div class="card">
                <h3>Manutenções</h3>
                <div class="number">5</div>
            </div>
            <div class="card">
                <h3>Alertas</h3>
                <div class="number">3</div>
            </div>
            <div class="card">
                <h3>Eficiência</h3>
                <div class="number">92%</div>
            </div>
        </div>
        
        <div class="charts">
            <div class="chart-box">
                <canvas id="rotasChart"></canvas>
            </div>
            <div class="chart-box">
                <canvas id="manutencaoChart"></canvas>
            </div>
        </div>
    </div>

    <script>
      
        const rotasCtx = document.getElementById('rotasChart').getContext('2d');
        new Chart(rotasCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai'],
                datasets: [{
                    label: 'Rotas Concluídas',
                    data: [10, 15, 12, 18, 14],
                    backgroundColor: '#3498db'
                }]
            }
        });

        
        const manutencaoCtx = document.getElementById('manutencaoChart').getContext('2d');
        new Chart(manutencaoCtx, {
            type: 'pie',
            data: {
                labels: ['Preventiva', 'Corretiva', 'Preditiva'],
                datasets: [{
                    data: [50, 30, 20],
                    backgroundColor: ['#27ae60', '#f39c12', '#e74c3c']
                }]
            }
        });
    </script>
    
</body>

</html>
</body>

</html>