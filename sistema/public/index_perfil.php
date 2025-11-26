<?php
include '../includes/db.php';
include '../src/auth.php';
include '../src/user.php';

session_start();
$auth = new Auth();
$user = new User($conn);

if (!$auth->isLoggedIn()){
    header("location: index.php");
    exit();
}

$currentUser = $user -> getUserById($_SESSION['user_id']);
echo "<link rel='stylesheet' href='../style/style.css'>";
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <script src="../script/script.js"></script>
    <link rel="shortcut icon" type="image/ico" href="../assects/perfil.png">
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
                <a href="../public/index_cadastro.php">Cadastro</a>
                <a href="../public/index_gerenciamento.php">Usuários</a>
            <?php endif; ?>
            <br><br><br>
            <a href="logout.php">Sair</a>
        </div>
    </div>
    <br>
    <?php
    echo "<div class='perfil-container'>";
    echo "<h2>Informações:</h2><br>";
    $id = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE id_usuario = ?");
    $stmt->execute([$id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        echo "<div class='info-table'>";
        echo "<div class='info-row'><span class='info-label'>Nome:</span> <span class='info-value'>{$result['nome']}</span></div>";
        echo "<div class='info-row'><span class='info-label'>Email:</span> <span class='info-value'>{$result['email']}</span></div>";
        echo "<div class='info-row'><span class='info-label'>Função:</span> <span class='info-value'>{$result['funcao']}</span></div>";
        echo "</div><br>";
    }
    echo "<a href='upload_foto.php' class='foto'>Trocar Foto de Perfil</a>";
    echo "</div>";
    ?>
</body>

</html>