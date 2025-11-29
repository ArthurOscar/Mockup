<?php
include '../includes/db.php';
include '../src/auth.php';
include '../src/user.php';
include '../src/list.php';

session_start();
$list = new DataList($conn);
$user = new User($conn);
$auth = new Auth();
$currentUser = $user->getUserById($_SESSION['user_id']);
$user = new User($conn);

if (!$auth->isLoggedIn()) {
    header("location: index.php");
    exit();
}

if ($currentUser["funcao"] === "Funcionário") {
    header("location: index_dashboard.php");
    exit();
}

$filtro = $_GET['filtro'] ?? '';

$currentUser = $user->getUserById($_SESSION['user_id']);

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de usuários</title>
    <link rel="stylesheet" href="../style/style.css">
    <script src="../script/script.js"></script>
    <link rel="shortcut icon" type="image/ico" href="../assects/tremvida.png">
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
        <div class="historico">
            <p>Usuários</p>
            <form method="GET">
                <div class="filter-container">
                    <input type="text" name="filtro" placeholder="Filtrar por nome, email..." class="filter-input">
                    <button type="submit" class="filter-btn">
                        <img src="../assects/lupa.png" alt="buscar">
                    </button>
                </div>
            </form>
        </div>
        <hr>
        <div id="resultado_historico">
            <?php
            $dados = $list->listarUsuarios($filtro);

            if (!empty($dados)) {
                echo "<div class='historico-grid'>";

                foreach ($dados as $dado) {
                    $id = htmlspecialchars($dado['id_usuario']);
                    $nome = htmlspecialchars($dado['nome']);
                    $email = htmlspecialchars($dado['email']);
                    $funcao = htmlspecialchars($dado['funcao']);
                    $situacao = htmlspecialchars($dado['situacao']);

                    echo "<div class='historico-card'>";
                    echo "<p><strong>ID:</strong> {$id}</p>";
                    echo "<p><strong>Nome:</strong> {$nome}</p>";
                    echo "<p><strong>Email:</strong> {$email}</p>";
                    echo "<p><strong>Função:</strong> {$funcao}</p>";
                    echo "<p><strong>Situação:</strong> {$situacao}</p>";
                    echo "</div>";
                }

                echo "</div>";
            } else {
                if ($filtro === '') {
                    echo "<p>Nenhum dado encontrado.</p>";
                } else {
                    echo "<p>Nenhum dado encontrado para o filtro: <strong>" . htmlspecialchars($filtro) . "</strong>.</p>";
                }
            }
            ?>
        </div>
    </main>
</body>
</html>