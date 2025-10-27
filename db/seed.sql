Use TremVida;

INSERT INTO Sensores (tipo_sensor, localizacao, valor) VALUES
('Temperatura', 'S1', 15),
('Umidade', 'S1', 12),
('Luminosidade', 'S1', 5756),
('Presença', 'S1', 20),
('Presença', 'S2', 20),
('Presença', 'S2', 20),
('Presença', 'S3', 20);

INSERT INTO Usuarios (nome, email, senha, funcao) VALUES
('admin', 'admin@email.com', 'senha123', 'admin');

INSERT INTO Alertas (tipo_alerta, mensagem, prioridade, id_usuario_alerta, data_envio) VALUES
('Segurança', 'Sensor de vibração acima do limite seguro.', 'Alta', 1, '2025-09-23 14:00:00'),
('Operacional', 'Atraso detectado na Linha Sul.', 'Média', 1, '2025-09-23 15:30:00'),
('Informativo', 'Relatório de eficiência disponível.', 'Baixa', 1, '2025-09-23 16:00:00');