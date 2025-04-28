function togglePasswordVisibility() {
    let senha = document.getElementById("senha_login");
    if (senha.type === "password") {
      senha.type = "text";
    } else {
      senha.type = "password";
    }
}

function reload(){
    location.reload()
}

var imgMenu1 = "../assects/menu_dashboard.png"
var imgMenu2 = "../assects/menu_dashboard2.png"
var menuAberto = false;

function trocar_menu(){
    document.getElementById('imagem_menu').src = imgMenu2;
    let aux = imgMenu2;
    imgMenu2 = imgMenu1;
    imgMenu1 = aux;
    let menu = document.getElementById('menu_lateral');
    if (!menuAberto) {
        menu.classList.add('show');
    } else {
        menu.classList.remove('show');
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
        window.location.href='https://vale.com/pt/trem-de-passageiros'
    }
}