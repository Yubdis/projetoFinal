CRUD
Create - INSERT
Read - SELECT
Update - Update
Delete - Delete

INSERT (inserindo informações na tabela)
---
INSERT INTO usuarios ( nome, email, obs, senha, data_cadastro ) VALUES ( "Pedro", "pedro@email.com", "", "1245", "2023-10-30" )
INSERT INTO usuarios ( nome, email, senha, obs )
VALUES ( "Lucas", "lucas@email.com", "teste", "" )

INSERT INTO usuarios ( nome, email, obs, senha, data_cadastro ) VALUES ( "Ricardo", "rr@email.com", "", "nova", "2023-10-25" );

INSERT INTO usuarios ( nome, email, obs, senha, data_cadastro ) VALUES ( "Medina", "medina@email.com", "", "teste", "2023-09-25" );

INSERT INTO usuarios ( nome, email, obs, senha, data_cadastro ) VALUES ( "Vitor", "vitro@email.com", "", "nada", NOW() )

UPDATE - ATualizar informações
---
UPDATE usuarios SET nome = "João", email = "jp@email.com", obs = "" WHERE id = 2;

UPDATE usuarios SET nome = "Vitor", email = "vitor@email.com", obs = ""
WHERE id = 5;

UPDATE usuarios SET obs = "" WHERE id = 4 OR id = 3;

UPDATE usuarios SET obs = "Sem observações." WHERE obs = "";

Deletar - Apagar dados
---
DELETE FROM usuarios WHERE id = 1

SELECT - Buscar dados
--
SELECT * FROM usuarios
SELECT email, senha FROM usuarios
SELECT * FROM usuarios WHERE id = 5
SELECT * FROM usuarios WHERE id >= 3
SELECT * FROM usuarios WHERE nome = "Alexandra"
SELECT * FROM usuarios ORDER BY nome DESC
SELECT * FROM usuarios WHERE id > 3 ORDER BY nome, email