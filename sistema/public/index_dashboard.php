<?php
include '../includes/db.php';
include '../src/auth.php';
include '../src/user.php';
include '../src/broker.php';

session_start();
$user = new User($conn);
$auth = new Auth();
$broker = new Broker($conn);

if (!$auth->isLoggedIn()) {
    header("location: index.php");
    exit();
}

$currentUser = $user->getUserById($_SESSION['user_id']);

$mensagem_ilu = $_SESSION['resposta_ilu'] ?? '';
$mensagem_temp = $_SESSION['resposta_temp'] ?? '';
$mensagem_umi = $_SESSION['resposta_umi'] ?? '';

// Iluminação
if (!empty($mensagem_ilu)) {
    // end() mostra a última mensagem do array
    $ultimaMsgIlu = end($mensagem_ilu);
    $broker->saveHist("s1/iluminacao", $ultimaMsgIlu['msg'], $ultimaMsgIlu['time']);
    $ilu_atual_msg = $ultimaMsgIlu['msg'];
    $ilu_atual_time = $ultimaMsgIlu['time'];
} else {
    // Busca do banco o último valor salvo
    $ilu_antigo = $broker->dataIlu();
    $ilu_atual_msg = $ilu_antigo['msg_anterior'] ?? null;
    $ilu_atual_time = $ilu_antigo['time_anterior'] ?? null;
    $ilu_atual_date = $ilu_antigo['date_anterior'] ?? null;
}

// Temperatura
if (!empty($mensagem_temp)) {
    // Pega a última mensagem
    $ultimaMsgTemp = end($mensagem_temp);
    $broker->saveHist("s1/temperatura", $ultimaMsgTemp['msg'], $ultimaMsgTemp['time']);
    $temp_atual_msg = $ultimaMsgTemp['msg'];
    $temp_atual_time = $ultimaMsgTemp['time'];
} else {
    // Busca no banco o valor salvo
    $temp_antigo = $broker->dataTemp();
    $temp_atual_msg = $temp_antigo['msg_anterior'] ?? null;
    $temp_atual_time = $temp_antigo['time_anterior'] ?? null;
    $temp_atual_date = $temp_antigo['date_anterior'] ?? null;
}

// Umidade
if (!empty($mensagem_umi)) {
    $ultimaMsgUmi = end($mensagem_umi);
    $broker->saveHist("s1/umidade", $ultimaMsgUmi['msg'], $ultimaMsgUmi['time']);
    $umi_atual_msg = $ultimaMsgUmi['msg'];
    $umi_atual_time = $ultimaMsgUmi['time'];
} else {
    $umi_antigo = $broker->dataUmi();
    $umi_atual_msg = $umi_antigo['msg_anterior'] ?? null;
    $umi_atual_time = $umi_antigo['time_anterior'] ?? null;
    $umi_atual_date = $umi_antigo['date_anterior'] ?? null;
}

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
            <a href="../public/index_historico.php">Histórico</a>
            <a href="../public/index_alertas.php">Alertas</a>
            <?php if ($currentUser['funcao'] === 'Admin'): ?>
                <a href="../public/index_cadastro.php">Cadastro</a> <!-- Só admin acessa -->
            <?php endif; ?>
            <br><br><br>
            <a href="logout.php">Sair</a>
        </div>
    </div>
    <main>
        <div class="dashboard">
            <div class="dashboard-title">
                <h1>DashBoard</h1>
                <a href="../src/get_messages.php" class="att_dashboard">Atualizar Página</a>
            </div>
            <div class="section-dashboard">

                <!-- Temperatura -->
                <div class="temp-dashboard">
                    <h2>Temperatura:</h2>
                    <?php
                    $displayTemp = htmlspecialchars($temp_atual_msg);
                    $displayTempTime = htmlspecialchars($temp_atual_time);
                    $dateObj = new DateTime($temp_atual_date);
                    $displayTempDate = $dateObj->format('d/m/Y');
                    ?>
                    <p><?php echo $displayTemp; ?>ºC</p>
                    <h2>Horário:</h2>
                    <p><?php echo $displayTempTime; ?></p>
                    <h2>Data:</h2>
                    <p><?php echo $displayTempDate; ?></p>
                </div>

                <!-- Umidade -->
                <div class="umida-dashboard">
                    <h2>Umidade:</h2>
                    <?php
                    $displayUmi = htmlspecialchars($umi_atual_msg);
                    $displayUmiTime = htmlspecialchars($umi_atual_time);
                    $dateObj = new DateTime($umi_atual_date);
                    $displayUmiDate = $dateObj->format('d/m/Y');
                    ?>
                    <p><?php echo $displayUmi; ?>%</p>
                    <h2>Horário:</h2>
                    <p><?php echo $displayUmiTime; ?></p>
                    <h2>Data:</h2>
                    <p><?php echo $displayUmiDate; ?></p>
                </div>

                <!-- Iluminação -->
                <div class="lux-dashboard">
                    <h2>Iluminação:</h2>
                    <?php
                    $displayIlu = htmlspecialchars($ilu_atual_msg);
                    $displayIluTime = htmlspecialchars($ilu_atual_time);
                    $dateObj = new DateTime($ilu_atual_date);
                    $displayIluDate = $dateObj->format('d/m/Y');
                    ?>
                    <p><?php echo $displayIlu; ?></p>
                    <h2>Horário:</h2>
                    <p><?php echo $displayIluTime; ?></p>
                    <h2>Data:</h2>
                    <p><?php echo $displayIluDate; ?></p>
                </div>
            </div>
        </div>
    </main>
</body>

</html>