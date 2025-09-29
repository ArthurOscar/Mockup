<?php
include '../includes/db.php';
include '../src/user.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header("location: login.php");
    exit();
}

$user = new User($conn);
$currentUser = $user->getUserById($_SESSION['user_id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['foto_perfil'])) {
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

echo "<link rel='stylesheet' href='../style/style.css'>";

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de foto</title>
    <link rel="shortcut icon" type="image/ico" href="../assects/foto.png">
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
    <main class="perfil-container">
        <h2>Alterar foto de perfil:</h2><br>
        <form action="upload_foto.php" method="POST" enctype="multipart/form-data">
            <input type="file" class="foto" name="foto_perfil" accept="image/*" required><br><br>
            <button class="foto" type="submit">Enviar Foto</button><br><br
        </form>
        <a class="foto" href="index_dashboard.php">Voltar</a>
    </main>
</body>

</html>