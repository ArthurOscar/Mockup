Create database TremVida;

Use TremVida;

CREATE TABLE Sensores (
id_sensor INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
tipo_sensor VARCHAR(100) NOT NULL,
localizacao VARCHAR(100),
valor FLOAT
);

CREATE TABLE Usuarios (
id_usuario INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
nome VARCHAR(100) NOT NULL,
email VARCHAR(250) NOT NULL UNIQUE,
senha VARCHAR(100) NOT NULL,
funcao ENUM('Admin','Funcionário'),
foto_perfil VARCHAR(255) DEFAULT('default.jpg')
);

CREATE TABLE Alertas (
id_alerta INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
tipo_alerta VARCHAR(50),
mensagem TEXT,
prioridade VARCHAR(20),
id_usuario_alerta INT,
data_envio DATETIME,
FOREIGN KEY (id_usuario_alerta) REFERENCES Usuarios(id_usuario)
);