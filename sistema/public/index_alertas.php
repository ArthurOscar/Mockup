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

$filtro = $_GET['filtro'] ?? '';

if ($filtro === "reset") {
    $filtro = '';
    header("location: index_alertas.php");
}

if ($filtro != "comunicados" && $filtro != "alertas") {
    $filtro = '';
}

$currentUser = $user->getUserById($_SESSION['user_id']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['adicionar'])) {
        $tipo_alerta = $_POST['tipo_alerta'];
        $mensagem = $_POST['mensagem'];
        $user_id = $currentUser['id_usuario'];

        if ($user->adicionarAlertas($user_id, $tipo_alerta, $mensagem)) {
            echo "<script>alert('Alerta adicionado com sucesso!');</script>";
        } else {
            echo "<script>alert('Erro ao adicionar alerta');</script>";
        }
    }
    if (isset($_POST['excluir'])) {
        $id = $_POST['id'];
        if ($user->excluirAlertas($id)) {
            echo "<script>alert('Sucesso ao remover alerta')</script>";
        } else {
            echo "<script>alert('Erro ao remover alerta')</script>";
        }
    }
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alertas</title>
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
    <!-- Modal para adicionar alerta -->
    <div id="modalAdd" class="modal">
        <div class="modal-content">
            <h3>Adicionar Alerta</h3>
            <form method="POST">
                <label>Tipo do alerta:</label><br>
                <select name="tipo_alerta" required>
                    <option value="Alerta">Alerta</option>
                    <option value="Comunicado">Comunicado</option>
                </select><br>
                <label>Mensagem:</label>
                <textarea name="mensagem" required></textarea>
                <button type="submit" name="adicionar" class="btn-salvar">Salvar</button>
                <button type="button" onclick="fecharModal()" class="btn-cancelar">Cancelar</button>
            </form>
        </div>
    </div>
    <main>
        <div class="flex-Alertas">
            <div class="alertas" style="display: flex; gap:0.7rem; align-items:center;">
                <p>Alertas</p>
                <button class="btn-add">
                    <img src="../assects/adicionar.png" alt="Adicionar">
                </button>
            </div>
            <div id="abaFiltro">
                <form method="GET">
                    <select name="filtro" id="filtro" onchange="this.form.submit()">
                        <option value="" selected>Filtros</option>
                        <option value="comunicados">Comunicados</option>
                        <option value="alertas">Alertas</option>
                        <option value="reset">Resetar</option>
                    </select>
                </form>
            </div>
        </div>
        <hr>
        <?php
        // Mostrando os dados do BD de alertas
        if ($filtro === "comunicados") {
            $sql = "SELECT * FROM alertas WHERE tipo_alerta = 'Comunicado'";
        } else if ($filtro === "alertas") {
            $sql = "SELECT * FROM alertas WHERE tipo_alerta = 'Alerta'";
        } else {
            $sql = "SELECT * FROM alertas";
        }
        $result = $conn->query($sql);
        $alertas = $result->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($alertas)) {
            foreach ($alertas as $row) {
                $tipo_alerta = htmlspecialchars($row['tipo_alerta']);
                $mensagem = htmlspecialchars($row['mensagem']);
                $id = htmlspecialchars($row['id_alerta']);
                $funcao = htmlspecialchars($currentUser['funcao']);
                echo "<div class='alerta-box'>
                        <div class='alerta-header'>
                            <span class='tipo-alerta $tipo_alerta'>$tipo_alerta</span>";
                // SÓ ADMIN VÊ O BOTÃO
                if ($funcao === 'Admin') {
                    echo "<form method='POST' class='form-excluir'>
                            <input type='hidden' name='id' value='$id'>
                            <button type='submit' name='excluir' class='btn-excluir'>
                                <img src='../assects/lixeira.png' alt='Excluir'>
                            </button>
                        </form>";
                }
                echo "</div>
                <p class='alerta-msg'>$mensagem</p>
            </div>
          <hr>";
            }
        } else {
            echo 'Nenhum alerta ou comunicado encontrado.';
        }
        ?>
    </main>
</body>

</html>