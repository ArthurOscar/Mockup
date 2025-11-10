/* Ver Senha */
function togglePasswordVisibility() {
    let senha = document.getElementById("senha_login");
    let olho = document.getElementById("olho_img");
    if (senha.type === "password") {
        senha.type = "text";
        olho.src = '../assects/close-eye.png';
    } else {
        senha.type = "password";
        olho.src = '../assects/show.png';
    }
}


/* Reload Página */
function reload() {
    location.reload()
}

/* Menu */
let imgMenu1 = "../assects/menu_dashboard.png"
let imgMenu2 = "../assects/menu_dashboard2.png"
let menuAberto = false;

function trocar_menu() {
    document.getElementById('imagem_menu').src = imgMenu2;
    let aux = imgMenu2;
    imgMenu2 = imgMenu1;
    imgMenu1 = aux;
    let menu = document.getElementById('menu_lateral');
    if (!menuAberto) {
        menu.classList.add('show');
        // Ajustes para mobile
        if (window.innerWidth <= 480) {
            document.getElementById('imagem_menu').style.width = '100px';
            document.getElementById('imagem_menu').style.marginRight = '0px';
        } else {
            document.getElementById('imagem_menu').style.width = '100px';
            document.getElementById('imagem_menu').style.marginRight = '10px';
        }
    } else {
        menu.classList.remove('show');
        // Ajustes para mobile
        if (window.innerWidth <= 480) {
            document.getElementById('imagem_menu').style.width = '100px';
        } else {
            document.getElementById('imagem_menu').style.width = '100px';
        }
        document.getElementById('imagem_menu').style.marginRight = '0px';
    }
    menuAberto = !menuAberto;
}

// Fechar menu ao clicar em um link (mobile)
document.addEventListener('DOMContentLoaded', function () {
    const menuLinks = document.querySelectorAll('#menu_links a');
    menuLinks.forEach(link => {
        link.addEventListener('click', function () {
            if (window.innerWidth <= 768) {
                trocar_menu();
            }
        });
    });
});

/* Rotas */
const paginaRotas = window.location.pathname
const paginaRotasName = paginaRotas.substring(paginaRotas.lastIndexOf('/') + 1)

if (paginaRotasName === 'index_gestaoderotas.php') {
    let imgFerrovia1 = "../assects/seta_ferrovia.png"
    let imgFerrovia2 = "../assects/seta_ferrovia2.png"
    let ferroviaAberto = false

    function ferrovia() {
        let menu_rotas = document.getElementById('ferrovia_Aberto')
        let seta = document.getElementById('seta')
        if (!ferroviaAberto) {
            document.getElementById('menu_rotas').style.fontSize = '1rem'
            document.getElementById('menu_rotas').style.height = 'auto'
            document.getElementById('menu_rotas').style.justifyContent = 'top'
            document.querySelector('#numero').style.padding = '5px'
            document.getElementById('mapa_ferrovia').style.padding = '5px'
            document.getElementById('mapa_ferrovia').style.width = '100%'
            document.getElementById('mapa_ferrovia').style.maxWidth = '10rem'
            document.getElementById('mapa_ferrovia').style.height = 'auto'
            seta.src = imgFerrovia2
        } else {
            document.getElementById('menu_rotas').style.height = '0px'
            document.getElementById('menu_rotas').style.fontSize = '0'
            document.querySelector('#numero').style.padding = '0'
            document.getElementById('mapa_ferrovia').style.padding = '0'
            document.getElementById('mapa_ferrovia').style.width = '0'
            document.getElementById('mapa_ferrovia').style.height = '0'
            seta.src = imgFerrovia1
        }
        ferroviaAberto = !ferroviaAberto;
    }

    window.onload = () => {
        ferroviaAberto = false;
        document.querySelector('#numero').style.padding = '0'
        document.getElementById('ferrovia_Aberto').style.fontSize = '0'
        document.getElementById('menu_rotas').style.height = '0px'
        document.getElementById('mapa_ferrovia').style.width = '0px'
        document.getElementById('mapa_ferrovia').style.height = '0px'
        document.getElementById('mapa_ferrovia').style.padding = '0px'
        document.getElementById('seta').src = imgFerrovia1;
        const nomeUsuario = localStorage.getItem('nomeUsuario');
        if (nomeUsuario) {
            document.getElementById('saudacao').innerHTML = `<p id='saudacao'>Olá, ${nomeUsuario.toUpperCase()}!</p>`;
        };
    }
}


/* Manutenção */
const paginaManutencao = window.location.pathname
const paginaManutencaoName = paginaManutencao.substring(paginaManutencao.lastIndexOf('/') + 1)

if (paginaManutencaoName === 'index_manutencao.php') {
    let imgFerrovia1 = "../assects/seta_ferrovia.png"
    let imgFerrovia2 = "../assects/seta_ferrovia2.png"
    let ferroviaAberto = false

    function ferrovia() {
        let menu_rotas = document.getElementById('ferrovia_Aberto')
        let seta = document.getElementById('seta')
        if (!ferroviaAberto) {
            document.getElementById('menu_rotas').style.fontSize = '1rem'
            document.getElementById('menu_rotas').style.height = 'auto'
            document.getElementById('menu_rotas').style.justifyContent = 'top'
            document.querySelector('#numero').style.padding = '5px'
            seta.src = imgFerrovia2
        } else {
            document.getElementById('menu_rotas').style.height = '0px'
            document.getElementById('menu_rotas').style.fontSize = '0'
            document.querySelector('#numero').style.padding = '0'
            seta.src = imgFerrovia1
        }
        ferroviaAberto = !ferroviaAberto;
    }
    window.onload = () => {
        ferroviaAberto = false;
        document.querySelector('#numero').style.padding = '0'
        document.getElementById('ferrovia_Aberto').style.fontSize = '0'
        document.getElementById('menu_rotas').style.height = '0px'
        document.getElementById('seta').src = imgFerrovia1;
    };
}


/* Relatórios */
const paginaRelatorios = window.location.pathname
const paginaRelatoriosName = paginaRelatorios.substring(paginaRelatorios.lastIndexOf('/') + 1)

if (paginaRelatoriosName === 'index_relatorios.php') {
    let imgFerrovia1 = "../assects/seta_ferrovia.png"
    let imgFerrovia2 = "../assects/seta_ferrovia2.png"
    let ferroviaAberto = false

    function ferrovia() {
        let seta = document.getElementById('seta')
        if (!ferroviaAberto) {
            document.getElementById('menu_rotas').style.fontSize = '1rem'
            document.getElementById('menu_rotas').style.height = 'auto'
            document.getElementById('menu_rotas').style.justifyContent = 'top'
            document.getElementById('numero').style.padding = '5px'
            document.getElementById('numero').style.width = 'auto'
            document.getElementById('numero-0101').style.padding = '5px'
            document.getElementById('numero-0101').style.width = 'auto'
            document.getElementById('numero-0101_2').style.padding = '5px'
            document.getElementById('numero-0101_2').style.width = 'auto'
            document.getElementById('numero-titulo').style.padding = '5px'
            document.getElementById('numero-titulo').style.width = 'auto'
            document.getElementById('mapa_ferrovia').style.padding = '5px'
            document.getElementById('mapa_ferrovia').style.width = '100%'
            document.getElementById('mapa_ferrovia').style.maxWidth = '10rem'
            document.getElementById('mapa_ferrovia').style.height = 'auto'
            document.getElementById('mapa_ferrovia-2').style.padding = '5px'
            document.getElementById('mapa_ferrovia-2').style.width = '100%'
            document.getElementById('mapa_ferrovia-2').style.maxWidth = '10rem'
            document.getElementById('mapa_ferrovia-2').style.height = 'auto'
            seta.src = imgFerrovia2
        } else {
            document.getElementById('menu_rotas').style.height = '0px'
            document.getElementById('menu_rotas').style.fontSize = '0'
            document.getElementById('numero').style.padding = '0'
            document.getElementById('numero').style.width = '0'
            document.getElementById('numero-0101').style.padding = '0'
            document.getElementById('numero-0101').style.width = '0'
            document.getElementById('numero-0101_2').style.padding = '0'
            document.getElementById('numero-0101_2').style.width = '0'
            document.getElementById('numero-titulo').style.padding = '0'
            document.getElementById('numero-titulo').style.width = '0'
            document.getElementById('mapa_ferrovia').style.padding = '0'
            document.getElementById('mapa_ferrovia').style.width = '0'
            document.getElementById('mapa_ferrovia').style.height = '0'
            document.getElementById('mapa_ferrovia-2').style.padding = '0'
            document.getElementById('mapa_ferrovia-2').style.width = '0'
            document.getElementById('mapa_ferrovia-2').style.height = '0'
            seta.src = imgFerrovia1
        }
        ferroviaAberto = !ferroviaAberto;
    }

    window.onload = () => {
        ferroviaAberto = false;
        document.getElementById('numero').style.padding = '0px'
        document.getElementById('numero').style.width = '0px'
        document.getElementById('numero-titulo').style.padding = '0'
        document.getElementById('numero-titulo').style.width = '0'
        document.getElementById('numero-0101').style.padding = '0'
        document.getElementById('numero-0101').style.width = '0'
        document.getElementById('numero-0101_2').style.padding = '0'
        document.getElementById('numero-0101_2').style.width = '0'
        document.getElementById('ferrovia_Aberto').style.fontSize = '0'
        document.getElementById('menu_rotas').style.height = '0px'
        document.getElementById('mapa_ferrovia').style.width = '0px'
        document.getElementById('mapa_ferrovia').style.height = '0px'
        document.getElementById('mapa_ferrovia').style.padding = '0px'
        document.getElementById('mapa_ferrovia-2').style.padding = '0'
        document.getElementById('mapa_ferrovia-2').style.width = '0'
        document.getElementById('mapa_ferrovia-2').style.height = '0'
        document.getElementById('seta').src = imgFerrovia1;
    };
}

// Redimensionamento da janela
window.addEventListener('resize', function () {
    // Fechar menu lateral se a tela for redimensionada para um tamanho maior
    if (window.innerWidth > 768 && menuAberto) {
        trocar_menu();
    }
});