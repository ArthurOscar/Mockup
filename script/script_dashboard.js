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

    document.getElementById('olho').addEventListener('touchstart', function () {
        document.getElementById('senha_login').type = 'text';
    });

    document.getElementById('olho').addEventListener('mouseup', function () {
        document.getElementById('senha_login').type = 'password';
    });

    if (validacao_login === true) {
        console.log('Validação feita')
        window.location.href='https://vale.com/pt/trem-de-passageiros'
    }
}