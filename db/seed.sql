Use TremVida;

INSERT INTO Sensores (tipo_sensor, localizacao) VALUES
('Temperatura', 'Estação Central'),
('Vibração', 'Ponte Rio Azul'),
('Velocidade', 'Túnel Leste');

INSERT INTO Leitura_Sensores (id_sensor_leitura, timestamp, valor) VALUES
(1, '2025-09-24 08:00:00', 28.5),
(2, '2025-09-24 08:05:00', 0.75),
(3, '2025-09-24 08:10:00', 82.3);

INSERT INTO Ordem_Servicos (equipe_responsavel, data_execucao, resultado) VALUES
('Equipe Norte', '2025-09-20', 1),
('Equipe Mecânica', '2025-09-21', 0),
('Equipe Elétrica', '2025-09-22', 0);

INSERT INTO Usuarios (nome, email, senha, funcao) VALUES
('João Silva', 'joao.silva@email.com', '$2y$10$sUBsgNUpFlInCZYnDcAv8OmTpKjdBI6EPH2RwJ/6rAvuECzKYaQOm', 'Admin'),
('Maria Oliveira', 'maria.oliveira@email.com', '$2y$10$YpjY0YgVnZ1658m09oXB5.zx0RDPltW3dy4ZGCWGvAzbhHgZ3dLiC', 'Funcionário'),
('Carlos Souza', 'carlos.souza@email.com', '$2y$10$QLPOKjTL9O9.sFuVDbSdSucqHxB6wlcl/Eg3D99qKg9q3GMTMqoiy', 'Admin');

INSERT INTO Alertas (tipo_alerta, mensagem, prioridade, id_usuario_alerta, data_envio) VALUES
('Segurança', 'Sensor de vibração acima do limite seguro.', 'Alta', 2, '2025-09-23 14:00:00'),
('Operacional', 'Atraso detectado na Linha Sul.', 'Média', 1, '2025-09-23 15:30:00'),
('Informativo', 'Relatório de eficiência disponível.', 'Baixa', 3, '2025-09-23 16:00:00');

INSERT INTO Analises (mes_referencia, eficiencia_energetica, pontualidade, custo_manutencao) VALUES
('2025-08-01', 92.5, 87.3, 15000.00),
('2025-07-01', 90.0, 85.0, 17500.00),
('2025-06-01', 88.7, 82.5, 16000.00);