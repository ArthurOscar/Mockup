<?php
include '../includes/db.php';
include '../src/auth.php';
include '../src/user.php';

session_start();
$auth = new Auth();
$user = new User($conn);

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
    <title>Alertas</title>
    <link rel="stylesheet" href="../style/style.css">
    <script src="../script/script.js"></script>
    <link rel="shortcut icon" type="image/ico" href="../assects/alerta.png">
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
        <?php
        // Mostrando os dados do BD de alertas
        $sql = "SELECT * FROM alertas";
        $result = $conn->query($sql);
        $alertas = $result->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($alertas)) {
            foreach ($alertas as $row) {
                $tipo_alerta = htmlspecialchars($row['tipo_alerta']);
                $mensagem = htmlspecialchars($row['mensagem']);
                echo "<div class='textGreen_comunicado'>";
                echo "<p>$tipo_alerta</p>";
                echo "</div>";
                echo "<div>";
                echo "<p class='textoAlerta'>$mensagem</p>";
                echo "</div>";
                echo "<br><hr>";
            }
        } else {
            echo 'Nenhum alerta ou comunicado encontrado.';
        }
        ?>
    </main>
</body>

</html>