create database if not exists SGDB;

use SGDB;

create table if not exists alunos(
rm int(6) primary key auto_increment,
nome mediumtext not null,
ano int(2) not null,
curso tinytext not null,
telefone char(20) not null unique
);

create table if not exists bibliotecarias(
id int auto_increment primary key,
nome tinytext
);

create table if not exists livros(
id int primary key auto_increment,
codigo int(32) not null unique,
titulo mediumtext not null,
autor mediumtext not null,
capa varchar(1),
volumes int not null,
sinopse text not null
);

create table if not exists generos(
id int primary key auto_increment,
tipo tinytext not null
);

create table if not exists livro_generos(
id_livro int not null,
id_genero int not null,
foreign key (id_livro) REFERENCES livros(id),
foreign key (id_genero) REFERENCES generos(id)
);

create table if not exists emprestimos(
id int auto_increment primary key,
id_aluno int not null,
id_livro int not null,
data_aluguel date not null,
data_devolucao date not null,
status_livro varchar(20) not null,
foreign key (id_aluno) references alunos(rm),
foreign key (id_livro) references livros(id)
);

create table if not exists c_logs(
id int auto_increment primary key,
autor text not null,
acao tinytext not null,
sujeito tinytext,
data datetime not null
);


create table if not exists notificacoes(
id int primary key auto_increment,
numero varchar(20) not null,
id_emprestimo smallint not null,
data datetime not null,
iteracao int(1) not null
);

create table if not exists coordenadores(
id int primary key auto_increment,
nome mediumtext not null,
numero varchar(20) not null,
curso tinytext not null
);


insert into alunos values (default, 'Iago Fragnan', 3, 'Desenvolvimento de Sistemas', '11'),
(default, 'Arthur Santana', 3, 'Desenvolvimento de Sistemas', '75'),
(default, 'Alexsandro Rodrighero', 3, 'Mecatronica', '14');

insert into generos(tipo) values ('Romance'), ('Ação'), ('Didático'), ('Drama'), ('Novela'), ('Conto'), ('Ficção'), ('Biografia'), ('Poesia'), ('Aventura'), ('História em Quadrinhos'), ('Literatura Infantil'), ('Terror'), ('Artigo acadêmico'), ('Artigo científico'), ('Monografia'), ('Trabalho de Conclusão de Curso'), ('Tese de Doutorado'), ('Dissertação de Mestrado');


INSERT INTO livros (codigo, titulo, autor, capa, volumes, sinopse) VALUES 
(1001, 'Dom Casmurro', 'Machado de Assis', 'A', 1, 'Dom Casmurro é uma das obras mais conhecidas do autor brasileiro Machado de Assis. O romance é contado em primeira pessoa por Bento Santiago, o narrador, que se autodenomina Dom Casmurro.'),
(1002, 'O Pequeno Príncipe', 'Antoine de Saint-Exupéry', 'B', 1, 'O Pequeno Príncipe é uma fábula sobre o amor e a solidão, na qual um piloto se encontra perdido no deserto onde conhece um pequeno príncipe de outro planeta.'),
(1003, 'A Revolução dos Bichos', 'George Orwell', 'C', 1, 'A Revolução dos Bichos é uma fábula satírica que visa criticar o totalitarismo, contando a história de animais de uma fazenda que se revoltam contra seu dono.'),
(1004, '1984', 'George Orwell', 'D', 1, '1984 é um romance distópico de George Orwell que introduz os leitores a uma sociedade totalitária onde o governo controla todos os aspectos da vida dos cidadãos.'),
(1005, 'A Metamorfose', 'Franz Kafka', 'E', 1, 'A Metamorfose é uma novela escrita por Franz Kafka que explora a história de Gregor Samsa, um homem que se transforma em um inseto gigante, examinando as complexas relações familiares e sociais que isso desencadeia.');

