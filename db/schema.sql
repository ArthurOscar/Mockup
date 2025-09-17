Create database TremVida;

Use TremVida;

CREATE TABLE Trem (
id_trem INT PRIMARY KEY auto_increment,
modelo VARCHAR(50),
capacidade_passageiros INT,
capacidade_carga INT,
status VARCHAR(30)
);

alter table Trem
change capacidade_passageiros capacidade_passageiros_KG int;

alter table Trem
change capacidade_carga capacidade_carga_KG int;

CREATE TABLE Rota (
id_rota INT PRIMARY KEY auto_increment,
nome_rota VARCHAR(100),
origem VARCHAR(100),
destino VARCHAR(100)
);

CREATE TABLE Segmento (
id_segmento INT PRIMARY KEY auto_increment,
id_rota_segmento INT,
estacao_inicio VARCHAR(100),
estacao_fim VARCHAR(100),
ordem_segmento INT,
FOREIGN KEY (id_rota_segmento) REFERENCES Rota(id_rota)
);

CREATE TABLE Sensor (
id_sensor INT PRIMARY KEY auto_increment,
tipo_sensor VARCHAR(50),
localizacao VARCHAR(100),
id_segmento_sensor INT,
FOREIGN KEY (id_segmento_sensor) REFERENCES Segmento(id_segmento)
);

CREATE TABLE Leitura_Sensor (
id_leitura INT PRIMARY KEY auto_increment,
id_sensor_leitura INT,
timestamp DATETIME,
valor FLOAT,
FOREIGN KEY (id_sensor_leitura) REFERENCES Sensor(id_sensor)
);

CREATE TABLE Manutencao (
id_manutencao INT PRIMARY KEY auto_increment,
id_trem_manutencao INT,
tipo VARCHAR(50),
data_agendada DATE,
status VARCHAR(30),
observacao TEXT,
FOREIGN KEY (id_trem_manutencao) REFERENCES Trem(id_trem)
);

CREATE TABLE Ordem_Servico (
id_ordem INT PRIMARY KEY auto_increment,
id_manutencao_OS INT,
equipe_responsavel VARCHAR(100),
data_execucao DATE,
resultado TEXT,
FOREIGN KEY (id_manutencao_OS) REFERENCES Manutencao(id_manutencao)
);

CREATE TABLE Usuario (
id_usuario INT PRIMARY KEY,
nome VARCHAR(100),
perfil VARCHAR(30),
login VARCHAR(50),
senha VARCHAR(100)
);

CREATE TABLE Alerta (
id_alerta INT PRIMARY KEY,
tipo_alerta VARCHAR(50),
mensagem TEXT,
prioridade VARCHAR(20),
id_usuario_alerta INT,
data_envio DATETIME,
FOREIGN KEY (id_usuario_alerta) REFERENCES Usuario(id_usuario)
);

CREATE TABLE Analise (
id_analise INT PRIMARY KEY,
mes_referencia DATE,
eficiencia_energetica FLOAT,
pontualidade FLOAT,
custo_manutencao FLOAT
);