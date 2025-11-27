<?php
include '../includes/db.php';
include '../src/user.php';
include '../src/auth.php';

session_start();
$auth = new Auth();
$user = new User($conn);

if (!$auth->isLoggedIn()) {
    header("location: index.php");
    exit();
}

$user = new User($conn);
$currentUser = $user->getUserById($_SESSION['user_id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['enviar'])) {
        if (empty($_FILES['foto_perfil']['tmp_name'])) {
            echo "<script>alert('Selecione uma foto.')</script>";
        } else {
            $target_dir = '../uploads/';
            $target_file = $target_dir . basename($_FILES['foto_perfil']['name']);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            $check = getimagesize($_FILES['foto_perfil']['tmp_name']);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                echo "O arquivo não é uma imagem.";
                $uploadOk = 0;
            }

            if ($_FILES['foto_perfil']['size'] > 500000) {
                echo "Imagem muito pesada para o sistema";
                $uplaodOk = 0;
            }

            if ($uploadOk == 0) {
                echo "Desculpe seu arquivo não foi enviado.";
            } else {
                if (move_uploaded_file($_FILES['foto_perfil']["tmp_name"], $target_file)) {
                    $user->updateProfilePic($_SESSION['user_id'], basename($_FILES['foto_perfil']['name']));
                    header("location: index_dashboard.php");
                }
            }
        }
    } else if (isset($_POST['excluir'])) {
        $user->updateProfilePic($_SESSION['user_id'], "default.jpg");
        header("location: index_perfil.php");
    }
}

echo "<link rel='stylesheet' href='../style/style.css'>";

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de foto</title>
    <link rel="shortcut icon" type="image/ico" href="../assects/tremvida.png">
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
    <main class="perfil-container">
        <h2>Alterar foto de perfil:</h2><br>
        <form action="upload_foto.php" method="POST" enctype="multipart/form-data" id="upload_foto_container">
            <input type="file" class="foto" name="foto_perfil" accept="image/*"><br><br>
            <div style="display: flex; justify-content: space-between;">
                <button class="foto" type="submit" style="max-width: 40%; border: none;" name="enviar">Enviar Foto</button><br><br>
                <button class="foto" type="submit" style="max-width: 40%; border: none;" name="excluir">Excluir Foto</button>
            </div>
        </form>
    </main>
</body>

</html>