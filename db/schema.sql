Create database TremVida;

Use TremVida;

CREATE TABLE Sensores (
id_sensor INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
tipo_sensor VARCHAR(100) NOT NULL,
localizacao VARCHAR(100)
);

CREATE TABLE Leitura_Sensores (
id_leitura INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
id_sensor_leitura INT,
timestamp DATETIME,
valor FLOAT,
FOREIGN KEY (id_sensor_leitura) REFERENCES Sensores(id_sensor)
);

CREATE TABLE Ordem_Servicos (
id_ordem INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
equipe_responsavel VARCHAR(100),
data_execucao DATE,
resultado BOOLEAN NOT NULL
);

CREATE TABLE Usuarios (
id_usuario INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
nome VARCHAR(100) NOT NULL,
email VARCHAR(250) NOT NULL UNIQUE,
senha VARCHAR(100) NOT NULL,
data_nascimento DATE NOT NULL,
descricao VARCHAR(255) NOT NULL
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

CREATE TABLE Analises (
id_analise INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
mes_referencia DATE,
eficiencia_energetica FLOAT,
pontualidade FLOAT,
custo_manutencao FLOAT
);