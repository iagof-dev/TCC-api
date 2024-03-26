INSERT INTO alunos (nome, ano, curso, telefone) VALUES ('João Silva', 2, 'mecatronica', '11987654321');
INSERT INTO alunos (nome, ano, curso, telefone) VALUES ('Maria Oliveira', 1, 'desenvolvimento de sistemas', '11987654322');
INSERT INTO alunos (nome, ano, curso, telefone) VALUES ('Lucas Santos', 3, 'enfermagem', '11987654323');
INSERT INTO alunos (nome, ano, curso, telefone) VALUES ('Ana Costa', 2, 'mecatronica', '11987654324');
INSERT INTO alunos (nome, ano, curso, telefone) VALUES ('Pedro Almeida', 1, 'administração', '11987654325');
INSERT INTO bibliotecarias (nome) VALUES('Thais Carla'), ('Fernanda Gomes');
INSERT INTO livros (codigo, titulo, autor, capa, volumes, sinopse) VALUES (1001, 'O Pequeno Príncipe', 'Antoine de Saint-Exupéry', 'A', 1, 'Um piloto se encontra perdido no deserto do Saara após seu avião sofrer uma avaria. Lá, ele conhece um pequeno príncipe que vem de outro planeta.'),(1002, 'Dom Casmurro', 'Machado de Assis', 'B', 1, 'A história de Bentinho e Capitu, contada sob a ótica de Bentinho, que suspeita da fidelidade de sua esposa.'),(1003, 'A Arte da Guerra', 'Sun Tzu', 'C', 1, 'Um tratado militar escrito durante o século IV a.C. por Sun Tzu, composto por 13 capítulos.');

INSERT INTO generos (tipo) VALUES ('Ficção'),('Romance'),('Estratégia');

INSERT INTO livro_generos (id_livro, id_genero) VALUES (1, 1), (2, 2), (3, 3);

INSERT INTO emprestimos (id_aluno, id_livro, data_aluguel, data_devolucao, status_livro) VALUES (1, 1, '2023-10-01', '2023-10-15', 'devolvido'),(2, 2, '2023-10-05', '2023-10-19', 'pendente'),(3, 3, '2023-10-10', '2023-10-24', 'devolvido');

INSERT INTO c_logs (autor, acao, sujeito, data) VALUES ('Sistema', 'Inserção', 'alunos', NOW()), ('Sistema', 'Inserção', 'livros', NOW()), ('Sistema', 'Inserção', 'emprestimos', NOW());
