
CREATE DATABASE IF NOT EXISTS sgbe;

USE sgbe;

CREATE TABLE
    IF NOT EXISTS alunos (
        rm INT (6) PRIMARY KEY AUTO_INCREMENT,
        nome TINYTEXT NOT NULL,
        id_curso INT NOT NULL,
        telefone CHAR(11) NOT NULL  -- Numero é char
    );

CREATE TABLE
    IF NOT EXISTS cursos (
        id INT PRIMARY KEY AUTO_INCREMENT,
        ano INT NOT NULL,
        curso VARCHAR(80) NOT NULL,
        periodo  VARCHAR(80) NOT NULL
    );

CREATE TABLE
    IF NOT EXISTS bibliotecarias (
    id INT AUTO_INCREMENT PRIMARY KEY, 
    nome TINYTEXT
    );

CREATE TABLE
    IF NOT EXISTS livros (
        id INT PRIMARY KEY AUTO_INCREMENT,
        codigo VARCHAR(8) NOT NULL unique,
        titulo TINYTEXT NOT NULL,
        id_autor INT NOT NULL REFERENCES autores (id),
        id_editora INT NOT NULL REFERENCES editoras (id),
        capa TINYTEXT NOT NULL,
        volumes INT NOT NULL,
        sinopse TEXT NOT NULL
    );

CREATE TABLE
    IF NOT EXISTS generos (
        id INT PRIMARY KEY AUTO_INCREMENT,
        genero VARCHAR(120) NOT NULL
    );

CREATE TABLE
    IF NOT EXISTS editoras (
        id INT PRIMARY KEY AUTO_INCREMENT,
        editora VARCHAR(120) NOT NULL
    );

CREATE TABLE
    IF NOT EXISTS autores (
        id INT PRIMARY KEY AUTO_INCREMENT,
        autor TINYTEXT NOT NULL
    );

CREATE TABLE
    IF NOT EXISTS livros_generos (
        id_livro INT NOT NULL REFERENCES livros (id),
        id_genero INT NOT NULL REFERENCES generos (id)
    );

CREATE TABLE
    IF NOT EXISTS emprestimos (
        id INT AUTO_INCREMENT PRIMARY KEY,
        rm_aluno INT NOT NULL REFERENCES alunos (rm),
        id_bibliotecaria INT NOT NULL REFERENCES bibliotecarias (id),
        id_livro INT NOT NULL REFERENCES livros (id),
        data_aluguel DATE NOT NULL,
        data_devolucao DATE NOT NULL,
        id_status_livro INT(2) NOT NULL,
        prazo INT NOT NULL
    );

CREATE TABLE
    IF NOT EXISTS c_logs (
        id INT AUTO_INCREMENT PRIMARY KEY,
        autor TEXT NOT NULL,
        acao TINYTEXT NOT NULL,
        sujeito TINYTEXT NOT NULL,
        efetivado DATETIME NOT NULL
    );

CREATE TABLE
    IF NOT EXISTS notificacoes (
        id INT PRIMARY KEY AUTO_INCREMENT,
        rm_aluno INT NOT NULL REFERENCES alunos (rm),
        id_emprestimo INT NOT NULL REFERENCES emprestimos (id),
        data_envio DATETIME NOT NULL,
        iteracao INT (1) NOT NULL 
        -- ✅ Iteração: Ação de repetição
        -- ❌ Interação: é um tipo de ação que ocorre entre duas ou mais entidades.
        -- "Variavel de controle", Corresponde a quantidade de vezes de notificação enviadas ao pedido de devolução especifico
        -- Com o objetivo de manter o controle da ordem de envio das notificações.
        -- Exemplo: Foi enviada uma notificação hoje, valor: 1 para id de devolução #1234, amanhã será enviado outro
    );

CREATE TABLE
    IF NOT EXISTS coordenadores (
        id INT PRIMARY KEY AUTO_INCREMENT,
        nome TINYTEXT NOT NULL,
        telefone CHAR(11) NOT NULL
    );

CREATE TABLE
    IF NOT EXISTS curso_coordenadores (
        id INT PRIMARY KEY AUTO_INCREMENT,
        id_curso INT NOT NULL REFERENCES cursos (id),
        id_coordenador INT NOT NULL REFERENCES coordenadores (id)
    );

CREATE TABLE
    IF NOT EXISTS avaliacoes (
        id INT PRIMARY KEY AUTO_INCREMENT,
        id_livro INT NOT NULL REFERENCES livros (id),
        rm_aluno INT NOT NULL REFERENCES alunos (rm),
        avaliacao float NOT NULL
    );

CREATE TABLE
    IF NOT EXISTS estado_emprestimos (
    id INT AUTO_INCREMENT PRIMARY KEY, 
    nome TINYTEXT
    );

INSERT INTO estado_emprestimos values 
    (default, 'pendente'),
    (default, 'atrasado'),
    (default, 'restituido')
    ;

-- INSERTS DE EXEMPLOS PARA TESTE DA API --
-- 100% ATUALIZADO, É RUIM DE ATURAR, VIROU MODA E TODO MUNDO QUER TESTAR --

INSERT INTO cursos (ano, curso, periodo) VALUES
(2023, 'Desenvolvimento de Sistemas', 'Matutino'),
(2023, 'Informatica', 'Vespertino'),
(2023, 'Enfermagem', 'Noturno'),
(2023, 'Mecatronica', 'Integral'),
(2023, 'Eletronica', 'Matutino'),
(2023, 'Administração', 'Vespertino'),
(2023, 'Edificações', 'Noturno');


INSERT INTO alunos (rm, nome, id_curso, telefone) VALUES
(2210001, 'João Silva', 1, '12345678901'),
(2210002, 'Maria Santos', 2, '23456789012'),
(2210003, 'Carlos Pereira', 3, '34567890123');

INSERT INTO bibliotecarias (nome) VALUES
('Ana Beatriz'),
('Laura Neves');

INSERT INTO editoras (editora) VALUES
('Editora Alpha'),
('Editora Beta');

INSERT INTO autores (autor) VALUES
('Carlos Drummond'),
('Clarice Lispector');

INSERT INTO livros (codigo, titulo, id_autor, id_editora, capa, volumes, sinopse) VALUES
('L001', 'Aprendendo SQL', 1, 1, 'Capa dura', 1, 'Um guia completo para aprender SQL do zero.'),
('L002', 'Dados Avançados', 2, 2, 'Capa mole', 2, 'Exploração avançada de bancos de dados.');

INSERT INTO generos (genero) VALUES
('Educação'),
('Tecnologia');

INSERT INTO livros_generos (id_livro, id_genero) VALUES
(1, 1),
(2, 2);


INSERT INTO emprestimos (rm_aluno, id_bibliotecaria, id_livro, data_aluguel, data_devolucao, id_status_livro, prazo) VALUES
(2210002, 1, 1, '2023-04-01', '2023-04-15', 1, 14),
(2210003, 2, 2, '2023-04-05', '2023-04-19', 2, 14);

INSERT INTO notificacoes (rm_aluno, id_emprestimo, data_envio, iteracao) VALUES
(2210002, 1, '2023-04-16', 1);

INSERT INTO coordenadores (nome, telefone) VALUES
('Roberto Carlos', '1122334455');

INSERT INTO curso_coordenadores (id_curso, id_coordenador) VALUES
(1, 1);

INSERT INTO avaliacoes (id_livro, rm_aluno, avaliacao) VALUES
(1, 2210001, 4.5),
(1, 2210002, 5.0),
(1, 2210002, 2.0);
