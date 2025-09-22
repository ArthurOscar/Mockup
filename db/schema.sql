Create database TremVida;

Use TremVida;

CREATE TABLE Sensor (
id_sensor INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
tipo_sensor VARCHAR(50),
localizacao VARCHAR(100),
id_segmento_sensor INT,
FOREIGN KEY (id_segmento_sensor) REFERENCES Segmento(id_segmento)
);

CREATE TABLE Leitura_Sensor (
id_leitura INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
id_sensor_leitura INT,
timestamp DATETIME,
valor FLOAT,
FOREIGN KEY (id_sensor_leitura) REFERENCES Sensor(id_sensor)
);

CREATE TABLE Ordem_Servico (
id_ordem INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
id_manutencao_OS INT,
equipe_responsavel VARCHAR(100),
data_execucao DATE,
resultado TEXT,
FOREIGN KEY (id_manutencao_OS) REFERENCES Manutencao(id_manutencao)
);

CREATE TABLE Usuario (
id_usuario INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
nome VARCHAR(100) NOT NULL,
email VARCHAR(250) NOT NULL UNIQUE,
senha VARCHAR(100) NOT NULL
);

CREATE TABLE Alerta (
id_alerta INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
tipo_alerta VARCHAR(50),
mensagem TEXT,
prioridade VARCHAR(20),
id_usuario_alerta INT,
data_envio DATETIME,
FOREIGN KEY (id_usuario_alerta) REFERENCES Usuario(id_usuario)
);

CREATE TABLE Analise (
id_analise INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
mes_referencia DATE,
eficiencia_energetica FLOAT,
pontualidade FLOAT,
custo_manutencao FLOAT
);