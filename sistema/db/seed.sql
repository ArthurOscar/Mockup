Use TremVida;

INSERT INTO Usuarios (nome, email, senha, funcao) VALUES
('admin', 'admin@email.com', '$2y$10$s8V0x/AaK03bUvGBZKhqWeUEOUZcmWEcynyC5xZa.f92iZ3oJD1C2', 'admin');

INSERT INTO Alertas (tipo_alerta, mensagem, id_usuario) VALUES
('Comunicado', 'O sistema passará por manutenção às 22h.', 1),
('Alerta', 'Uso indevido detectado na sua conta.', 1),
('Comunicado', 'Nova atualização disponível para download.', 1),
('Alerta', 'Falha no processo de sincronização.', 1),
('Comunicado', 'Seu relatório mensal já está disponível.', 1);

INSERT INTO Historico_sensores (topic, msg, time) VALUES
('s1/iluminacao','0','00:00:00'),
('s1/temperatura','null','00:00:00'),
('s1/umidade','0','00:00:00');