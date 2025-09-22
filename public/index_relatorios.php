<?php

include '../db.php';
session_start();

if(!isset($_SESSION['logado'])){
    session_destroy();
    header("Location: index.php");
    exit;
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatórios</title>
    <link rel="stylesheet" href="../style/style.css">
    <script src="../script/script.js"></script>
</head>

<body>
    <nav class="navbar">
        <div class="logo">
            <img src="../assects/Logo_dashboard.png" onclick="reload()">
        </div>
        <div class="menu_dashboard">
            <img id="imagem_menu" onclick="trocar_menu()" src="../assects/menu_dashboard.png">
        </div>
    </nav>
    <div id="menu_lateral" class="menu_lateral">
        <div id="menu_links">
            <a href="../public/index_gestaoderotas.php">Rotas</a>
            <a href="../public/index_manutencao.php">Manutenção</a>
            <a href="../public/index_relatorios.php">Relatórios</a>
            <a href="../public/index_alertas.php">Alertas</a>
        </div>
    </div>
    <main>
        <div class="relatorios">
            <p>Relatórios</p>
        </div>
        <hr>
        <div id="ferrovias">
            <div id="ferrovia" onclick="ferrovia()">
                <img id="seta" src="../assects/seta_ferrovia.png" alt="">
                <p>Ferrovia</p>
            </div>
            <div id="ferrovia_Aberto" class="ferrovia_Aberto">
                <div id="menu_rotas">

                    <!-- Temperatura -->
                    <div id="numero">
                        <p>Temperatura</p>
                    </div>
                    <div class="rota">
                        <p id="numero-0101">0101</p>
                        <p id="rota_texto">Sul / Centro</p>
                    </div>
                    <div id="mapaStyle">
                        <img id="mapa_ferrovia"
                            src="https://ensinarhoje.com/wp-content/uploads/2020/08/Atividade-matematica-grafico-de-colunas-com-temperatura-4o-ano-bncc.png"
                            alt="">
                        <div>
                            <p>Temperatura Máxima: <strong>105º</strong></p>
                        </div>
                    </div>

                    <!-- Velocidade -->
                    <div id="numero-titulo">
                        <p>Velocidade</p>
                    </div>
                    <div class="rota">
                        <p id="numero-0101_2">0101</p>
                        <p id="rota_texto">Sul / Centro</p>
                    </div>
                    <div id="mapaStyle">
                        <img id="mapa_ferrovia-2"
                            src="https://cdn.venngage.com/template/thumbnail/small/0ef10518-4bb0-4f23-a147-61b86f7929d0.webp"
                            alt="">
                            <div>
                                <p>Velocidade Média: <strong>36km/H</strong></p>
                            </div>
                    </div>
                </div>
                <hr>
            </div>
        </div>
    </main>
</body>

</html>