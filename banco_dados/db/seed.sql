Use TremVida;

INSERT INTO Usuarios (nome, email, senha, funcao) VALUES
('admin', 'admin@email.com', '$2y$10$s8V0x/AaK03bUvGBZKhqWeUEOUZcmWEcynyC5xZa.f92iZ3oJD1C2', 'Admin')
('Arthur Oscar', 'arthur_o_soares@estudante.sesisenai.org.br', '$2y$10$DxdZOoIXQPs5FqCp3iE1pOOw42XBg7nB9JiV/JdzVBCHCCTP1Sl7C', 'Funcionário')
('Lucas Felipe', 'lucas_f_ramos@estudante.sesisenai.org.br', '$2y$10$wUMA6h79ICIorRknyp4MF.fll8awizIhBOUFErIVpUPZZCzfTJScO', 'Funcionário')
('Leonardo Leite', 'Leonardo_hs_leite@estudante.sesisenai.org.br', '$2y$10$Z5fNTtNCFLSQmtbt5PqKLuZA5oUEdgEpH8z0D0vmGWRF8bxMr6Zs2', 'Funcionário')
('Gabriel Pariz', 'gabriel_ferreira37@estudante.sesisenai.org.br', '$2y$10$ypoT/Xh/oN2lwWN6UycUCuE68ZCcWQ0BysSfoaU5r4qvfMA/VH5Ry', 'Funcionário');

INSERT INTO Alertas (tipo_alerta, mensagem, id_usuario) VALUES
('Alerta', 'Placa S2 com problemas no seu circuito.', 1),
('Comunicado', 'A empresa tera uma festa comemorativa dia 12 de dezembro.', 1);

INSERT INTO Historico_sensores (topic, msg, time) VALUES
('s1/iluminacao','0','00:00:00'),
('s1/temperatura','null','00:00:00'),
('s1/umidade','0','00:00:00');