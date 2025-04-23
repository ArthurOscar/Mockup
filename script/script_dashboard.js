function togglePasswordVisibility() {
    let senha = document.getElementById("senha_login");
    if (senha.type === "password") {
      senha.type = "text";
    } else {
      senha.type = "password";
    }
}

let menu_botao = document.querySelector('#menu_botao')
let imagem_menu = document.querySelector('#imagem_menu')

function trocar_menu(){
    if(imagem_menu.scroll.match('off')){
        imagem_menu.src = '../assects/menu_dashboard.png'
        imagem_menu2.src = '../assects/menu_dashboard2.png'
    } else {
        imagem_menu.src = '../assects/menu_dashboard.png'
        imagem_menu2.src = '../assects/menu_dashboard2.png'
    }
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