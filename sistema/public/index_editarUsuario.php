<?php

include '../includes/db.php';
include '../src/auth.php';
include '../src/user.php';
include '../src/apiEmail.php';
include '../src/list.php';

session_start();
$user = new User($conn);
$auth = new Auth();
$list = new DataList($conn);
$currentUser = $user->getUserById($_SESSION['user_id']);
$verifyEmail = new Email();

if (!$auth->isLoggedIn()) {
    header("location: index.php");
    exit();
}

if ($currentUser["funcao"] === "Funcionário") {
    header("location: index_dashboard.php");
    exit();
}

$id = $_GET['id'] ?? null;

if (!$id) {
    die("ID inválido.");
}

$rows = $list->listarValoresUser($id);
$nome = htmlspecialchars($rows['nome']);
$email = htmlspecialchars($rows['email']);
$funcao = htmlspecialchars($rows['funcao']);
$situacao = htmlspecialchars($rows['situacao']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['nome'] == "" || $_POST['email'] == "") {
        echo "<script>alert('Preencha todos os campos!')</script>";
        header("Refresh:0");
        exit();
    } else if ($verifyEmail->EmailVerify($_POST['email']) == false) {
        echo "<script>alert('Email inválido!')</script>";
        header("Refresh:0");
        exit();
    }
    // Edita o usuário
    $user->edit($id, $_POST['nome'], $_POST['email'], $_POST['senha'], $_POST['funcao'], $_POST['situacao']);
    echo "<script>alert('Usuário editado com sucesso!'); window.location.href = 'index_dashboard.php';</script>";
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
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
    </nav>
    <br>
    <main class="loginMain">
        <div class="login">
            <form method="POST">
                <strong id="texto_login">Editar:</strong><br>
                <input type="text" id="input_login" name="nome" maxlength="100" value="<?php echo $nome ?>">
                <input type="text" id="input_login" name="email" maxlength="250" value="<?php echo $email ?>">
                <div class="senha">
                    <input type="password" maxlength="100" id="senha_login" name="senha" placeholder="Senha">
                    <button type="button" id="olho" onclick="togglePasswordVisibility()"><img id="olho_img"
                            src="../assects/show.png"></button>
                </div>
                <select name="funcao" id="input_login" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-weight: bold;">
                    <option value="Admin" <?= $funcao === "Admin" ? "selected" : "" ?>>Admin</option>
                    <option value="Funcionário" <?= $funcao === "Funcionário" ? "selected" : "" ?>>Funcionário</option>
                </select>
                <select name="situacao" id="input_login" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-weight: bold;">
                    <option value="Ativo" <?= $situacao === "Ativo" ? "selected" : "" ?>>Ativo</option>
                    <option value="Inativo" <?= $situacao === "Inativo" ? "selected" : "" ?>>Inativo</option>
                </select>
                <button type="submit" id="enviarDados">Editar</button><br>
                <a href="index_gerenciamento.php" id="voltarGeren">Cancelar</a>
            </form>
        </div>
        <link rel="stylesheet" href="../style/style.css">
    </main>
</body>

</html>