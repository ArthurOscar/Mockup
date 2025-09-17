<?php

$imgMenu1 = "../assects/menu_dashboard.png";
$imgMenu2 = "../assects/menu_dashboard2.png";
$menuAberto = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['menu'])) {
        $imgMenu2 = $_POST['menu'];
        $aux = $imgMenu2;
        $imgMenu2 = $imgMenu1;
        $imgMenu1 = $aux;
        $menu = $_POST['menu_lateral'];
        if (!$menuAberto) {
            $currentClasses[] = 'show';
            echo "<div id='menu_links'>
                <a href='../public/index_gestaoderotas.html'>Rotas</a>
                <a href='../public/index_manutencao.html'>Manutenção</a>
                <a href='../public/index_relatorios.html'>Relatórios</a>
                <a href='../public/index_alertas.html'>Alertas</a>
            </div>";
        } else {
            $currentClasses = array_diff($currentClasses, ['show']);
        };
        $menuAberto = !$menuAberto;
    };
};
