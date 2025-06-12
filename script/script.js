/* Ver Senha */
function togglePasswordVisibility() {
    let senha = document.getElementById("senha_login");
    if (senha.type === "password") {
        senha.type = "text";
    } else {
        senha.type = "password";
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
        document.getElementById('imagem_menu').style.width = '70px'
        document.getElementById('imagem_menu').style.marginRight = '30px'
    } else {
        menu.classList.remove('show');
        document.getElementById('imagem_menu').style.width = '130px'
        document.getElementById('imagem_menu').style.marginRight = '0px'
    }
    menuAberto = !menuAberto;
}

/* Login */
const paginaLogin = window.location.pathname
const paginaLoginName = paginaLogin.substring(paginaLogin.lastIndexOf('/') + 1)

if (paginaLoginName === 'index_telaDeLogin.html') {
    function enviarDados() {
        const nomeUsuario = document.getElementById('usuario_login').value;
        localStorage.setItem('nomeUsuario', nomeUsuario);
        let validacao_login = true
        let usuario = document.getElementById('usuario_login').value
        let senha = document.getElementById('senha_login').value
        if (usuario != 'admin' || senha != 'admin' || usuario === '' || senha === '') {
            alert('Insira corretamento os campos de login')
            validacao_login = false
        }
        if (validacao_login === true) {
            window.location.href = '../public/index_gestaoderotas.html'
        }
    }
}


/* Rotas */
const paginaRotas = window.location.pathname
const paginaRotasName = paginaRotas.substring(paginaRotas.lastIndexOf('/') + 1)

if (paginaRotasName === 'index_gestaoderotas.html') {
    let imgFerrovia1 = "../assects/seta_ferrovia.png"
    let imgFerrovia2 = "../assects/seta_ferrovia2.png"
    let ferroviaAberto = false

    function ferrovia() {
        let menu_rotas = document.getElementById('ferrovia_Aberto')
        let seta = document.getElementById('seta')
        if (!ferroviaAberto) {
            document.getElementById('menu_rotas').style.fontSize = '20px'
            document.getElementById('menu_rotas').style.height = '11rem'
            document.getElementById('menu_rotas').style.justifyContent = 'top'
            document.querySelector('#numero').style.padding = '5px'
            document.getElementById('mapa_ferrovia').style.padding = '5px'
            document.getElementById('mapa_ferrovia').style.width = '10rem'
            document.getElementById('mapa_ferrovia').style.height = '120px'
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

if (paginaManutencaoName === 'index_manutencao.html') {
    let imgFerrovia1 = "../assects/seta_ferrovia.png"
    let imgFerrovia2 = "../assects/seta_ferrovia2.png"
    let ferroviaAberto = false

    function ferrovia() {
        let menu_rotas = document.getElementById('ferrovia_Aberto')
        let seta = document.getElementById('seta')
        if (!ferroviaAberto) {
            document.getElementById('menu_rotas').style.fontSize = '20px'
            document.getElementById('menu_rotas').style.height = '5%'
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

if (paginaRelatoriosName === 'index_relatorios.html') {
    let imgFerrovia1 = "../assects/seta_ferrovia.png"
    let imgFerrovia2 = "../assects/seta_ferrovia2.png"
    let ferroviaAberto = false

    function ferrovia() {
        let seta = document.getElementById('seta')
        if (!ferroviaAberto) {
            document.getElementById('menu_rotas').style.fontSize = '20px'
            document.getElementById('menu_rotas').style.height = '26rem'
            document.getElementById('menu_rotas').style.justifyContent = 'top'
            document.getElementById('numero').style.padding = '5px'
            document.getElementById('numero').style.width = '9.2rem'
            document.getElementById('numero-0101').style.padding = '5px'
            document.getElementById('numero-0101').style.width = '4rem'
            document.getElementById('numero-0101_2').style.padding = '5px'
            document.getElementById('numero-0101_2').style.width = '4rem'
            document.getElementById('numero-titulo').style.padding = '5px'
            document.getElementById('numero-titulo').style.width = '8rem'
            document.getElementById('mapa_ferrovia').style.padding = '5px'
            document.getElementById('mapa_ferrovia').style.width = '10rem'
            document.getElementById('mapa_ferrovia').style.height = '120px'
            document.getElementById('mapa_ferrovia-2').style.padding = '5px'
            document.getElementById('mapa_ferrovia-2').style.width = '10rem'
            document.getElementById('mapa_ferrovia-2').style.height = '120px'
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

/* Recuperar Senha */
const paginaSenha = window.location.pathname
const paginaSenhaName = paginaSenha.substring(paginaSenha.lastIndexOf('/') + 1)

if (paginaSenhaName === 'recuperar_senha.html') {
    window.onload = () => {
        document.getElementById('enviarDados').style.width = '80%'
    }
    function recuperarSenha() {
        user = document.getElementById('user').value
        if (user === '') {
            alert('Inseria o campo corretamente')
        } else {
            window.location.href = 'index_telaDeLogin.html'
        }
    }
}