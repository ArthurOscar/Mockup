Create database TremVida;

Use TremVida;

CREATE TABLE Usuarios (
id_usuario INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
nome VARCHAR(100) NOT NULL,
email VARCHAR(250) NOT NULL UNIQUE,
senha VARCHAR(100) NOT NULL,
funcao ENUM('Admin','Funcionário') NOT NULL,
foto_perfil VARCHAR(255) DEFAULT('default.jpg')
);

CREATE TABLE Alertas (
id_alerta INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
tipo_alerta ENUM('Comunicado', 'Alerta') NOT NULL,
mensagem TEXT NOT NULL,
id_usuario INT NOT NULL,
data_envio DATETIME DEFAULT(CURRENT_TIMESTAMP) NOT NULL,
FOREIGN KEY (id_usuario) REFERENCES Usuarios(id_usuario)
);

CREATE TABLE Historico_sensores(
id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
topic VARCHAR(45) NOT NULL,
msg VARCHAR(45) NOT NULL,
time TIME NOT NULL,
date DATE DEFAULT (CURDATE())
);

ALTER TABLE usuarios ADD situacao ENUM('Ativo', 'Inativo') DEFAULT ('Ativo');