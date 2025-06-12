function togglePasswordVisibility() {
    let senha = document.getElementById("senha_login");
    if (senha.type === "password") {
        senha.type = "text";
    } else {
        senha.type = "password";
    }
}

function reload() {
    location.reload()
}

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

function enviarDados() {
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
    };
}

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
            window.location.href='index_telaDeLogin.html'
        }
    }
}