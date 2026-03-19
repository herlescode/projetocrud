CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    senha VARCHAR(255) NOT NULL
);

<<<<<<< HEAD
INSERT INTO usuarios (nome, senha) VALUES ('camila', '123456');

SELECT * FROM usuarios;

ALTER TABLE usuarios ADD COLUMN adm BOOLEAN DEFAULT FALSE;

UPDATE usuarios
SET adm = TRUE
WHERE id = 1;
=======
>>>>>>> 4f77496 (Ajustes de conexão em casa)
