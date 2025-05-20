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
    if (usuario === '') {
        alert('Insira seu usuário')
        validacao_login = false
    } if (senha === '') {
        alert('Insira sua senha')
        validacao_login = false
    }


    if (validacao_login === true) {
        console.log('Validação feita')
        window.location.href = 'https://vale.com/pt/trem-de-passageiros'
    }
}

let imgFerrovia1 = "../assects/seta_ferrovia.png"
let imgFerrovia2 = "../assects/seta_ferrovia2.png"
let ferroviaAberto = false

function ferroviaSul() {
    let menu_rotas = document.getElementById('ferrovia_Aberto')
    let seta = document.getElementById('seta_sul')
    if (!ferroviaAberto) {
        document.getElementById('menu_rotas').style.fontSize = '20px'
        document.getElementById('menu_rotas').style.height = '100px'
        document.getElementById('menu_rotas').style.justifyContent = 'top'
        document.querySelector('#numero').style.padding = '5px'
        document.querySelector('#numero2').style.padding = '5px'
        document.querySelector('#numero3').style.padding = '5px'
        seta.src = imgFerrovia2
    } else {
        document.getElementById('menu_rotas').style.height = '0px'
        document.getElementById('menu_rotas').style.fontSize = '0'
        document.querySelector('#numero').style.padding = '0'
        document.querySelector('#numero2').style.padding = '0'
        document.querySelector('#numero3').style.padding = '0'
        seta.src = imgFerrovia1
    }
    ferroviaAberto = !ferroviaAberto;
}

window.onload = () => {
    ferroviaAberto = false;
    document.querySelector('#numero').style.padding = '0';
    document.querySelector('#numero2').style.padding = '0';
    document.querySelector('#numero3').style.padding = '0';
    document.getElementById('ferrovia_Aberto').style.fontSize = '0';
    document.getElementById('menu_rotas').style.height = '0px';
    document.getElementById('seta_sul').src = imgFerrovia1;
};

let imgMapa1 = "../assects/Mapa.png"
let imgMapa2 = "../assects/MapaFerroviaSul.png"
let mapaAberto = false
function mapaSul() {
    let mapa_sul = document.querySelector('.mapa')
    let mapa = document.getElementById('mapa')
    if (!mapaAberto) {
        mapa.src = imgMapa2
    } else {
        mapa.src = imgMapa1
    }
    mapaAberto = !mapaAberto
}

function redirecionarMapa(elemento) {
    let valorRota = elemento.getAttribute('data-valor')
    if (valorRota = '0101'){
        window.location.href = '../public/index_mapaAberto0101.html'
    } if (valorRota = '0102'){
        window.location.href = '../public/index_mapaAberto0102.html'
    } if (valorRota = '0103'){
        window.location.href = '../public/index_mapaAberto0103.html'
    }
}
