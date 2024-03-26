-- Inserting data into the 'alunos' table
INSERT INTO alunos (nome, ano, curso, telefone) VALUES
('Maria Silva', 3, 'Engenharia', '11987654321'),
('João Souza', 2, 'Direito', '11987654322'),
('Ana Costa', 1, 'Medicina', '11987654323');

-- Inserting data into the 'bibliotecarias' table
INSERT INTO bibliotecarias (nome) VALUES
('Carla Dias'),
('Fernanda Gomes');

-- Inserting data into the 'livros' table
INSERT INTO livros (codigo, titulo, autor, capa, volumes, sinopse) VALUES
(1001, 'O Pequeno Príncipe', 'Antoine de Saint-Exupéry', 'A', 1, 'Um piloto se encontra perdido no deserto do Saara após seu avião sofrer uma avaria. Lá, ele conhece um pequeno príncipe que vem de outro planeta.'),
(1002, 'Dom Casmurro', 'Machado de Assis', 'B', 1, 'A história de Bentinho e Capitu, contada sob a ótica de Bentinho, que suspeita da fidelidade de sua esposa.'),
(1003, 'A Arte da Guerra', 'Sun Tzu', 'C', 1, 'Um tratado militar escrito durante o século IV a.C. por Sun Tzu, composto por 13 capítulos.');

-- Inserting data into the 'generos' table
INSERT INTO generos (tipo) VALUES
('Ficção'),
('Romance'),
('Estratégia');

-- Inserting data into the 'livro_generos' table
-- Assuming the relationship based on titles (You might need to adjust the IDs based on actual insertion)
INSERT INTO livro_generos (id_livro, id_genero) VALUES
(1, 1), -- O Pequeno Príncipe as Ficção
(2, 2), -- Dom Casmurro as Romance
(3, 3); -- A Arte da Guerra as Estratégia

-- Inserting data into the 'emprestimos' table
INSERT INTO emprestimos (id_aluno, id_livro, data_aluguel, data_devolucao, status_livro) VALUES
(1, 1, '2023-10-01', '2023-10-15', 'devolvido'),
(2, 2, '2023-10-05', '2023-10-19', 'pendente'),
(3, 3, '2023-10-10', '2023-10-24', 'devolvido');

-- Inserting data into the 'c_logs' table
INSERT INTO c_logs (autor, acao, sujeito, data) VALUES
('Sistema', 'Inserção', 'alunos', NOW()),
('Sistema', 'Inserção', 'livros', NOW()),
('Sistema', 'Inserção', 'emprestimos', NOW());
