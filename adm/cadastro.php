<?php

class User
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function register($username, $email, $password)
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (:username , :email, :password)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hash);
        return $stmt->execute();
    }
}

$mysqli = new mysqli("localhost", "root", "root", "banco_sa");
if ($mysqli->connect_errno) {
    die("Erro de conexão: " . $mysqli->connect_error);
}

session_start();

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit;
}

$register_msg = "";
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['register'])) {
    $new_user = $_POST['new_username'] ?? "";
    $new_pass = $_POST['new_password'] ?? "";
    $new_func = $_POST['new_func'] ?? "";
    $new_email = $_POST['new_email'] ?? "";
    if ($new_user && $new_pass) {
        $hashed_pass = password_hash($new_pass, PASSWORD_DEFAULT);
        $stmt = $mysqli->prepare("INSERT INTO usuario (username, senha, cargo, email) VALUES (?,?,?,?)");
        $stmt->bind_param("ssss", $new_user, $hashed_pass, $new_func, $new_email);
        if ($stmt->execute()) {
            $register_msg = "Usuário cadastrado com sucesso!";
        } else {
            $register_msg = "Erro ao cadastrar novo usuário.";
        };

        $stmt->close();
    } else {
        $register = "Preencha todos os campos.";
    };
};

?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Cadastro de Novo Usuário do Sistema</title>
</head>

<body>
    <div class="card">
        <form method="post">
            <h2>
                Bem-vindo,
                <?= isset($_SESSION["username"]) ? htmlspecialchars($_SESSION["username"]) : "Visitante" ?>!
            </h2>
            <h3>Cadastro Novo Usuário</h3>
            <?php if ($register_msg):  ?> <p> <?= $register_msg ?> </p> <?php endif; ?>
            <input type="text" name="new_username" placeholder="Nome Usuário" required>
            <br>
            <br>
            <input type="password" name="new_password" placeholder="Senha" required>
            <br>
            <br>
            <input type="email" name="new_email" placeholder="Email do usuario" required>
            <br>
            <br>
            <div class="sele">
                <select name="new_func">
                    <option value="adm">ADM</option>
                    <option value="funcionário">Funcionário</option>
                </select>
            </div>
            <br>
            <br>
            <button type="submit" name="register" value="1"> Cadastrar</button>
            <br>
            <div class="forgot-adm">
                <a href="editar.php">Editar usuario</a>
            </div>
            <button type="submit" name="Sair" value="1"> voltar</button>

        </form>
    </div>
</body>

</html>