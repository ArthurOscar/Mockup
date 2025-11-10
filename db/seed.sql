Use TremVida;

INSERT INTO Usuarios (nome, email, senha, funcao) VALUES
('admin', 'admin@email.com', '$2y$10$s8V0x/AaK03bUvGBZKhqWeUEOUZcmWEcynyC5xZa.f92iZ3oJD1C2', 'admin');

INSERT INTO Alertas (tipo_alerta, mensagem, prioridade, id_usuario_alerta, data_envio) VALUES
('Segurança', 'Sensor de vibração acima do limite seguro.', 'Alta', 1, '2025-09-23 14:00:00'),
('Operacional', 'Atraso detectado na Linha Sul.', 'Média', 1, '2025-09-23 15:30:00'),
('Informativo', 'Relatório de eficiência disponível.', 'Baixa', 1, '2025-09-23 16:00:00');